<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource {
	protected static ?string $model = Product::class;

	protected static ?string $slug = 'products';

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

	public static function form( Schema $schema ): Schema {
		return $schema
			->components( [
				TextInput::make( 'name' )
				         ->required(),

				TextInput::make( 'sku' )
				         ->required(),

				TextInput::make( 'size' )
				         ->required(),

				TextInput::make( 'color' )
				         ->required(),

				TextInput::make( 'rental_price' )
				         ->required()
				         ->numeric(),

				TextInput::make( 'status' )
				         ->required(),

                Textarea::make( 'condition_notes' )
				         ->required(),

//				TextEntry::make( 'created_at' )
//				         ->label( 'Created Date' )
//				         ->state( fn( ?Product $record ): string => $record?->created_at?->diffForHumans() ?? '-' ),
//
//				TextEntry::make( 'updated_at' )
//				         ->label( 'Last Modified Date' )
//				         ->state( fn( ?Product $record ): string => $record?->updated_at?->diffForHumans() ?? '-' ),
			] );
	}

	public static function table( Table $table ): Table {
		return $table
			->columns( [
				TextColumn::make( 'name' )
				          ->searchable()
				          ->sortable(),

				TextColumn::make( 'sku' ),

				TextColumn::make( 'size' ),

				TextColumn::make( 'color' ),

				TextColumn::make( 'rental_price' ),

				TextColumn::make( 'status' ),

				TextColumn::make( 'condition_notes' ),
			] )
			->filters( [
				//
			] )
			->recordActions( [
				EditAction::make(),
				DeleteAction::make(),
			] )
			->toolbarActions( [
				BulkActionGroup::make( [
					DeleteBulkAction::make(),
				] ),
			] );
	}

	public static function getPages(): array {
		return [
			'index'  => Pages\ListProducts::route( '/' ),
			'create' => Pages\CreateProduct::route( '/create' ),
			'edit'   => Pages\EditProduct::route( '/{record}/edit' ),
		];
	}

	public static function getGloballySearchableAttributes(): array {
		return [ 'name' ];
	}
}
