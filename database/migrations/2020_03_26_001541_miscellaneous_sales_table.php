<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MiscellaneousSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('miscellaneous_sales', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('sales_invoice_id')->unsigned();
            $table->bigInteger('misc_id')->unsigned();
            $table->integer('rate');
            $table->integer('qty_ordered');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoice')->onDelete('restrict');
            $table->foreign('misc_id')->references('id')->on('miscellaneous')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
