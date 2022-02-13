<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductSalesInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sales_invoice', function($table){
            $table->bigIncrements('id');
            $table->bigInteger('sales_invoice_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('rate_per_product');
            $table->integer('qty_ordered');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoice')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');

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
