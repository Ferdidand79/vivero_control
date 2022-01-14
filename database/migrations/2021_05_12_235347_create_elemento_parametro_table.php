<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementoParametroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemento_parametro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elemento_id')->constrained('elementos')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('parametro_id')->constrained('parametros');
            $table->string('valor');
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
        Schema::dropIfExists('elemento_parametro');
    }
}
