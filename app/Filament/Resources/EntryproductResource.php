<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntryproductResource\Pages;
use App\Filament\Resources\EntryproductResource\RelationManagers;
use App\Models\Entryproduct;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Set;
use Filament\Forms\Components\DateTimePicker;

class EntryproductResource extends Resource
{
    protected static ?string $model = Entryproduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([  
                DateTimePicker::make('date_of_entry'),
                Select::make('id_product')
                    ->label('Product Name')
                    ->options(Product::all()->pluck('name_product', 'id_product'))
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $set('total_price', Product::find($get('id_product'))->price);
                    })
                    ->searchable(),
                TextInput::make('delivery_owner')->label('Supplier'),
                TextInput::make('qty')->label('Quantity')->numeric()->live(onBlur:true)->afterStateUpdated(function(Get $get , Set $set){

                  
                     $set('total_price' , ($get('total_price') * $get('qty')));


                }),
                TextInput::make('user_id')->label("Created By")->readOnly()->default(fn () => Auth::user()->name),
                TextInput::make('user_accept')->label("User Verify")->readOnly()->default(fn () => Auth::user()->name),
                TextInput::make('status_entry')->label('Status Data')->default("0")->readonly(),
                Toggle::make('status_payment')->label("Payment Status"),
                TextInput::make('code_bank')->label('Bank Code'),
                TextInput::make('number_card')->label('Number Card'),
                TextInput::make('discount')->label('Discount')->live(onBlur: true)->afterStateUpdated(function (Get $get, Set $set) {
                   $priceBasic = $get('total_price');
                   $discount = $get('discount');
                   $total_discount = $priceBasic*($discount/100);

                   $set('total_discount' , $total_discount);
                   $set('total_price' , ($priceBasic - $total_discount));
                })->numeric(),
                TextInput::make('total_discount')->label('Total Discount')->numeric()->readonly(),
                TextInput::make('total_price')->label('Total Price')->readonly(),
                FileUpload::make('image_checking')->directory('/public/uploads')->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('product.name_product')->label("Product Name")->searchable(),
                TextColumn::make('qty')->label("Quantity"),
                TextColumn::make('discount')->label("Discount"),
                TextColumn::make('total_discount')->label("Total Discount"),
                TextColumn::make('delivery_owner')->label("Supplier"),
                TextColumn::make('total_price')->label("Total Price"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEntryproducts::route('/'),
            'create' => Pages\CreateEntryproduct::route('/create'),
            'edit' => Pages\EditEntryproduct::route('/{record}/edit'),
        ];
    }
}
