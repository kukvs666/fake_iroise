<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGabaritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gabarit', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id')->unique();
            $table->string('template_gabarit', 500);
            $table->bigInteger('type_id')->unique();
            $table->string('type', 100);
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
        Schema::dropIfExists('gabarit');
    }
}
