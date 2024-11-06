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
        Schema::create('config_discounts', function (Blueprint $table) {
            $table->bigIncrements("id_config_discount");
            $table->string("name_discount");
            $table->text("by_id_product");
            $table->text("by_name_product");
            $table->text("by_id_category");
            $table->text("by_sub_id_category");
            $table->text("set_per_id_per_discount");
            $table->integer("discount");
            $table->dateTime("start_event");
            $table->dateTime("end_event");
            $table->integer("active_config");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_discounts');
    }
};
