<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CategoriesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Category::query()
            ->with(['translations', 'parent.translations'])
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
            'Parent',
            'Slug',
            'Status',
            'Sort Order',
            'Created At',
        ];
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->translate('en')?->name,
            $category->translate('ar')?->name,
            $category->translate('nl')?->name,
            $category->parent?->translate('en')?->name,
            $category->slug,
            $category->is_active ? 'Active' : 'Inactive',
            $category->sort_order,
            $category->created_at?->format('Y-m-d H:i'),
        ];
    }
}