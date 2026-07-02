<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::query()
            ->with(['translations', 'category.translations'])
            ->ordered()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name EN',
            'Name AR',
            'Name NL',
            'Category',
            'SKU',
            'Slug',
            'Featured',
            'Status',
            'Sort Order',
            'Created At',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->translate('en')?->name,
            $product->translate('ar')?->name,
            $product->translate('nl')?->name,
            $product->category?->translate('en')?->name,
            $product->sku,
            $product->slug,
            $product->is_featured ? 'Yes' : 'No',
            $product->is_active ? 'Active' : 'Inactive',
            $product->sort_order,
            $product->created_at?->format('Y-m-d H:i'),
        ];
    }
}