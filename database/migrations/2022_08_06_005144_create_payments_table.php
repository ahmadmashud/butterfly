<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_transaction');
            $table->string('metode_pembayaran');
            $table->double('amount_cash')->nullable();
            $table->double('amount_credit')->nullable();
            $table->double('amount_total')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_rek')->nullable();
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
        Schema::dropIfExists('t_payments');
    }
}
