<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BookingResource extends Resource {
	protected static ?string $model = Booking::class;

	protected static ?string $slug = 'bookings';

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

	public static function form( Schema $schema ): Schema {
		return $schema
			->components( [
				Select::make( 'customer_id' )
				      ->relationship( 'customer', 'name' )
				      ->searchable()
				      ->required(),

				Select::make( 'product_id' )
				      ->relationship( 'product', 'name' )
				      ->searchable()
				      ->required(),

				DatePicker::make( 'start_date' ),

				DatePicker::make( 'end_date' ),

				TextInput::make( 'status' )
				         ->required(),

				TextInput::make( 'base_fee' )
				         ->required()
				         ->numeric(),

				TextInput::make( 'deposit' )
				         ->required()
				         ->numeric(),

				TextInput::make( 'cleaning_fee' )
				         ->required()
				         ->numeric(),

				TextInput::make( 'late_fee' )
				         ->required()
				         ->numeric(),

				TextInput::make( 'damage_fee' )
				         ->required()
				         ->numeric(),

				TextInput::make( 'total_amount' )
				         ->required()
				         ->numeric(),

				DatePicker::make( 'returned_at' )
				          ->label( 'Returned Date' ),

				TextEntry::make( 'created_at' )
				         ->label( 'Created Date' )
				         ->state( fn( ?Booking $record ): string => $record?->created_at?->diffForHumans() ?? '-' ),

				TextEntry::make( 'updated_at' )
				         ->label( 'Last Modified Date' )
				         ->state( fn( ?Booking $record ): string => $record?->updated_at?->diffForHumans() ?? '-' ),
			] );
	}

	public static function table( Table $table ): Table {
		return $table
			->columns( [
				TextColumn::make( 'customer.name' )
				          ->searchable()
				          ->sortable(),

				TextColumn::make( 'product.name' )
				          ->searchable()
				          ->sortable(),

				TextColumn::make( 'start_date' )
				          ->date(),

				TextColumn::make( 'end_date' )
				          ->date(),

				TextColumn::make( 'status' ),

				TextColumn::make( 'base_fee' ),

				TextColumn::make( 'deposit' ),

				TextColumn::make( 'cleaning_fee' ),

				TextColumn::make( 'late_fee' ),

				TextColumn::make( 'damage_fee' ),

				TextColumn::make( 'total_amount' ),

				TextColumn::make( 'returned_at' )
				          ->label( 'Returned Date' )
				          ->date(),
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
			'index'  => Pages\ListBookings::route( '/' ),
			'create' => Pages\CreateBooking::route( '/create' ),
			'edit'   => Pages\EditBooking::route( '/{record}/edit' ),
		];
	}

	public static function getGlobalSearchEloquentQuery(): Builder {
		return parent::getGlobalSearchEloquentQuery()->with( [ 'customer', 'product' ] );
	}

	public static function getGloballySearchableAttributes(): array {
		return [ 'customer.name', 'product.name' ];
	}

	public static function getGlobalSearchResultDetails( Model $record ): array {
		$details = [];

		if ( $record->customer ) {
			$details['Customer'] = $record->customer->name;
		}

		if ( $record->product ) {
			$details['Product'] = $record->product->name;
		}

		return $details;
	}
}
