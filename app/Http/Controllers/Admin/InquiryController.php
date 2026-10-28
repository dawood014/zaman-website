<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::latest();

        if ($type = $request->string('type')->toString()) {
            $query->where('type', $type);
        }

        if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }

        return view('admin.inquiries', [
            'items' => $query->paginate(50)->withQueryString(),
            'filterType' => $type ?? '',
            'filterStatus' => $status ?? '',
        ]);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $inquiry->update($request->validate([
            'status' => 'required|in:New,In Progress,Closed',
            'internal_notes' => 'nullable|string|max:5000',
            'is_read' => 'nullable|boolean',
        ]));

        return back()->with('success', 'Inquiry updated.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted.');
    }
}
