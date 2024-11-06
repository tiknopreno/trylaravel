<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements("id_product");
            $table->string("name_product" , 50);
            $table->string("category_product" , 30);
            $table->string("sub_category_product" , 30);
            $table->double("price");
            $table->bigInteger("stock");
            $table->integer("is_active");
            $table->text("image_product")->nullable();
            $table->text("product_gallery")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
