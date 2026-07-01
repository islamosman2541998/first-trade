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

        $products = [
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
        ];

        foreach ($products as $data) {
            if (!$data['category_id']) {
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