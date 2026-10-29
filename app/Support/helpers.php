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

if (! function_exists('valid_external_url')) {
    /**
     * Returns a safe external URL for href, or null if missing/invalid/placeholder.
     */
    function valid_external_url(?string $url): ?string
    {
        $url = trim((string) $url);
        if ($url === '' || $url === '#' || $url === 'javascript:void(0)') {
            return null;
        }

        if (! preg_match('#^https?://#i', $url)) {
            return null;
        }

        return filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
    }
}

if (! function_exists('cms_page_url')) {
    function cms_page_url(?string $link, ?string $default = null): string
    {
        $link = trim((string) $link);
        if ($link === '') {
            return $default ?? url('/');
        }

        if (preg_match('#^https?://#i', $link)) {
            return filter_var($link, FILTER_VALIDATE_URL) ? $link : ($default ?? url('/'));
        }

        if (str_starts_with($link, '/')) {
            return url($link);
        }

        return url('/'.$link);
    }
}

if (! function_exists('site_logo_url')) {
    function site_logo_url(?array $settings = null): string
    {
        $path = $settings['site_logo'] ?? null;
        if ($path) {
            return cms_media($path, asset('assets/logo.png'));
        }

        return asset('assets/logo.png');
    }
}
