<?php

namespace Database\Seeders;

use App\Models\ContentItem;
use Illuminate\Database\Seeder;

class StaticHtmlDemoSeeder extends Seeder
{
    public function run(): void
    {
        ContentItem::updateOrCreate(['type' => 'hero', 'slug' => 'main-construction-hero'], [
            'title' => 'Main Construction Hero',
            'status' => 'Active',
            'sort_order' => 1,
            'data' => [
                'heading' => 'Build with confidence.<br><em>Invest with clarity.</em>',
                'subheading' => 'Construction, renovation, ready-made houses and residential plots in Peshawar — with selected property options available on cash and installment plans.',
                'media_type' => 'Video',
                'media' => 'https://upload.wikimedia.org/wikipedia/commons/4/42/Rotating_timelapse_of_the_construction_site%2C_outside_of_UAB_Medical_West_Hospital%2C_an_affiliate_of_University_of_Alabama_at_Birmingham_UAB_Health_System_in_Bessemer%2C_Alabama_taken_over_2022-2024.webm',
                'poster' => 'https://media.zameen.com/thumbnails/107618856-800x600.jpeg',
            ],
        ]);

        $achievements = [
            ['slug' => 'achievement-local', 'value' => 'Peshawar', 'label' => 'Local Market Focus', 'description' => 'Warsak Road and surrounding areas'],
            ['slug' => 'achievement-360', 'value' => '360°', 'label' => 'Property Support', 'description' => 'Build, renovate, buy and invest'],
            ['slug' => 'achievement-flex', 'value' => 'Cash +', 'label' => 'Installment Options', 'description' => 'For selected houses and plots'],
            ['slug' => 'achievement-quality', 'value' => 'Quality', 'label' => 'Execution Focus', 'description' => 'Planning, supervision and finishing'],
        ];
        foreach ($achievements as $i => $row) {
            ContentItem::updateOrCreate(['type' => 'achievements', 'slug' => $row['slug']], [
                'title' => $row['label'],
                'status' => 'Published',
                'sort_order' => $i + 1,
                'data' => $row,
            ]);
        }

        $team = [
            ['slug' => 'team-ceo', 'name' => 'Chief Executive Officer', 'role' => 'Leadership & Strategy', 'image' => 'https://pha.gov.pk/peshawar_suruzair/new/3.jpg'],
            ['slug' => 'team-md', 'name' => 'Managing Director', 'role' => 'Operations & Business', 'image' => 'https://pha.gov.pk/peshawar_suruzair/new/5.jpg'],
            ['slug' => 'team-engineer', 'name' => 'Site Engineer', 'role' => 'Execution & Quality', 'image' => 'https://wsspeshawar.org.pk/backend/assets/zonalDresentupdateimage/1742358537_0_c218defa-90b9-49a8-b95c-15243bae1816.jpg'],
            ['slug' => 'team-design', 'name' => 'Design & Coordination', 'role' => 'Planning & Client Support', 'image' => 'https://media.zameen.com/thumbnails/107618856-800x600.jpeg'],
        ];
        foreach ($team as $i => $row) {
            ContentItem::updateOrCreate(['type' => 'team', 'slug' => $row['slug']], [
                'title' => $row['name'],
                'status' => 'Published',
                'sort_order' => $i + 1,
                'data' => $row,
            ]);
        }

        $testimonials = [
            ['slug' => 'testimonial-1', 'client' => 'Client Review Placeholder', 'role' => 'Construction Client', 'rating' => 5, 'quote' => 'Professional communication and a clear approach to construction planning.'],
            ['slug' => 'testimonial-2', 'client' => 'Property Client Placeholder', 'role' => 'Property Buyer', 'rating' => 5, 'quote' => 'Helpful property guidance and easy coordination for site visits and enquiries.'],
            ['slug' => 'testimonial-3', 'client' => 'Project Client Placeholder', 'role' => 'Renovation Client', 'rating' => 5, 'quote' => 'A convenient single team for renovation, property and construction requirements.'],
        ];
        foreach ($testimonials as $i => $row) {
            ContentItem::updateOrCreate(['type' => 'testimonials', 'slug' => $row['slug']], [
                'title' => $row['client'],
                'status' => 'Published',
                'sort_order' => $i + 1,
                'data' => $row,
            ]);
        }

        ContentItem::updateOrCreate(['type' => 'before-after', 'slug' => 'renovation-showcase'], [
            'title' => 'Renovation Showcase',
            'status' => 'Published',
            'sort_order' => 1,
            'data' => [
                'before_image' => 'https://respak.pk/wp-content/uploads/2026/01/WhatsApp-Image-2026-01-14-at-2.37.46-PM.jpeg',
                'after_image' => 'https://mffagroup.com/wp-content/uploads/2024/01/WhatsApp-Image-2024-01-19-at-18.10.36_f2dde378.jpg',
                'description' => 'Representative renovation transformation from the static demo.',
            ],
        ]);

        $partners = ['Certification / Registration', 'Material Partner', 'Engineering Partner', 'Trusted Client', 'Business Partner'];
        foreach ($partners as $i => $name) {
            ContentItem::updateOrCreate(['type' => 'partners', 'slug' => 'partner-'.($i + 1)], [
                'title' => $name,
                'status' => 'Published',
                'sort_order' => $i + 1,
                'data' => ['kind' => 'Partner', 'description' => $name],
            ]);
        }

        $social = [
            ['slug' => 'social-facebook', 'platform' => 'Facebook', 'url' => '#', 'icon' => 'f'],
            ['slug' => 'social-linkedin', 'platform' => 'LinkedIn', 'url' => '#', 'icon' => 'in'],
            ['slug' => 'social-youtube', 'platform' => 'YouTube', 'url' => '#', 'icon' => '▶'],
            ['slug' => 'social-instagram', 'platform' => 'Instagram', 'url' => '#', 'icon' => '◎'],
        ];
        foreach ($social as $i => $row) {
            ContentItem::updateOrCreate(['type' => 'social', 'slug' => $row['slug']], [
                'title' => $row['platform'],
                'status' => 'Published',
                'sort_order' => $i + 1,
                'data' => $row,
            ]);
        }
    }
}
