<?php

namespace App\Filament\Resources\EntryproductResource\Pages;

use App\Filament\Resources\EntryproductResource;
use App\Models\Entryproduct;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class EditEntryproduct extends EditRecord
{
    protected static string $resource = EntryproductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(function (Entryproduct $record) {

                $idproduct = $record->id_product;
                $qty = $record->qty;
                $stokOld = Product::find($idproduct)->stock;

                $newStock = ($stokOld - $qty);


                Product::where('id_product', $idproduct)
                    ->update([
                        'stock' => $newStock,
                    ]);
            }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $stokOld = Product::find($data['id_product'])->stock;

        $newStock = ($data['qty'] - $stokOld);

        $product = Product::where('id_product', $data['id_product'])
            ->update([
                'stock' => $newStock + $stokOld,
            ]);


        return $record;
    }
}
