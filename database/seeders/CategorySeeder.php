<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Parent Categories
        |--------------------------------------------------------------------------
        */

        $freshFruits = Category::updateOrCreate(
            ['slug' => 'fresh-fruits'],
            [
                'parent_id' => null,
                'sort_order' => 1,
                'is_active' => true,
                'seo_title' => 'Fresh Fruits',
                'seo_description' => 'A premium selection of fresh fruits for import and export.',

                'en' => [
                    'name' => 'Fresh Fruits',
                    'description' => 'A premium selection of fresh fruits for import and export.',
                ],
                'ar' => [
                    'name' => 'الفاكهة الطازجة',
                    'description' => 'تشكيلة مميزة من الفاكهة الطازجة للاستيراد والتصدير.',
                ],
                'nl' => [
                    'name' => 'Vers fruit',
                    'description' => 'Een premium selectie vers fruit voor import en export.',
                ],
            ]
        );

        $freshVegetables = Category::updateOrCreate(
            ['slug' => 'fresh-vegetables'],
            [
                'parent_id' => null,
                'sort_order' => 2,
                'is_active' => true,
                'seo_title' => 'Fresh Vegetables',
                'seo_description' => 'High-quality fresh vegetables prepared for international trade.',

                'en' => [
                    'name' => 'Fresh Vegetables',
                    'description' => 'High-quality fresh vegetables prepared for international trade.',
                ],
                'ar' => [
                    'name' => 'الخضروات الطازجة',
                    'description' => 'خضروات طازجة عالية الجودة مجهزة للتجارة الدولية.',
                ],
                'nl' => [
                    'name' => 'Verse groenten',
                    'description' => 'Verse groenten van hoge kwaliteit voor internationale handel.',
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Fresh Fruits Children
        |--------------------------------------------------------------------------
        */

        Category::updateOrCreate(
            ['slug' => 'citrus'],
            [
                'parent_id' => $freshFruits->id,
                'sort_order' => 1,
                'is_active' => true,
                'seo_title' => 'Citrus',
                'seo_description' => 'Fresh citrus products selected for export quality.',

                'en' => [
                    'name' => 'Citrus',
                    'description' => 'Fresh citrus products selected for export quality.',
                ],
                'ar' => [
                    'name' => 'الموالح',
                    'description' => 'منتجات موالح طازجة مختارة بجودة مناسبة للتصدير.',
                ],
                'nl' => [
                    'name' => 'Citrus',
                    'description' => 'Verse citrusproducten geselecteerd voor exportkwaliteit.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'grapes'],
            [
                'parent_id' => $freshFruits->id,
                'sort_order' => 2,
                'is_active' => true,
                'seo_title' => 'Grapes',
                'seo_description' => 'Fresh grapes prepared for international markets.',

                'en' => [
                    'name' => 'Grapes',
                    'description' => 'Fresh grapes prepared for international markets.',
                ],
                'ar' => [
                    'name' => 'العنب',
                    'description' => 'عنب طازج مجهز للأسواق الدولية.',
                ],
                'nl' => [
                    'name' => 'Druiven',
                    'description' => 'Verse druiven voorbereid voor internationale markten.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'pomegranates'],
            [
                'parent_id' => $freshFruits->id,
                'sort_order' => 3,
                'is_active' => true,
                'seo_title' => 'Pomegranates',
                'seo_description' => 'Fresh pomegranates selected for export and wholesale supply.',

                'en' => [
                    'name' => 'Pomegranates',
                    'description' => 'Fresh pomegranates selected for export and wholesale supply.',
                ],
                'ar' => [
                    'name' => 'الرمان',
                    'description' => 'رمان طازج مختار للتصدير والتوريد بالجملة.',
                ],
                'nl' => [
                    'name' => 'Granaatappels',
                    'description' => 'Verse granaatappels geselecteerd voor export en groothandel.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'mangoes'],
            [
                'parent_id' => $freshFruits->id,
                'sort_order' => 4,
                'is_active' => true,
                'seo_title' => 'Mangoes',
                'seo_description' => 'Fresh mangoes prepared for premium fresh produce markets.',

                'en' => [
                    'name' => 'Mangoes',
                    'description' => 'Fresh mangoes prepared for premium fresh produce markets.',
                ],
                'ar' => [
                    'name' => 'المانجو',
                    'description' => 'مانجو طازجة مجهزة لأسواق المنتجات الطازجة المميزة.',
                ],
                'nl' => [
                    'name' => 'Mango’s',
                    'description' => 'Verse mango’s voorbereid voor premium markten voor verse producten.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'strawberries'],
            [
                'parent_id' => $freshFruits->id,
                'sort_order' => 5,
                'is_active' => true,
                'seo_title' => 'Strawberries',
                'seo_description' => 'Fresh strawberries suitable for export and wholesale markets.',

                'en' => [
                    'name' => 'Strawberries',
                    'description' => 'Fresh strawberries suitable for export and wholesale markets.',
                ],
                'ar' => [
                    'name' => 'الفراولة',
                    'description' => 'فراولة طازجة مناسبة للتصدير وأسواق الجملة.',
                ],
                'nl' => [
                    'name' => 'Aardbeien',
                    'description' => 'Verse aardbeien geschikt voor export en groothandel.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'dates'],
            [
                'parent_id' => $freshFruits->id,
                'sort_order' => 6,
                'is_active' => true,
                'seo_title' => 'Dates',
                'seo_description' => 'Premium dates prepared for international trade and supply.',

                'en' => [
                    'name' => 'Dates',
                    'description' => 'Premium dates prepared for international trade and supply.',
                ],
                'ar' => [
                    'name' => 'التمور',
                    'description' => 'تمور مميزة مجهزة للتجارة والتوريد الدولي.',
                ],
                'nl' => [
                    'name' => 'Dadels',
                    'description' => 'Premium dadels voorbereid voor internationale handel en levering.',
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Fresh Vegetables Children
        |--------------------------------------------------------------------------
        */

        Category::updateOrCreate(
            ['slug' => 'potatoes'],
            [
                'parent_id' => $freshVegetables->id,
                'sort_order' => 1,
                'is_active' => true,
                'seo_title' => 'Potatoes',
                'seo_description' => 'Fresh potatoes suitable for export and wholesale supply.',

                'en' => [
                    'name' => 'Potatoes',
                    'description' => 'Fresh potatoes suitable for export and wholesale supply.',
                ],
                'ar' => [
                    'name' => 'البطاطس',
                    'description' => 'بطاطس طازجة مناسبة للتصدير والتوريد بالجملة.',
                ],
                'nl' => [
                    'name' => 'Aardappelen',
                    'description' => 'Verse aardappelen geschikt voor export en groothandel.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'onions'],
            [
                'parent_id' => $freshVegetables->id,
                'sort_order' => 2,
                'is_active' => true,
                'seo_title' => 'Onions',
                'seo_description' => 'Fresh onions prepared for export and wholesale markets.',

                'en' => [
                    'name' => 'Onions',
                    'description' => 'Fresh onions prepared for export and wholesale markets.',
                ],
                'ar' => [
                    'name' => 'البصل',
                    'description' => 'بصل طازج مجهز للتصدير وأسواق الجملة.',
                ],
                'nl' => [
                    'name' => 'Uien',
                    'description' => 'Verse uien voorbereid voor export en groothandel.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'garlic'],
            [
                'parent_id' => $freshVegetables->id,
                'sort_order' => 3,
                'is_active' => true,
                'seo_title' => 'Garlic',
                'seo_description' => 'Fresh garlic selected for export quality and market demand.',

                'en' => [
                    'name' => 'Garlic',
                    'description' => 'Fresh garlic selected for export quality and market demand.',
                ],
                'ar' => [
                    'name' => 'الثوم',
                    'description' => 'ثوم طازج مختار بجودة مناسبة للتصدير واحتياجات السوق.',
                ],
                'nl' => [
                    'name' => 'Knoflook',
                    'description' => 'Verse knoflook geselecteerd voor exportkwaliteit en marktvraag.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'sweet-potatoes'],
            [
                'parent_id' => $freshVegetables->id,
                'sort_order' => 4,
                'is_active' => true,
                'seo_title' => 'Sweet Potatoes',
                'seo_description' => 'Fresh sweet potatoes prepared for international fresh produce markets.',

                'en' => [
                    'name' => 'Sweet Potatoes',
                    'description' => 'Fresh sweet potatoes prepared for international fresh produce markets.',
                ],
                'ar' => [
                    'name' => 'البطاطا',
                    'description' => 'بطاطا طازجة مجهزة لأسواق المنتجات الطازجة الدولية.',
                ],
                'nl' => [
                    'name' => 'Zoete aardappelen',
                    'description' => 'Verse zoete aardappelen voorbereid voor internationale markten.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'tomatoes'],
            [
                'parent_id' => $freshVegetables->id,
                'sort_order' => 5,
                'is_active' => true,
                'seo_title' => 'Tomatoes',
                'seo_description' => 'Fresh tomatoes selected for wholesale and export supply.',

                'en' => [
                    'name' => 'Tomatoes',
                    'description' => 'Fresh tomatoes selected for wholesale and export supply.',
                ],
                'ar' => [
                    'name' => 'الطماطم',
                    'description' => 'طماطم طازجة مختارة للتوريد بالجملة والتصدير.',
                ],
                'nl' => [
                    'name' => 'Tomaten',
                    'description' => 'Verse tomaten geselecteerd voor groothandel en export.',
                ],
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'peppers'],
            [
                'parent_id' => $freshVegetables->id,
                'sort_order' => 6,
                'is_active' => true,
                'seo_title' => 'Peppers',
                'seo_description' => 'Fresh peppers prepared for export and fresh produce markets.',

                'en' => [
                    'name' => 'Peppers',
                    'description' => 'Fresh peppers prepared for export and fresh produce markets.',
                ],
                'ar' => [
                    'name' => 'الفلفل',
                    'description' => 'فلفل طازج مجهز للتصدير وأسواق المنتجات الطازجة.',
                ],
                'nl' => [
                    'name' => 'Paprika’s',
                    'description' => 'Verse paprika’s voorbereid voor export en markten voor verse producten.',
                ],
            ]
        );
    }
}