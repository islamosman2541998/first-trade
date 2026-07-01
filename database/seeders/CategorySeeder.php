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
    }
}