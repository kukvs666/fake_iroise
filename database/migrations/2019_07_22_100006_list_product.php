<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_product', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id')->unique();
            $table->bigInteger('products_id')->unsigned();
            $table->bigInteger('teaser_id')->unsigned();
            $table->timestamps();
            $table->foreign('products_id')
                  ->references('id')
                  ->on('products')
                  ->onDelet('restrict')
                  ->onUpdate('restrict');
            $table->foreign('teaser_id')
                  ->references('id')
                  ->on('teaser')
                  ->onDelet('restrict')
                  ->onUpdate('restrict');
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
