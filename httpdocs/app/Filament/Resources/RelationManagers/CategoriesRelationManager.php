<?php

namespace App\Filament\Resources\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    public function table(Tables\Table $table): Tables\Table // Изменено на нестатический метод
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Category Name'),
            // Добавьте здесь другие колонки...
        ]);
    }

    // Другие методы...
}
