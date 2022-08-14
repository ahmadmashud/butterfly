<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomisiTerapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_komisi_terapis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_trx');
            $table->integer('id_terapis');
            $table->double('amount_km_paket');
            $table->integer('sesi');
            $table->double('amount_km_produk');
            $table->double('amount_km_total');
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
        Schema::dropIfExists('t_komisi_terapis');
    }
}
