<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $services = json_decode(file_get_contents(__DIR__.'/services.json'), true, flags: JSON_THROW_ON_ERROR);
        foreach ($services as $index => [$title, $icon, $description, $activities, $audience]) {
            Service::firstOrCreate(['slug' => Str::slug($title)], [
                'title' => $title, 'icon' => $icon, 'description' => $description,
                'introduction' => $description.' We work with stakeholders to understand their context and discuss appropriate next steps.',
                'activities' => explode('|', $activities), 'audience' => $audience, 'sort_order' => $index, 'is_active' => true,
            ]);
        }
        TeamMember::firstOrCreate(['name' => 'Adedamola Ogidan', 'role' => 'Principal Consultant'], [
            'biography' => 'Adedamola Ogidan is the Principal Consultant at The School House Consult, an education consultancy focused on partnering with stakeholders to achieve educational excellence.',
            'photograph' => 'images/adedamola-ogidan.jpeg', 'is_active' => true,
        ]);
        foreach ([
            'What does The School House Consult do?' => 'We provide education consulting services, including curriculum development, professional development, leadership support and school improvement planning. Explore our Services page for our full areas of expertise.',
            'Who can contact The School House Consult?' => 'Schools, educators, school leaders, communities and other education stakeholders can contact us to discuss an educational challenge or development need.',
            'How can I request a consultation?' => 'Complete the consultation request form on our Contact page, or reach us using the listed phone numbers and email address.',
            'Where is The School House Consult located?' => 'Our office is at First Floor Ekundayo House, Oda Road, Akure, Ondo State, Nigeria.',
        ] as $question => $answer) {
            Faq::firstOrCreate(['question' => $question], ['answer' => $answer, 'is_active' => true]);
        }
    }
}
