<?php
namespace App\Http\Controllers\Admin; use App\Http\Controllers\Controller; use App\Models\ContentItem; use App\Models\Inquiry;
class DashboardController extends Controller
{
    public function index()
    {
        $modules = [
            'hero' => 'Hero / Video Slider',
            'home-sections' => 'Company Introduction',
            'services' => 'Services',
            'why-choose' => 'Why Choose Us',
            'process' => 'Construction Process',
            'projects' => 'Projects',
            'properties' => 'Properties',
            'gallery' => 'Gallery',
            'before-after' => 'Before & After',
            'testimonials' => 'Testimonials',
            'team' => 'Team & Leadership',
            'achievements' => 'Achievements',
            'partners' => 'Partners & Certifications',
            'news' => 'News & Insights',
            'faqs' => 'FAQs',
            'consultation' => 'Consultation CTA',
            'social' => 'Social Media',
        ];

        return view('admin.dashboard', [
            'modules' => $modules,
            'counts' => ContentItem::selectRaw('type, count(*) as total')->groupBy('type')->pluck('total', 'type'),
            'newInquiries' => Inquiry::where('status', 'New')->count(),
            'inquiryTotal' => Inquiry::count(),
            'recent' => Inquiry::latest()->take(8)->get(),
        ]);
    }
}
