<?php
namespace App\Http\Controllers\Admin; use App\Http\Controllers\Controller; use App\Models\ContentItem; use App\Models\Inquiry;
class DashboardController extends Controller { public function index(){return view('admin.dashboard',['counts'=>ContentItem::selectRaw('type,count(*) total')->groupBy('type')->pluck('total','type'),'newInquiries'=>Inquiry::where('status','New')->count(),'recent'=>Inquiry::latest()->take(8)->get()]);} }
