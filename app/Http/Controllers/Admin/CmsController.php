<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    private function cfg(string $module): array
    {
        $cfg = config("cms.$module");
        abort_unless($cfg, 404);

        return $cfg;
    }

    public function index(string $module)
    {
        $cfg = $this->cfg($module);
        $items = ContentItem::type($module)->orderBy('sort_order')->orderByDesc('id')->paginate(30);

        return view('admin.module-index', compact('module', 'cfg', 'items'));
    }

    public function create(string $module)
    {
        $cfg = $this->cfg($module);
        $item = new ContentItem(['type' => $module, 'status' => 'Published']);

        return view('admin.module-form', compact('module', 'cfg', 'item'));
    }

    public function store(Request $request, string $module)
    {
        $cfg = $this->cfg($module);
        $item = new ContentItem;

        return $this->save($request, $module, $cfg, $item);
    }

    public function edit(string $module, ContentItem $item)
    {
        abort_unless($item->type === $module, 404);
        $cfg = $this->cfg($module);

        return view('admin.module-form', compact('module', 'cfg', 'item'));
    }

    public function update(Request $request, string $module, ContentItem $item)
    {
        abort_unless($item->type === $module, 404);
        $cfg = $this->cfg($module);

        return $this->save($request, $module, $cfg, $item);
    }

    private function save(Request $request, string $module, array $cfg, ContentItem $item)
    {
        $titleRule = $module === 'achievements' ? 'nullable|string|max:255' : 'required|string|max:255';

        $rules = [
            'title' => $titleRule,
            'slug' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'sort_order' => 'nullable|integer',
        ];

        foreach ($cfg['fields'] as $field) {
            $type = $field['type'];
            $rules['f_'.$field['name']] = match (true) {
                str_starts_with($type, 'image') => 'nullable|image|max:5120',
                $type === 'file' => 'nullable|file|max:51200',
                default => 'nullable',
            };
        }

        $validated = $request->validate($rules);
        $data = $item->data ?: [];

        foreach ($cfg['fields'] as $field) {
            $key = 'f_'.$field['name'];
            if (str_starts_with($field['type'], 'image') || $field['type'] === 'file') {
                if ($request->hasFile($key)) {
                    if (! empty($data[$field['name']]) && str_starts_with($data[$field['name']], 'storage/')) {
                        Storage::disk('public')->delete(substr($data[$field['name']], 8));
                    }
                    $path = $request->file($key)->store('cms/'.$module, 'public');
                    $data[$field['name']] = 'storage/'.$path;
                }
            } else {
                $data[$field['name']] = $request->input($key);
            }
        }

        $title = trim((string) ($validated['title'] ?? ''));
        if ($title === '' && $module === 'achievements') {
            $title = trim((string) ($data['label'] ?? $data['value'] ?? 'Statistic'));
        }
        if ($title === '' && $module === 'why-choose') {
            $title = 'Why choose us item';
        }

        $slug = trim((string) ($validated['slug'] ?? ''));
        if ($slug === '') {
            $slug = Str::slug($title).'-'.substr(md5((string) microtime(true)), 0, 5);
        }

        $item->fill([
            'type' => $module,
            'title' => $title,
            'slug' => $slug,
            'status' => $validated['status'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'data' => $data,
        ])->save();

        return redirect()
            ->route('admin.module.index', $module)
            ->with('success', 'Saved successfully.');
    }

    public function destroy(string $module, ContentItem $item)
    {
        abort_unless($item->type === $module, 404);

        foreach ((array) $item->data as $value) {
            if (is_string($value) && str_starts_with($value, 'storage/')) {
                Storage::disk('public')->delete(substr($value, 8));
            }
        }

        $item->delete();

        return back()->with('success', 'Deleted successfully.');
    }
}
