<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementoPlagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemento_plaga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elemento_id')->constrained('elementos')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('plaga_id')->constrained('plagas');
            $table->string('valor');
            $table->enum('nivel',['0','1','2']);
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
        Schema::dropIfExists('elemento_plaga');
    }
}
