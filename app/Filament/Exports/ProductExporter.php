<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name'),
            ExportColumn::make('slug'),
            ExportColumn::make('sku')
                ->label('SKU'),
            ExportColumn::make('description'),
            ExportColumn::make('short_description'),
            ExportColumn::make('price'),
            ExportColumn::make('compare_price'),
            ExportColumn::make('cost_per_item'),
            ExportColumn::make('quantity'),
            ExportColumn::make('weight'),
            ExportColumn::make('dimensions'),
            ExportColumn::make('category.name')
                ->label('Category'),
            ExportColumn::make('brand.name')
                ->label('Brand'),
            ExportColumn::make('is_featured'),
            ExportColumn::make('is_active'),
            ExportColumn::make('meta_title'),
            ExportColumn::make('meta_description'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
