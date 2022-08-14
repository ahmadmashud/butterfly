<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_package_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('nama');
            $table->double('harga');
            $table->double('km_terapis');
            $table->double('km_supplier');
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
        Schema::dropIfExists('m_package_rooms');
    }
}
