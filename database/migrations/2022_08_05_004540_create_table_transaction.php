<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trx_no')->nullable();
            $table->string('nama_pelanggan');
            $table->integer('id_loker');
            $table->integer('id_room');
            $table->date('tanggal');
            $table->integer('jumlah_sesi');
            $table->integer('durasi');
            $table->dateTime('tanggal_masuk')->nullable();
            $table->dateTime('tanggal_keluar')->nullable();
            $table->integer('id_paket');
            $table->integer('id_produk');
            $table->integer('id_terapis');
            $table->integer('id_sales');
            $table->integer('id_supplier');
            $table->double('amount_harga_paket');
            $table->double('amount_discount');
            $table->integer('discount_sesi_ke');
            $table->double('amount_total_discount');
            $table->double('amount_harga_paket_setelah_diskon');
            $table->double('amount_harga_produk');
            $table->double('amount_total_fnd');
            $table->double('amount_total');
            $table->double('amount_service_charge');
            $table->double('amount_total_service_charge');
            $table->double('amount_grand_total');
            $table->double('pajak_term');
            $table->double('amount_total_pajak');
            $table->string('status');
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
        Schema::dropIfExists('t_transactions');
    }
}
