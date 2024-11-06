<?php

namespace App\Filament\Resources\EntryproductResource\Pages;

use App\Filament\Resources\EntryproductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEntryproduct extends CreateRecord
{
    protected static string $resource = EntryproductResource::class;


    protected function handleRecordCreation(array $data): Model
    {
        $record =  static::getModel()::create($data);

        $stokOld = Product::find($data['id_product'])->stock;

        $newStock = ($stokOld + $data['qty']);

        $product = Product::where('id_product', $data['id_product'])
            ->update([
                'stock' => $newStock,
            ]);


        return $record;
    }
}
