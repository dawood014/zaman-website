<?php

namespace App\Support;

use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class PublicStorage
{
    public const MIRROR_MARKER = '.public-storage-mirror';

    public static function links(): array
    {
        return config('filesystems.links', [
            public_path('storage') => storage_path('app/public'),
        ]);
    }

    public static function symlinkAvailable(): bool
    {
        if (! function_exists('symlink')) {
            return false;
        }

        return ! self::isFunctionDisabled('symlink');
    }

    public static function execAvailable(): bool
    {
        if (! function_exists('exec')) {
            return false;
        }

        return ! self::isFunctionDisabled('exec');
    }

    public static function isFunctionDisabled(string $function): bool
    {
        $disabled = ini_get('disable_functions');
        if (! is_string($disabled) || $disabled === '') {
            return false;
        }

        $list = array_map('trim', explode(',', $disabled));

        return in_array($function, $list, true);
    }

    public static function isMirrorMode(?string $link = null): bool
    {
        $link ??= public_path('storage');

        return is_dir($link) && is_file($link.DIRECTORY_SEPARATOR.self::MIRROR_MARKER);
    }

    public static function markMirrorMode(string $link): void
    {
        if (! is_dir($link)) {
            return;
        }

        file_put_contents(
            $link.DIRECTORY_SEPARATOR.self::MIRROR_MARKER,
            'Files are copied here because symlink/exec are disabled on this server.'.PHP_EOL
            .'New uploads are mirrored automatically from storage/app/public.'.PHP_EOL
        );
    }

    /**
     * Copy a file from storage/app/public into public/storage (shared-hosting fallback).
     */
    public static function publish(string $relativePath): void
    {
        $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');
        $source = storage_path('app/public/'.$relativePath);
        if (! is_file($source)) {
            return;
        }

        if (is_link(public_path('storage'))) {
            return;
        }

        $destination = public_path('storage/'.$relativePath);
        $dir = dirname($destination);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        copy($source, $destination);
    }

    public static function unpublish(string $relativePath): void
    {
        if (is_link(public_path('storage'))) {
            return;
        }

        $relativePath = ltrim(str_replace('\\', '/', $relativePath), '/');
        $destination = public_path('storage/'.$relativePath);
        if (is_file($destination)) {
            @unlink($destination);
        }
    }

    /**
     * Mirror storage/app/public into public/storage (no symlink/exec required).
     */
    public static function mirror(string $target, string $link, bool $force = false): void
    {
        if (! is_dir($target)) {
            mkdir($target, 0755, true);
        }

        if (is_link($link)) {
            if ($force) {
                @unlink($link);
            } else {
                return;
            }
        } elseif (file_exists($link) && ! is_dir($link)) {
            if ($force) {
                @unlink($link);
            } else {
                throw new \RuntimeException("Cannot create public storage mirror; [$link] already exists.");
            }
        }

        if (! is_dir($link)) {
            if (! @mkdir($link, 0755, true) && ! is_dir($link)) {
                throw new \RuntimeException("Unable to create public storage directory [$link].");
            }
        }

        if (! is_dir($target)) {
            return;
        }

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($target, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            /** @var \SplFileInfo $item */
            $subPath = $iterator->getSubPathName();
            $destPath = $link.DIRECTORY_SEPARATOR.$subPath;

            if ($item->isDir()) {
                if (! is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }

                continue;
            }

            $destDir = dirname($destPath);
            if (! is_dir($destDir)) {
                mkdir($destDir, 0755, true);
            }

            if (! is_file($destPath) || filemtime($item->getPathname()) > filemtime($destPath)) {
                copy($item->getPathname(), $destPath);
            }
        }

        self::markMirrorMode($link);
    }

    public static function removeMirror(string $link, bool $force = false): void
    {
        if (is_link($link)) {
            if ($force) {
                @unlink($link);
            }

            return;
        }

        if (is_dir($link) && self::isMirrorMode($link) && $force) {
            File::deleteDirectory($link);
        }
    }
}
