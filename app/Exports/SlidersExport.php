<?php

namespace App\Exports;

use App\Models\Slider;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SlidersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Slider::query()
            ->with('translations')
            ->ordered()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title EN',
            'Title AR',
            'Title NL',
            'Button Link',
            'Status',
            'Sort Order',
            'Created At',
        ];
    }

    public function map($slider): array
    {
        return [
            $slider->id,
            $slider->translate('en')?->title,
            $slider->translate('ar')?->title,
            $slider->translate('nl')?->title,
            $slider->button_link,
            $slider->is_active ? 'Active' : 'Inactive',
            $slider->sort_order,
            $slider->created_at?->format('Y-m-d H:i'),
        ];
    }
}