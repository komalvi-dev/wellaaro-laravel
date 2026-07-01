<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // general
            ['key' => 'site_name',        'value' => 'Wellaaro',                             'value_type' => 'string', 'group' => 'general'],
            ['key' => 'site_tagline',     'value' => 'World-Class Care, Affordable Cost',     'value_type' => 'string', 'group' => 'general'],

            // contact
            ['key' => 'contact_email',    'value' => 'care@wellaaro.com',                     'value_type' => 'string', 'group' => 'contact'],
            ['key' => 'phone',            'value' => '+91 72111 36620',                       'value_type' => 'string', 'group' => 'contact'],
            ['key' => 'whatsapp_number',  'value' => '+91 72111 36620',                       'value_type' => 'string', 'group' => 'contact'],
            ['key' => 'address',          'value' => 'Ahmedabad, Gujarat, India',              'value_type' => 'string', 'group' => 'contact'],

            // seo
            ['key' => 'meta_description', 'value' => "India's leading medical tourism platform. Access world-class hospitals and specialist doctors at a fraction of US/UK costs. Free consultation.", 'value_type' => 'string', 'group' => 'seo'],

            // integrations
            ['key' => 'google_analytics', 'value' => '', 'value_type' => 'string', 'group' => 'integrations'],
            ['key' => 'facebook_pixel',   'value' => '', 'value_type' => 'string', 'group' => 'integrations'],

            // notifications
            ['key' => 'inquiry_email_cc', 'value' => '', 'value_type' => 'string', 'group' => 'notifications'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
