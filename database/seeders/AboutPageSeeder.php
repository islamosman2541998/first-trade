<?php

namespace Database\Seeders;

use App\Services\SettingService;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero
            ['about_hero_subtitle_en', 'About First Trade', 'text', 'about'],
            ['about_hero_subtitle_ar', 'عن فرست تريد', 'text', 'about'],
            ['about_hero_subtitle_nl', 'Over First Trade', 'text', 'about'],

            ['about_hero_title_en', 'Fresh Produce Trade Built on Quality and Trust', 'text', 'about'],
            ['about_hero_title_ar', 'تجارة منتجات طازجة قائمة على الجودة والثقة', 'text', 'about'],
            ['about_hero_title_nl', 'Handel in verse producten gebaseerd op kwaliteit en vertrouwen', 'text', 'about'],

            ['about_hero_description_en', 'First Trade specializes in supplying fresh fruits and vegetables for import, export, and wholesale markets with reliable selection, careful handling, and professional communication.', 'textarea', 'about'],
            ['about_hero_description_ar', 'فرست تريد شركة متخصصة في توريد الفاكهة والخضروات الطازجة لأسواق الاستيراد والتصدير والجملة من خلال اختيار موثوق وتجهيز احترافي وتواصل منظم.', 'textarea', 'about'],
            ['about_hero_description_nl', 'First Trade is gespecialiseerd in de levering van verse groenten en fruit voor import, export en groothandel met betrouwbare selectie, zorgvuldige behandeling en professionele communicatie.', 'textarea', 'about'],

            ['about_hero_image', null, 'image', 'about'],

            // Story
            ['about_story_subtitle_en', 'Our Story', 'text', 'about'],
            ['about_story_subtitle_ar', 'قصتنا', 'text', 'about'],
            ['about_story_subtitle_nl', 'Ons verhaal', 'text', 'about'],

            ['about_story_title_en', 'Connecting Reliable Fresh Produce with Global Markets', 'text', 'about'],
            ['about_story_title_ar', 'نربط المنتجات الطازجة الموثوقة بالأسواق العالمية', 'text', 'about'],
            ['about_story_title_nl', 'Betrouwbare verse producten verbinden met wereldwijde markten', 'text', 'about'],

            ['about_story_description_en', 'We work to make fresh produce trade easier, clearer, and more dependable for buyers, wholesalers, and export partners. Our focus is on product quality, suitable packing, availability, and long-term business relationships.', 'textarea', 'about'],
            ['about_story_description_ar', 'نعمل على جعل تجارة المنتجات الطازجة أسهل وأكثر وضوحًا واعتمادية للمشترين وتجار الجملة وشركاء التصدير، مع تركيز واضح على الجودة والتعبئة المناسبة والتوافر وبناء علاقات عمل طويلة الأمد.', 'textarea', 'about'],
            ['about_story_description_nl', 'Wij maken de handel in verse producten eenvoudiger, duidelijker en betrouwbaarder voor kopers, groothandels en exportpartners, met focus op kwaliteit, verpakking, beschikbaarheid en langdurige relaties.', 'textarea', 'about'],

            ['about_story_image', null, 'image', 'about'],

            // Stats
            ['about_stat_1_number', '10+', 'text', 'about'],
            ['about_stat_1_label_en', 'Years Experience', 'text', 'about'],
            ['about_stat_1_label_ar', 'سنوات خبرة', 'text', 'about'],
            ['about_stat_1_label_nl', 'Jaren ervaring', 'text', 'about'],

            ['about_stat_2_number', '15+', 'text', 'about'],
            ['about_stat_2_label_en', 'Export Markets', 'text', 'about'],
            ['about_stat_2_label_ar', 'أسواق تصدير', 'text', 'about'],
            ['about_stat_2_label_nl', 'Exportmarkten', 'text', 'about'],

            ['about_stat_3_number', '25+', 'text', 'about'],
            ['about_stat_3_label_en', 'Product Varieties', 'text', 'about'],
            ['about_stat_3_label_ar', 'أنواع منتجات', 'text', 'about'],
            ['about_stat_3_label_nl', 'Productsoorten', 'text', 'about'],

            // Values
            ['about_values_subtitle_en', 'Why Choose Us', 'text', 'about'],
            ['about_values_subtitle_ar', 'لماذا نحن', 'text', 'about'],
            ['about_values_subtitle_nl', 'Waarom kiezen voor ons', 'text', 'about'],

            ['about_values_title_en', 'What Makes First Trade Different', 'text', 'about'],
            ['about_values_title_ar', 'ما الذي يميز فرست تريد', 'text', 'about'],
            ['about_values_title_nl', 'Wat First Trade onderscheidt', 'text', 'about'],

            ['about_value_1_icon', 'bi bi-award', 'text', 'about'],
            ['about_value_1_title_en', 'Quality Selection', 'text', 'about'],
            ['about_value_1_title_ar', 'اختيار عالي الجودة', 'text', 'about'],
            ['about_value_1_title_nl', 'Kwaliteitsselectie', 'text', 'about'],
            ['about_value_1_description_en', 'We focus on fresh produce that matches market requirements and export expectations.', 'textarea', 'about'],
            ['about_value_1_description_ar', 'نركز على منتجات طازجة مناسبة لمتطلبات السوق وتوقعات التصدير.', 'textarea', 'about'],
            ['about_value_1_description_nl', 'Wij richten ons op verse producten die passen bij markt- en exportvereisten.', 'textarea', 'about'],

            ['about_value_2_icon', 'bi bi-box-seam', 'text', 'about'],
            ['about_value_2_title_en', 'Flexible Supply', 'text', 'about'],
            ['about_value_2_title_ar', 'توريد مرن', 'text', 'about'],
            ['about_value_2_title_nl', 'Flexibele levering', 'text', 'about'],
            ['about_value_2_description_en', 'Different quantities, packing options, and seasonal availability based on client needs.', 'textarea', 'about'],
            ['about_value_2_description_ar', 'كميات وخيارات تعبئة وتوافر موسمي حسب احتياجات العميل.', 'textarea', 'about'],
            ['about_value_2_description_nl', 'Verschillende hoeveelheden, verpakkingsopties en seizoensbeschikbaarheid volgens klantbehoeften.', 'textarea', 'about'],

            ['about_value_3_icon', 'bi bi-chat-dots', 'text', 'about'],
            ['about_value_3_title_en', 'Clear Communication', 'text', 'about'],
            ['about_value_3_title_ar', 'تواصل واضح', 'text', 'about'],
            ['about_value_3_title_nl', 'Duidelijke communicatie', 'text', 'about'],
            ['about_value_3_description_en', 'We keep communication organized from inquiry to quotation and follow-up.', 'textarea', 'about'],
            ['about_value_3_description_ar', 'نحافظ على تواصل منظم من مرحلة الاستفسار وحتى عرض السعر والمتابعة.', 'textarea', 'about'],
            ['about_value_3_description_nl', 'Wij houden communicatie helder vanaf aanvraag tot offerte en opvolging.', 'textarea', 'about'],

            // CTA
            ['about_cta_title_en', 'Looking for Reliable Fresh Produce Supply?', 'text', 'about'],
            ['about_cta_title_ar', 'تبحث عن توريد موثوق للمنتجات الطازجة؟', 'text', 'about'],
            ['about_cta_title_nl', 'Op zoek naar betrouwbare levering van verse producten?', 'text', 'about'],

            ['about_cta_description_en', 'Send us your product needs and our team will get back to you with the right offer.', 'textarea', 'about'],
            ['about_cta_description_ar', 'أرسل لنا احتياجاتك من المنتجات وسيتواصل معك فريقنا بالعرض المناسب.', 'textarea', 'about'],
            ['about_cta_description_nl', 'Stuur ons uw productbehoeften en ons team neemt contact met u op met een passend aanbod.', 'textarea', 'about'],
        ];

        foreach ($settings as [$key, $value, $type, $group]) {
            SettingService::set($key, $value, $type, $group);
        }
    }
}