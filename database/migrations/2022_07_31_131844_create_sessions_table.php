<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('waktu_per_sesi')->unique();
            $table->integer('minimum_sesi');
            $table->double('harga')->nullable();
            $table->double('discount');
            $table->double('discount_sesi_ke');
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
        Schema::dropIfExists('m_sessions');
    }
}
