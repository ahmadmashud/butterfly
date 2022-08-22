<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomisiUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_komisi_users', function (Blueprint $table) {
            $table->id();
            $table->integer('id_trx');
            $table->double('amount_km_gro');
            $table->double('amount_km_spv');
            $table->double('amount_km_staff');
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
        Schema::dropIfExists('t_komisi_users');
    }
}
