<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $citrus = Category::where('slug', 'citrus')->first();
        $grapes = Category::where('slug', 'grapes')->first();
        $potatoes = Category::where('slug', 'potatoes')->first();

        $pomegranates = Category::where('slug', 'pomegranates')->first();
        $mangoes = Category::where('slug', 'mangoes')->first();
        $strawberries = Category::where('slug', 'strawberries')->first();
        $dates = Category::where('slug', 'dates')->first();

        $onions = Category::where('slug', 'onions')->first();
        $garlic = Category::where('slug', 'garlic')->first();
        $sweetPotatoes = Category::where('slug', 'sweet-potatoes')->first();
        $tomatoes = Category::where('slug', 'tomatoes')->first();
        $peppers = Category::where('slug', 'peppers')->first();

        $products = [
            /*
            |--------------------------------------------------------------------------
            | Existing Products
            |--------------------------------------------------------------------------
            */
            [
                'category_id' => $citrus?->id,
                'slug' => 'fresh-orange',
                'sku' => 'FT-ORG-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Winter',
                'packaging' => 'Carton Box',
                'size' => 'Medium / Large',
                'grade' => 'Export Grade',
                'availability' => 'Seasonal',
                'is_featured' => true,
                'sort_order' => 1,
                'en' => [
                    'name' => 'Fresh Orange',
                    'short_description' => 'Premium fresh oranges selected for export.',
                    'description' => 'Fresh Egyptian oranges carefully selected, packed, and prepared according to export quality standards.',
                ],
                'ar' => [
                    'name' => 'برتقال طازج',
                    'short_description' => 'برتقال طازج بجودة مميزة مناسب للتصدير.',
                    'description' => 'برتقال مصري طازج يتم اختياره وتعبئته بعناية وفق معايير الجودة المناسبة للتصدير.',
                ],
                'nl' => [
                    'name' => 'Verse sinaasappel',
                    'short_description' => 'Premium verse sinaasappels geselecteerd voor export.',
                    'description' => 'Verse Egyptische sinaasappels zorgvuldig geselecteerd en verpakt volgens exportkwaliteitsnormen.',
                ],
            ],
            [
                'category_id' => $grapes?->id,
                'slug' => 'fresh-grapes',
                'sku' => 'FT-GRP-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Summer',
                'packaging' => 'Carton / Punnet',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Seasonal',
                'is_featured' => true,
                'sort_order' => 2,
                'en' => [
                    'name' => 'Fresh Grapes',
                    'short_description' => 'Fresh grapes prepared for international markets.',
                    'description' => 'High-quality fresh grapes selected from trusted farms and packed for export and wholesale supply.',
                ],
                'ar' => [
                    'name' => 'عنب طازج',
                    'short_description' => 'عنب طازج مجهز للأسواق الدولية.',
                    'description' => 'عنب طازج عالي الجودة يتم اختياره من مزارع موثوقة وتجهيزه للتصدير والتوريد بالجملة.',
                ],
                'nl' => [
                    'name' => 'Verse druiven',
                    'short_description' => 'Verse druiven voorbereid voor internationale markten.',
                    'description' => 'Verse druiven van hoge kwaliteit geselecteerd van betrouwbare boerderijen en verpakt voor export.',
                ],
            ],
            [
                'category_id' => $potatoes?->id,
                'slug' => 'fresh-potato',
                'sku' => 'FT-POT-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Mesh Bags / Carton',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Available',
                'is_featured' => false,
                'sort_order' => 3,
                'en' => [
                    'name' => 'Fresh Potato',
                    'short_description' => 'Fresh potatoes suitable for export and wholesale.',
                    'description' => 'Fresh potatoes available in different sizes and packaging options based on client requirements.',
                ],
                'ar' => [
                    'name' => 'بطاطس طازجة',
                    'short_description' => 'بطاطس طازجة مناسبة للتصدير والتوريد بالجملة.',
                    'description' => 'بطاطس طازجة متوفرة بأحجام وخيارات تعبئة مختلفة حسب احتياجات العميل.',
                ],
                'nl' => [
                    'name' => 'Verse aardappel',
                    'short_description' => 'Verse aardappelen geschikt voor export en groothandel.',
                    'description' => 'Verse aardappelen beschikbaar in verschillende maten en verpakkingsopties volgens klantwensen.',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | New Fruit Products
            |--------------------------------------------------------------------------
            */
            [
                'category_id' => $pomegranates?->id,
                'slug' => 'fresh-pomegranate',
                'sku' => 'FT-POM-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Autumn / Winter',
                'packaging' => 'Carton Box',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Seasonal',
                'is_featured' => true,
                'sort_order' => 4,
                'en' => [
                    'name' => 'Fresh Pomegranate',
                    'short_description' => 'Fresh pomegranates selected for export and wholesale markets.',
                    'description' => 'Premium fresh Egyptian pomegranates carefully selected, sorted, and packed for export, wholesale supply, and international fresh produce markets.',
                ],
                'ar' => [
                    'name' => 'رمان طازج',
                    'short_description' => 'رمان طازج مختار للتصدير وأسواق الجملة.',
                    'description' => 'رمان مصري طازج بجودة مميزة يتم اختياره وفرزه وتعبئته بعناية للتصدير والتوريد بالجملة وأسواق المنتجات الطازجة الدولية.',
                ],
                'nl' => [
                    'name' => 'Verse granaatappel',
                    'short_description' => 'Verse granaatappels geselecteerd voor export en groothandel.',
                    'description' => 'Premium verse Egyptische granaatappels zorgvuldig geselecteerd, gesorteerd en verpakt voor export, groothandel en internationale markten.',
                ],
            ],
            [
                'category_id' => $mangoes?->id,
                'slug' => 'fresh-mango',
                'sku' => 'FT-MNG-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Summer',
                'packaging' => 'Carton Box',
                'size' => 'Medium / Large',
                'grade' => 'Premium Grade',
                'availability' => 'Seasonal',
                'is_featured' => true,
                'sort_order' => 5,
                'en' => [
                    'name' => 'Fresh Mango',
                    'short_description' => 'Premium fresh mangoes prepared for export markets.',
                    'description' => 'Fresh Egyptian mangoes with rich flavor and premium appearance, prepared carefully for fresh produce markets, export supply, and wholesale orders.',
                ],
                'ar' => [
                    'name' => 'مانجو طازجة',
                    'short_description' => 'مانجو طازجة بجودة مميزة مجهزة للتصدير.',
                    'description' => 'مانجو مصرية طازجة بطعم غني ومظهر مميز، يتم تجهيزها بعناية لأسواق المنتجات الطازجة والتصدير وطلبات الجملة.',
                ],
                'nl' => [
                    'name' => 'Verse mango',
                    'short_description' => 'Premium verse mango’s voorbereid voor exportmarkten.',
                    'description' => 'Verse Egyptische mango’s met rijke smaak en premium uitstraling, zorgvuldig voorbereid voor verse markten, export en groothandel.',
                ],
            ],
            [
                'category_id' => $strawberries?->id,
                'slug' => 'fresh-strawberry',
                'sku' => 'FT-STR-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Winter / Spring',
                'packaging' => 'Punnet / Carton',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Seasonal',
                'is_featured' => true,
                'sort_order' => 6,
                'en' => [
                    'name' => 'Fresh Strawberry',
                    'short_description' => 'Fresh strawberries suitable for export and wholesale supply.',
                    'description' => 'High-quality fresh strawberries selected for color, freshness, and export suitability, with flexible packing options according to client requirements.',
                ],
                'ar' => [
                    'name' => 'فراولة طازجة',
                    'short_description' => 'فراولة طازجة مناسبة للتصدير والتوريد بالجملة.',
                    'description' => 'فراولة طازجة عالية الجودة يتم اختيارها حسب اللون والطزاجة ومناسبة التصدير، مع خيارات تعبئة مرنة حسب احتياجات العميل.',
                ],
                'nl' => [
                    'name' => 'Verse aardbei',
                    'short_description' => 'Verse aardbeien geschikt voor export en groothandel.',
                    'description' => 'Verse aardbeien van hoge kwaliteit geselecteerd op kleur, versheid en exportgeschiktheid, met flexibele verpakkingsopties.',
                ],
            ],
            [
                'category_id' => $dates?->id,
                'slug' => 'premium-dates',
                'sku' => 'FT-DAT-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Carton / Retail Pack',
                'size' => 'As Requested',
                'grade' => 'Premium Grade',
                'availability' => 'Available',
                'is_featured' => false,
                'sort_order' => 7,
                'en' => [
                    'name' => 'Premium Dates',
                    'short_description' => 'Premium dates prepared for international trade and supply.',
                    'description' => 'Carefully selected premium dates available in flexible packaging options for export, wholesale supply, and retail distribution.',
                ],
                'ar' => [
                    'name' => 'تمور مميزة',
                    'short_description' => 'تمور مميزة مجهزة للتجارة والتوريد الدولي.',
                    'description' => 'تمور مختارة بعناية ومتوفرة بخيارات تعبئة مرنة مناسبة للتصدير والتوريد بالجملة والتوزيع التجاري.',
                ],
                'nl' => [
                    'name' => 'Premium dadels',
                    'short_description' => 'Premium dadels voorbereid voor internationale handel en levering.',
                    'description' => 'Zorgvuldig geselecteerde premium dadels met flexibele verpakkingsopties voor export, groothandel en retaildistributie.',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | New Vegetable Products
            |--------------------------------------------------------------------------
            */
            [
                'category_id' => $onions?->id,
                'slug' => 'fresh-onion',
                'sku' => 'FT-ONI-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Mesh Bags / Carton',
                'size' => 'Small / Medium / Large',
                'grade' => 'Export Grade',
                'availability' => 'Available',
                'is_featured' => false,
                'sort_order' => 8,
                'en' => [
                    'name' => 'Fresh Onion',
                    'short_description' => 'Fresh onions prepared for export and wholesale markets.',
                    'description' => 'Fresh Egyptian onions available in different sizes and packing options, prepared for export, wholesale supply, and international trade.',
                ],
                'ar' => [
                    'name' => 'بصل طازج',
                    'short_description' => 'بصل طازج مجهز للتصدير وأسواق الجملة.',
                    'description' => 'بصل مصري طازج متوفر بأحجام وخيارات تعبئة مختلفة ومجهز للتصدير والتوريد بالجملة والتجارة الدولية.',
                ],
                'nl' => [
                    'name' => 'Verse ui',
                    'short_description' => 'Verse uien voorbereid voor export en groothandel.',
                    'description' => 'Verse Egyptische uien beschikbaar in verschillende maten en verpakkingsopties, voorbereid voor export en groothandel.',
                ],
            ],
            [
                'category_id' => $garlic?->id,
                'slug' => 'fresh-garlic',
                'sku' => 'FT-GAR-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Mesh Bags / Carton',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Available',
                'is_featured' => false,
                'sort_order' => 9,
                'en' => [
                    'name' => 'Fresh Garlic',
                    'short_description' => 'Fresh garlic selected for export quality and market demand.',
                    'description' => 'Fresh garlic selected and prepared according to export quality standards, suitable for wholesale supply and international markets.',
                ],
                'ar' => [
                    'name' => 'ثوم طازج',
                    'short_description' => 'ثوم طازج مختار بجودة مناسبة للتصدير.',
                    'description' => 'ثوم طازج يتم اختياره وتجهيزه وفق معايير الجودة المناسبة للتصدير والتوريد بالجملة والأسواق الدولية.',
                ],
                'nl' => [
                    'name' => 'Verse knoflook',
                    'short_description' => 'Verse knoflook geselecteerd voor exportkwaliteit.',
                    'description' => 'Verse knoflook geselecteerd en voorbereid volgens exportkwaliteitsnormen, geschikt voor groothandel en internationale markten.',
                ],
            ],
            [
                'category_id' => $sweetPotatoes?->id,
                'slug' => 'fresh-sweet-potato',
                'sku' => 'FT-SWP-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Carton / Mesh Bags',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Available',
                'is_featured' => false,
                'sort_order' => 10,
                'en' => [
                    'name' => 'Fresh Sweet Potato',
                    'short_description' => 'Fresh sweet potatoes prepared for international markets.',
                    'description' => 'Fresh sweet potatoes selected for quality and consistency, available in flexible sizes and packaging options for export and wholesale supply.',
                ],
                'ar' => [
                    'name' => 'بطاطا طازجة',
                    'short_description' => 'بطاطا طازجة مجهزة للأسواق الدولية.',
                    'description' => 'بطاطا طازجة يتم اختيارها بعناية من حيث الجودة والتجانس، ومتوفرة بأحجام وخيارات تعبئة مرنة للتصدير والتوريد بالجملة.',
                ],
                'nl' => [
                    'name' => 'Verse zoete aardappel',
                    'short_description' => 'Verse zoete aardappelen voorbereid voor internationale markten.',
                    'description' => 'Verse zoete aardappelen geselecteerd op kwaliteit en consistentie, beschikbaar in flexibele maten en verpakkingsopties.',
                ],
            ],
            [
                'category_id' => $tomatoes?->id,
                'slug' => 'fresh-tomato',
                'sku' => 'FT-TOM-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Carton Box',
                'size' => 'As Requested',
                'grade' => 'Premium Grade',
                'availability' => 'Available',
                'is_featured' => true,
                'sort_order' => 11,
                'en' => [
                    'name' => 'Fresh Tomato',
                    'short_description' => 'Fresh tomatoes selected for wholesale and export supply.',
                    'description' => 'Fresh tomatoes with strong color and firm texture, selected for wholesale supply, export markets, and fresh produce distribution.',
                ],
                'ar' => [
                    'name' => 'طماطم طازجة',
                    'short_description' => 'طماطم طازجة مختارة للتوريد بالجملة والتصدير.',
                    'description' => 'طماطم طازجة بلون قوي وقوام مناسب، مختارة للتوريد بالجملة وأسواق التصدير وتوزيع المنتجات الطازجة.',
                ],
                'nl' => [
                    'name' => 'Verse tomaat',
                    'short_description' => 'Verse tomaten geselecteerd voor groothandel en export.',
                    'description' => 'Verse tomaten met sterke kleur en stevige structuur, geselecteerd voor groothandel, exportmarkten en distributie.',
                ],
            ],
            [
                'category_id' => $peppers?->id,
                'slug' => 'fresh-pepper',
                'sku' => 'FT-PEP-001',
                'country_of_origin' => 'Egypt',
                'season' => 'Available most of the year',
                'packaging' => 'Carton Box',
                'size' => 'As Requested',
                'grade' => 'Export Grade',
                'availability' => 'Available',
                'is_featured' => false,
                'sort_order' => 12,
                'en' => [
                    'name' => 'Fresh Pepper',
                    'short_description' => 'Fresh peppers prepared for export and fresh produce markets.',
                    'description' => 'Fresh colored peppers selected for appearance, freshness, and export suitability, available with flexible packing options.',
                ],
                'ar' => [
                    'name' => 'فلفل طازج',
                    'short_description' => 'فلفل طازج مجهز للتصدير وأسواق المنتجات الطازجة.',
                    'description' => 'فلفل ألوان طازج يتم اختياره حسب الشكل والطزاجة ومناسبة التصدير، مع خيارات تعبئة مرنة.',
                ],
                'nl' => [
                    'name' => 'Verse paprika',
                    'short_description' => 'Verse paprika’s voorbereid voor export en verse markten.',
                    'description' => 'Verse gekleurde paprika’s geselecteerd op uitstraling, versheid en exportgeschiktheid, met flexibele verpakkingsopties.',
                ],
            ],
        ];

        foreach ($products as $data) {
            if (! $data['category_id']) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'category_id' => $data['category_id'],
                    'sku' => $data['sku'],
                    'country_of_origin' => $data['country_of_origin'],
                    'season' => $data['season'],
                    'packaging' => $data['packaging'],
                    'size' => $data['size'],
                    'grade' => $data['grade'],
                    'availability' => $data['availability'],
                    'is_featured' => $data['is_featured'],
                    'is_active' => true,
                    'sort_order' => $data['sort_order'],
                    'seo_title' => $data['en']['name'],
                    'seo_description' => $data['en']['short_description'],

                    'en' => $data['en'],
                    'ar' => $data['ar'],
                    'nl' => $data['nl'],
                ]
            );
        }
    }
}