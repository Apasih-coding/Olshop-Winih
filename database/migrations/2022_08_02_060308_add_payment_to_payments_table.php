<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // $table->dropColumn('name');
            // $table->dropColumn('description');
            // $table->foreignId('order_id')->after('id');
            // $table->foreignId('user_id')->after('order_id');
            // $table->foreignId('product_id')->after('user_id');
            // $table->integer('total_price')->after('product_id');
            // $table->string('bank')->after('total_price');
            // $table->bigInteger('no_rekening')->after('bank');
            // $table->bigInteger('tujuan_rekening')->after('no_rekening');
            // $table->string('nama_rekening')->after('tujuan_rekening');
            // $table->date('tanggal_transfer')->after('nama_rekening');
            // $table->string('bukti_transfer')->after('tanggal_transfer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
