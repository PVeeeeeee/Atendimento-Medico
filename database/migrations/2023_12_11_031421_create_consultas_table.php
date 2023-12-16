<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_comum_id');
            $table->unsignedBigInteger('user_medico_id');
            $table->foreign('user_comum_id')->references('id')->on('users');
            $table->foreign('user_medico_id')->references('id')->on('users');
            $table->date('data_consulta');
            $table->time('hora_consulta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}