<?php
namespace App\Http\Controllers\Admin; use App\Http\Controllers\Controller; use App\Models\Inquiry; use Illuminate\Http\Request;
class InquiryController extends Controller {public function index(){return view('admin.inquiries',['items'=>Inquiry::latest()->paginate(50)]);}public function update(Request $r,Inquiry $inquiry){$inquiry->update($r->validate(['status'=>'required|in:New,In Progress,Closed']));return back()->with('success','Inquiry updated.');}public function destroy(Inquiry $inquiry){$inquiry->delete();return back()->with('success','Inquiry deleted.');}}
