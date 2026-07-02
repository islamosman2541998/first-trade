<?php

namespace Database\Seeders;

use App\Models\HomeSection;
use App\Models\HomeSectionItem;
use Illuminate\Database\Seeder;

class HomeSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'key' => 'about',
                'sort_order' => 1,
                'subtitle_en' => 'About First Trade',
                'subtitle_ar' => 'عن فرست تريد',
                'subtitle_nl' => 'Over First Trade',
                'title_en' => 'Fresh produce selected for reliable global trade',
                'title_ar' => 'منتجات طازجة مختارة لتجارة عالمية موثوقة',
                'title_nl' => 'Verse producten geselecteerd voor betrouwbare wereldhandel',
                'description_en' => 'First Trade supplies premium fruits and vegetables prepared for import, export, and wholesale markets with careful selection, professional packing, and trusted handling.',
                'description_ar' => 'فرست تريد توفر فاكهة وخضروات طازجة بجودة مناسبة لأسواق الاستيراد والتصدير والتوريد بالجملة، من خلال اختيار دقيق وتعبئة احترافية وتجهيز موثوق.',
                'description_nl' => 'First Trade levert premium groenten en fruit voor import, export en groothandel, met zorgvuldige selectie, professionele verpakking en betrouwbare afhandeling.',
                'button_text_en' => 'Learn More',
                'button_text_ar' => 'اعرف المزيد',
                'button_text_nl' => 'Meer informatie',
                'button_link' => '/about',
                'button_target' => '_self',
            ],
            [
                'key' => 'stats',
                'sort_order' => 2,
                'subtitle_en' => 'Our Numbers',
                'subtitle_ar' => 'أرقامنا',
                'subtitle_nl' => 'Onze cijfers',
                'title_en' => 'Numbers that reflect our fresh trade focus',
                'title_ar' => 'أرقام تعكس تركيزنا في تجارة المنتجات الطازجة',
                'title_nl' => 'Cijfers die onze focus op verse handel weerspiegelen',
            ],
            [
                'key' => 'categories',
                'sort_order' => 3,
                'subtitle_en' => 'First Trade',
                'subtitle_ar' => 'فرست تريد',
                'subtitle_nl' => 'First Trade',
                'title_en' => 'Featured Categories',
                'title_ar' => 'تصنيفات مميزة',
                'title_nl' => 'Uitgelichte categorieën',
                'description_en' => 'Explore our main fresh produce categories prepared for export and wholesale supply.',
                'description_ar' => 'تصفح أهم تصنيفات المنتجات الطازجة المجهزة للتصدير والتوريد بالجملة.',
                'description_nl' => 'Ontdek onze belangrijkste verse productcategorieën voor export en groothandel.',
                'button_text_en' => 'View All Categories',
                'button_text_ar' => 'عرض كل التصنيفات',
                'button_text_nl' => 'Alle categorieën bekijken',
                'button_link' => '/categories',
                'button_target' => '_self',
            ],
            [
                'key' => 'featured_products',
                'sort_order' => 4,
                'subtitle_en' => 'Products',
                'subtitle_ar' => 'المنتجات',
                'subtitle_nl' => 'Producten',
                'title_en' => 'Featured Products',
                'title_ar' => 'منتجات مميزة',
                'title_nl' => 'Uitgelichte producten',
                'description_en' => 'A selected range of fresh products ready for international markets.',
                'description_ar' => 'مجموعة مختارة من المنتجات الطازجة الجاهزة للأسواق الدولية.',
                'description_nl' => 'Een geselecteerde reeks verse producten klaar voor internationale markten.',
                'button_text_en' => 'View All Products',
                'button_text_ar' => 'عرض كل المنتجات',
                'button_text_nl' => 'Alle producten bekijken',
                'button_link' => '/products',
                'button_target' => '_self',
            ],
            [
                'key' => 'latest_products',
                'sort_order' => 5,
                'subtitle_en' => 'Latest Products',
                'subtitle_ar' => 'أحدث المنتجات',
                'subtitle_nl' => 'Nieuwste producten',
                'title_en' => 'Recently Added Fresh Products',
                'title_ar' => 'أحدث المنتجات المضافة',
                'title_nl' => 'Recent toegevoegde verse producten',
                'description_en' => 'Discover the latest products added to our fresh export collection.',
                'description_ar' => 'تصفح أحدث المنتجات الطازجة التي تمت إضافتها إلى مجموعتنا الجاهزة للتصدير.',
                'description_nl' => 'Ontdek de nieuwste producten die aan onze verse exportcollectie zijn toegevoegd.',
            ],
            [
                'key' => 'why_choose_us',
                'sort_order' => 6,
                'subtitle_en' => 'Why Choose Us',
                'subtitle_ar' => 'لماذا تختارنا',
                'subtitle_nl' => 'Waarom kiezen voor ons',
                'title_en' => 'Built for quality, freshness, and dependable export operations',
                'title_ar' => 'نهتم بالجودة والطزاجة وتجهيز التصدير باحترافية',
                'title_nl' => 'Gericht op kwaliteit, versheid en betrouwbare exportprocessen',
            ],
            [
                'key' => 'export_process',
                'sort_order' => 7,
                'subtitle_en' => 'Export Process',
                'subtitle_ar' => 'خطوات التصدير',
                'subtitle_nl' => 'Exportproces',
                'title_en' => 'From selection to delivery',
                'title_ar' => 'من اختيار المنتج حتى التسليم',
                'title_nl' => 'Van selectie tot levering',
            ],
            [
                'key' => 'cta',
                'sort_order' => 8,
                'title_en' => 'Looking for reliable fresh produce supply?',
                'title_ar' => 'تبحث عن مورد موثوق للمنتجات الطازجة؟',
                'title_nl' => 'Op zoek naar betrouwbare levering van verse producten?',
                'description_en' => 'Send your request and our team will help you with the right products, quantities, and export requirements.',
                'description_ar' => 'ارسل طلبك وسيساعدك فريقنا في اختيار المنتجات والكميات ومتطلبات التصدير المناسبة.',
                'description_nl' => 'Stuur uw aanvraag en ons team helpt u met de juiste producten, hoeveelheden en exportvereisten.',
                'button_text_en' => 'Request Quote',
                'button_text_ar' => 'اطلب عرض سعر',
                'button_text_nl' => 'Offerte aanvragen',
                'button_link' => '/request-quote',
                'button_target' => '_self',
            ],
        ];

        foreach ($sections as $sectionData) {
            HomeSection::updateOrCreate(
                ['key' => $sectionData['key']],
                $sectionData + ['is_active' => true]
            );
        }

        $this->seedStatsItems();
        $this->seedWhyChooseUsItems();
        $this->seedExportProcessItems();
    }

    private function seedStatsItems(): void
    {
        $section = HomeSection::where('key', 'stats')->first();

        if (! $section) {
            return;
        }

        $items = [
            [
                'sort_order' => 1,
                'title_en' => '10+',
                'title_ar' => '10+',
                'title_nl' => '10+',
                'description_en' => 'Years Experience',
                'description_ar' => 'سنوات خبرة',
                'description_nl' => 'Jaren ervaring',
            ],
            [
                'sort_order' => 2,
                'title_en' => '15+',
                'title_ar' => '15+',
                'title_nl' => '15+',
                'description_en' => 'Export Markets',
                'description_ar' => 'أسواق تصدير',
                'description_nl' => 'Exportmarkten',
            ],
            [
                'sort_order' => 3,
                'title_en' => '25+',
                'title_ar' => '25+',
                'title_nl' => '25+',
                'description_en' => 'Product Varieties',
                'description_ar' => 'أنواع منتجات',
                'description_nl' => 'Productvariëteiten',
            ],
        ];

        foreach ($items as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $section->id,
                    'sort_order' => $item['sort_order'],
                ],
                $item + ['is_active' => true]
            );
        }
    }

    private function seedWhyChooseUsItems(): void
    {
        $section = HomeSection::where('key', 'why_choose_us')->first();

        if (! $section) {
            return;
        }

        $items = [
            [
                'sort_order' => 1,
                'icon' => 'bi bi-check2-circle',
                'title_en' => 'Careful Selection',
                'title_ar' => 'اختيار دقيق',
                'title_nl' => 'Zorgvuldige selectie',
                'description_en' => 'Products are selected with attention to freshness, consistency, and market requirements.',
                'description_ar' => 'يتم اختيار المنتجات بعناية بما يناسب الجودة والطزاجة واحتياجات السوق.',
                'description_nl' => 'Producten worden geselecteerd op versheid, consistentie en marktbehoeften.',
            ],
            [
                'sort_order' => 2,
                'icon' => 'bi bi-box-seam',
                'title_en' => 'Professional Packing',
                'title_ar' => 'تعبئة احترافية',
                'title_nl' => 'Professionele verpakking',
                'description_en' => 'Packing options are prepared to support wholesale and export standards.',
                'description_ar' => 'نوفر خيارات تعبئة مناسبة لمتطلبات التوريد بالجملة والتصدير.',
                'description_nl' => 'Verpakkingsopties worden voorbereid voor groothandel en exportnormen.',
            ],
            [
                'sort_order' => 3,
                'icon' => 'bi bi-globe2',
                'title_en' => 'Export Handling',
                'title_ar' => 'تجهيز للتصدير',
                'title_nl' => 'Exportafhandeling',
                'description_en' => 'We support reliable product preparation for international trade and shipment workflows.',
                'description_ar' => 'نساعد في تجهيز المنتجات بما يدعم مراحل التجارة والشحن للأسواق الدولية.',
                'description_nl' => 'Wij ondersteunen betrouwbare voorbereiding van producten voor internationale handel en verzending.',
            ],
        ];

        foreach ($items as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $section->id,
                    'sort_order' => $item['sort_order'],
                ],
                $item + ['is_active' => true]
            );
        }
    }

    private function seedExportProcessItems(): void
    {
        $section = HomeSection::where('key', 'export_process')->first();

        if (! $section) {
            return;
        }

        $items = [
            [
                'sort_order' => 1,
                'title_en' => 'Product Selection',
                'title_ar' => 'اختيار المنتج',
                'title_nl' => 'Productselectie',
                'description_en' => 'We identify suitable products based on quality and market needs.',
                'description_ar' => 'نحدد المنتجات المناسبة حسب الجودة واحتياجات السوق.',
                'description_nl' => 'Wij kiezen geschikte producten op basis van kwaliteit en marktbehoeften.',
            ],
            [
                'sort_order' => 2,
                'title_en' => 'Packing & Preparation',
                'title_ar' => 'التعبئة والتجهيز',
                'title_nl' => 'Verpakking & voorbereiding',
                'description_en' => 'Products are packed and prepared for trade requirements.',
                'description_ar' => 'يتم تجهيز المنتجات وتعبئتها بما يناسب متطلبات التجارة.',
                'description_nl' => 'Producten worden verpakt en voorbereid volgens handelsvereisten.',
            ],
            [
                'sort_order' => 3,
                'title_en' => 'Shipping Coordination',
                'title_ar' => 'تنسيق الشحن',
                'title_nl' => 'Verzendcoördinatie',
                'description_en' => 'Orders are handled with attention to timing, documentation, and delivery flow.',
                'description_ar' => 'يتم التعامل مع الطلبات باهتمام بالتوقيت والمستندات ومراحل التسليم.',
                'description_nl' => 'Bestellingen worden zorgvuldig behandeld met aandacht voor timing, documentatie en levering.',
            ],
        ];

        foreach ($items as $item) {
            HomeSectionItem::updateOrCreate(
                [
                    'home_section_id' => $section->id,
                    'sort_order' => $item['sort_order'],
                ],
                $item + ['is_active' => true]
            );
        }
    }
}