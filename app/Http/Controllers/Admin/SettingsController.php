<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\PublicStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('admin.settings', [
            'settings' => Setting::pluck('value', 'key'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:100',
            'whatsapp' => 'nullable|string|max:100',
            'map_url' => 'nullable|string|max:2000',
            'working_hours' => 'nullable|string|max:500',
            'site_logo' => 'nullable|image|max:5120',
            'favicon' => 'nullable|image|max:2048',
        ]);

        foreach (['company', 'tagline', 'address', 'email', 'phone', 'whatsapp', 'map_url', 'working_hours'] as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $data[$key] ?? '']);
        }

        foreach (['site_logo' => 'branding/site-logo', 'favicon' => 'branding/favicon'] as $input => $folder) {
            if (! $request->hasFile($input)) {
                continue;
            }

            $previous = Setting::where('key', $input)->value('value');
            if ($previous && str_starts_with($previous, 'storage/')) {
                $relative = substr($previous, 8);
                Storage::disk('public')->delete($relative);
                PublicStorage::unpublish($relative);
            }

            $path = $request->file($input)->store($folder, 'public');
            PublicStorage::publish($path);
            Setting::updateOrCreate(['key' => $input], ['value' => 'storage/'.$path]);
        }

        return back()->with('success', 'Settings updated.');
    }
}
