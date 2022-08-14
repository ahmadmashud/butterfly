<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_food_drinks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('id_category_food_drink')->nullable();
            $table->string('nama');
            $table->double('harga');
            $table->double('stock')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_food_drinks');
    }
}
