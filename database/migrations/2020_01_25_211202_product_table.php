<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('product_name_id');
            $table->integer('make_id');
            $table->integer('model_id')->unsigned();
            $table->integer('quantity');
            $table->integer('cost');
            $table->string('additional_info')->nullable();
            $table->string('grn')->nullable();
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('models')->onDelete('restrict');

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
