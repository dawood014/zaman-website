<?php

if (! function_exists('cms_media')) {
    function cms_media(?string $path, string $fallback = 'https://media.zameen.com/thumbnails/199856624-800x600.jpeg'): string
    {
        if (! $path) {
            return $fallback;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return asset(ltrim($path, '/'));
    }
}

if (! function_exists('whatsapp_digits')) {
    function whatsapp_digits(?string $number): string
    {
        return preg_replace('/\D+/', '', (string) $number);
    }
}
