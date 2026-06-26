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
            ['key' => 'site_name',            'value' => 'Wellaaro',                          'value_type' => 'string',  'group' => 'general',  'description' => 'Site name shown in emails and UI'],
            ['key' => 'tagline',              'value' => 'World-Class Healthcare, Simplified', 'value_type' => 'string',  'group' => 'general',  'description' => 'Short tagline for hero sections'],
            ['key' => 'logo_url',             'value' => '',                                   'value_type' => 'string',  'group' => 'general',  'description' => 'URL to main logo image'],
            ['key' => 'favicon_url',          'value' => '',                                   'value_type' => 'string',  'group' => 'general',  'description' => 'URL to favicon image'],

            // contact
            ['key' => 'contact_email',        'value' => 'care@wellaaro.com',                  'value_type' => 'string',  'group' => 'contact',  'description' => 'Primary contact email'],
            ['key' => 'support_email',        'value' => 'support@wellaaro.com',               'value_type' => 'string',  'group' => 'contact',  'description' => 'Support email address'],
            ['key' => 'whatsapp_number',      'value' => '+91 72111 36620',                    'value_type' => 'string',  'group' => 'contact',  'description' => 'WhatsApp number with country code'],
            ['key' => 'phone_number',         'value' => '+91 72111 36620',                    'value_type' => 'string',  'group' => 'contact',  'description' => 'Main phone number'],
            ['key' => 'office_address',       'value' => '123 Medical Hub, Mumbai 400001, India', 'value_type' => 'text', 'group' => 'contact',  'description' => 'Office address shown on contact page'],

            // social
            ['key' => 'facebook_url',         'value' => '',                                   'value_type' => 'string',  'group' => 'social',   'description' => 'Facebook page URL'],
            ['key' => 'instagram_url',        'value' => '',                                   'value_type' => 'string',  'group' => 'social',   'description' => 'Instagram profile URL'],
            ['key' => 'twitter_url',          'value' => '',                                   'value_type' => 'string',  'group' => 'social',   'description' => 'Twitter/X profile URL'],
            ['key' => 'linkedin_url',         'value' => '',                                   'value_type' => 'string',  'group' => 'social',   'description' => 'LinkedIn page URL'],
            ['key' => 'youtube_url',          'value' => '',                                   'value_type' => 'string',  'group' => 'social',   'description' => 'YouTube channel URL'],

            // seo
            ['key' => 'meta_title',           'value' => 'Wellaaro — Medical Tourism India',   'value_type' => 'string',  'group' => 'seo',      'description' => 'Default meta title'],
            ['key' => 'meta_description',     'value' => 'World-class medical treatments in India at affordable prices. JCI & NABH accredited hospitals.', 'value_type' => 'text', 'group' => 'seo', 'description' => 'Default meta description'],
            ['key' => 'google_analytics_id',  'value' => '',                                   'value_type' => 'string',  'group' => 'seo',      'description' => 'Google Analytics measurement ID (G-XXXXXXXX)'],
            ['key' => 'google_tag_manager_id','value' => '',                                   'value_type' => 'string',  'group' => 'seo',      'description' => 'Google Tag Manager container ID (GTM-XXXXXX)'],

            // features
            ['key' => 'enable_newsletter',    'value' => 'true',                               'value_type' => 'boolean', 'group' => 'features', 'description' => 'Show newsletter signup form'],
            ['key' => 'enable_blog',          'value' => 'true',                               'value_type' => 'boolean', 'group' => 'features', 'description' => 'Show blog section publicly'],
            ['key' => 'enable_reviews',       'value' => 'true',                               'value_type' => 'boolean', 'group' => 'features', 'description' => 'Show patient reviews/testimonials'],
            ['key' => 'maintenance_mode',     'value' => 'false',                              'value_type' => 'boolean', 'group' => 'features', 'description' => 'Put site in maintenance mode'],

            // email
            ['key' => 'mail_from_name',       'value' => 'Wellaaro Health',                    'value_type' => 'string',  'group' => 'email',    'description' => 'Sender name for outgoing emails'],
            ['key' => 'inquiry_notify_email', 'value' => 'admin@wellaaro.com',                 'value_type' => 'string',  'group' => 'email',    'description' => 'Email to receive new inquiry notifications'],
            ['key' => 'contact_notify_email', 'value' => 'admin@wellaaro.com',                 'value_type' => 'string',  'group' => 'email',    'description' => 'Email to receive contact form submissions'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
