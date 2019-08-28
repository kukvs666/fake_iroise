<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing',function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id')->unique();
            $table->bigInteger('sell_unit_id')->unsigned();
            $table->bigInteger('list_product_id')->unsigned();
            $table->bigInteger('min')->nullable();
            $table->bigInteger('max')->nullable();
            $table->bigInteger('base')->nullable();
            $table->string('desc_calibre')->nullable();
            $table->bigInteger('price')->unsigned();
            $table->string('format', 100);
            $table->timestamps();
            $table->foreign('sell_unit_id')
                  ->references('id')
                  ->on('sell_unit')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->foreign('list_product_id')
                  ->references('id')
                  ->on('list_product')
                  ->onDelete('restrict')
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
        Schema::dropIfExists('packing');
    }
}
