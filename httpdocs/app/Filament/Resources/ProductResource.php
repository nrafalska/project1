<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form as FilamentForm;
use SomeOtherNamespace\Form as AnotherForm;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ... other form components
                
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->placeholder('Enter product SKU'),
                    
                DateTimePicker::make('last_updated')
                    ->label('Last Updated')
                    ->required()
                    ->format('Y-m-d H:i:s')
                    ->placeholder('Select last update date and time'),
                    
                Repeater::make('links')
                    ->label('Product Links')
                    ->schema([
                        TextInput::make('url')
                            ->label('URL')
                            ->url()
                            ->placeholder('Enter product URL for a store')
                    ])
                    ->minItems(1)
                    ->maxItems(10)
                    ->createItemButtonLabel('Add store link'),
                    
                // ... other form components
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Product Name')
                ->sortable()
                ->searchable(),
            TextColumn::make('price')
                ->label('Price')
                ->sortable()
                ->searchable(),
            // Добавьте здесь другие колонки...
            ])
            ->filters([
                // Текстовый фильтр для поиска по имени продукта
                Tables\Filters\Filter::make('name')
                    ->form([
                        TextInput::make('name')
                            ->label('Product Name'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query->where('name', 'like', '%' . $data['name'] . '%')),
    
                // Выпадающий фильтр для фильтрации по статусу продукта
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->label('Status'),
    
                // Диапазонный фильтр для фильтрации по цене продукта
                Tables\Filters\Filter::make('price')
                    ->form([
                        TextInput::make('min_price')
                            ->numeric()
                            ->label('Min Price'),
                        TextInput::make('max_price')
                            ->numeric()
                            ->label('Max Price'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query->whereBetween('price', [$data['min_price'] ?? 0, $data['max_price'] ?? PHP_INT_MAX])),
            ])
            ->actions([
                // Действие редактирования
                Tables\Actions\EditAction::make(),
    
                // Действие удаления
                Tables\Actions\DeleteAction::make(),
    
                
            ])
            ->bulkActions([
                // Массовое действие удаления
            Tables\Actions\DeleteBulkAction::make(),

            // Пользовательское массовое действие
            Tables\Actions\BulkAction::make('custom_bulk_action')
                ->label('Custom Bulk Action')
                ->action(function (Collection $records) {
                    // Логика выполнения пользовательского массового действия с выбранными записями
                })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Менеджер отношений для категорий
            RelationManagers\CategoriesRelationManager::class,
    
            // Менеджер отношений для тегов
            RelationManagers\TagsRelationManager::class,
    
            // Добавьте здесь другие менеджеры отношений...
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            
        ];
    }
  
}
