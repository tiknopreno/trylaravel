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
        Schema::create('entry_products', function (Blueprint $table) {
            $table->bigIncrements("id_entry_product");
            $table->foreignId("id_product")->references('id_product')->on('products')->onDelete('cascade');
            $table->integer("qty");
            $table->double("total_price");
            $table->string("delivery_owner" , 30);
            $table->string("user_id" , 30);
            $table->string("user_accept" , 30);
            $table->integer("status_entry");
            $table->integer("status_payment");
            $table->string("code_bank")->nullable();
            $table->string("number_card")->nullable();
            $table->integer("discount");
            $table->double("total_discount");
            $table->text("image_checking")->nullable();
            $table->dateTime("date_of_entry");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_products');
    }
};
