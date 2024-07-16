<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceResource\Pages;
use App\Filament\Resources\PriceResource\RelationManagers;
use App\Models\Price;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceResource extends Resource
{
    protected static ?string $model = Price::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 // Столбцы для отображения информации о цене
            Tables\Columns\TextColumn::make('product.name')->label('Product Name'),
            Tables\Columns\TextColumn::make('amount')->label('Price'),
            Tables\Columns\TextColumn::make('shop.name')->label('Shop'),
            // Ссылка может быть реализована как HTML-колонка, если вы хотите добавить кнопку или прямую ссылку
            Tables\Columns\TextColumn::make('link')->label('Link')->html(),
            ])
            ->filters([
                // A filter for the product name which is parsed under the 'name' field
            Tables\Filters\Filter::make('Name')
            ->query(fn (Builder $query, string $value): Builder => $query->whereHas('product', fn (Builder $query): Builder => $query->where('name', 'like', '%' . $value . '%'))),
        
             // A filter for the product price which is parsed under the 'price' field
             Tables\Filters\Filter::make('Price')
            ->query(fn (Builder $query, string $value): Builder => $query->where('price', '=', $value)),

            // A filter for the product SKU which is parsed under the 'sku' field
            Tables\Filters\Filter::make('SKU')
            ->query(fn (Builder $query, string $value): Builder => $query->whereHas('product', fn (Builder $query): Builder => $query->where('sku', '=', $value))),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // View action to view detailed information about the price. You need to define the route.
                Tables\Actions\ViewAction::make()
                ->url(fn (Price $record): string => route('prices.show', $record)),

                // Delete action allows you to delete the record
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('export')
        ->action(function (Collection $records) {
            // Your export logic here
        })
        ->icon('heroicon-o-arrow-down')
        ->color('success')
        ->requiresConfirmation(),
    Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrices::route('/'),
            'create' => Pages\CreatePrice::route('/create'),
            'edit' => Pages\EditPrice::route('/{record}/edit'),
        ];
    }
    public static function filters(): array
{
    return [
        Tables\Filters\SelectFilter::make('Shop')->options([
            // Получите список магазинов из базы данных
        ]),
        // Дополнительные фильтры по необходимости
    ];
}

}
