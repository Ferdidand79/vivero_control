<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVincularTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vincular', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planta_id')->constrained('plantas');
            $table->foreignId('parametro_id')->constrained('parametros');
            $table->string('valor_min');
            $table->string('valor_max');
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
        Schema::dropIfExists('vincular');
    }
}
