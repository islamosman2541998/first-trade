<?php

namespace Database\Seeders;

use App\Services\SettingService;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Language
            ['site_default_locale', 'en', 'select', 'language'],
            ['admin_default_locale', 'en', 'select', 'language'],

            // General
            ['site_name', 'First Trade', 'text', 'general'],
            ['site_email', 'info@first-trade.test', 'text', 'general'],
            ['site_phone', '+20 000 000 0000', 'text', 'general'],
            ['site_whatsapp', '+20 000 000 0000', 'text', 'general'],
            ['site_address_en', 'Egypt', 'textarea', 'general'],
            ['site_address_ar', 'مصر', 'textarea', 'general'],
            ['site_address_nl', 'Egypte', 'textarea', 'general'],

            // Branding
            ['site_logo', null, 'image', 'branding'],
            ['admin_logo', null, 'image', 'branding'],
            ['site_favicon', null, 'image', 'branding'],
            ['admin_logo_width', '120', 'number', 'branding'],

            // Login Appearance
            ['login_background_image', null, 'image', 'login'],
            ['login_background_color', '#F4F1EA', 'color', 'login'],
            ['login_card_color', '#FFFFFF', 'color', 'login'],
            ['login_card_opacity', '0.92', 'number', 'login'],
            ['login_card_text_color', '#1F2937', 'color', 'login'],
            ['login_button_color', '#2F6E3B', 'color', 'login'],
            ['login_button_text_color', '#FFFFFF', 'color', 'login'],

            // SEO
            ['meta_title_en', 'First Trade | Import & Export Fresh Fruits and Vegetables', 'text', 'seo'],
            ['meta_title_ar', 'فرست تريد | استيراد وتصدير الفاكهة والخضروات', 'text', 'seo'],
            ['meta_title_nl', 'First Trade | Import en Export van Verse Groenten en Fruit', 'text', 'seo'],

            ['meta_description_en', 'First Trade specializes in importing and exporting premium fresh fruits and vegetables.', 'textarea', 'seo'],
            ['meta_description_ar', 'فرست تريد شركة متخصصة في استيراد وتصدير الفاكهة والخضروات الطازجة بجودة مميزة.', 'textarea', 'seo'],
            ['meta_description_nl', 'First Trade is gespecialiseerd in import en export van verse groenten en fruit.', 'textarea', 'seo'],

            ['meta_keywords_en', 'fresh fruits, fresh vegetables, import, export, Egypt', 'textarea', 'seo'],
            ['meta_keywords_ar', 'فاكهة طازجة, خضروات طازجة, استيراد, تصدير, مصر', 'textarea', 'seo'],
            ['meta_keywords_nl', 'verse groenten, vers fruit, import, export, Egypte', 'textarea', 'seo'],

            // Tracking
            ['meta_pixel_id', null, 'text', 'tracking'],
            ['google_analytics_id', null, 'text', 'tracking'],
            ['google_tag_manager_id', null, 'text', 'tracking'],

            // Site Colors
            ['site_primary_color', '#2F6E3B', 'color', 'appearance'],
            ['site_secondary_color', '#24572E', 'color', 'appearance'],
            ['site_cream_color', '#F4F1EA', 'color', 'appearance'],
            ['site_yellow_color', '#F2C514', 'color', 'appearance'],
            ['site_peach_color', '#E8A48A', 'color', 'appearance'],
            ['site_sky_color', '#CBEAF1', 'color', 'appearance'],

            // Dashboard Colors
            ['admin_sidebar_color', '#24572E', 'color', 'dashboard_appearance'],
            ['admin_topbar_color', '#FFFFFF', 'color', 'dashboard_appearance'],
            ['admin_primary_color', '#2F6E3B', 'color', 'dashboard_appearance'],
            ['admin_background_color', '#F6F7F9', 'color', 'dashboard_appearance'],

            // Home Content
            ['home_hero_title_en', 'Fresh Produce, Trusted Trade', 'text', 'home'],
            ['home_hero_title_ar', 'منتجات طازجة.. وتجارة موثوقة', 'text', 'home'],
            ['home_hero_title_nl', 'Verse producten, betrouwbare handel', 'text', 'home'],

            ['home_hero_subtitle_en', 'Premium fruits and vegetables for import and export.', 'textarea', 'home'],
            ['home_hero_subtitle_ar', 'فاكهة وخضروات طازجة بجودة مميزة للاستيراد والتصدير.', 'textarea', 'home'],
            ['home_hero_subtitle_nl', 'Premium groenten en fruit voor import en export.', 'textarea', 'home'],

            // Social Links
            ['facebook_url', null, 'text', 'social'],
            ['instagram_url', null, 'text', 'social'],
            ['linkedin_url', null, 'text', 'social'],
            ['whatsapp_url', null, 'text', 'social'],
            ['youtube_url', null, 'text', 'social'],
            ['tiktok_url', null, 'text', 'social'],

            // Footer
            [
                'footer_about_en',
                'First Trade supplies premium fresh fruits and vegetables prepared for import, export, and wholesale markets with reliable selection and professional handling.',
                'textarea',
                'footer',
            ],
            [
                'footer_about_ar',
                'فرست تريد توفر فاكهة وخضروات طازجة بجودة مناسبة لأسواق الاستيراد والتصدير والتوريد بالجملة من خلال اختيار موثوق وتجهيز احترافي.',
                'textarea',
                'footer',
            ],
            [
                'footer_about_nl',
                'First Trade levert premium verse groenten en fruit voor import, export en groothandel met betrouwbare selectie en professionele afhandeling.',
                'textarea',
                'footer',
            ],
        ];

        foreach ($settings as [$key, $value, $type, $group]) {
            SettingService::set($key, $value, $type, $group);
        }
    }
}