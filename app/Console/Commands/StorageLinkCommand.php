<?php

namespace App\Console\Commands;

use App\Support\PublicStorage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'storage:link')]
class StorageLinkCommand extends Command
{
    protected $signature = 'storage:link
                {--relative : Create the symbolic link using relative paths}
                {--force : Recreate existing links or refresh the public mirror}';

    protected $description = 'Link or mirror public/storage to storage/app/public (works on shared hosting)';

    public function handle(): int
    {
        $relative = (bool) $this->option('relative');
        $force = (bool) $this->option('force');

        foreach (PublicStorage::links() as $link => $target) {
            if ($this->linkExists($link) && ! $force) {
                if (PublicStorage::isMirrorMode($link)) {
                    PublicStorage::mirror($target, $link, true);
                    $this->components->info("Refreshed public mirror [$link] from [$target].");
                } else {
                    $this->components->warn("The [$link] path already exists. Use --force to replace it.");
                }

                continue;
            }

            if ($force && (file_exists($link) || is_link($link))) {
                if (is_link($link)) {
                    @unlink($link);
                } elseif (is_dir($link)) {
                    File::deleteDirectory($link);
                } else {
                    @unlink($link);
                }
            }

            if (! config('filesystems.mirror_public_storage') && PublicStorage::symlinkAvailable()) {
                try {
                    $this->createSymlink($target, $link, $relative);
                    if (is_link($link)) {
                        $this->components->info("The [$link] link has been connected to [$target].");

                        continue;
                    }
                } catch (\Throwable) {
                    // Fall through to mirror mode.
                }
            }

            PublicStorage::mirror($target, $link, true);
            $this->components->warn('Using public mirror mode (symlink/exec not available or not permitted).');
            $this->components->info("The [$link] directory now mirrors [$target]. Uploads will stay in sync automatically.");
        }

        return self::SUCCESS;
    }

    private function linkExists(string $link): bool
    {
        return file_exists($link) || is_link($link);
    }

    private function createSymlink(string $target, string $link, bool $relative): void
    {
        $files = $this->laravel->make('files');

        if ($relative) {
            $files->relativeLink($target, $link);
        } else {
            $files->link($target, $link);
        }
    }
}
