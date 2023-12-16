<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('email')->unique();
            $table->date('data_nasc')->default('1990-01-01');
            $table->string('cpf', 11)->unique();
            $table->string('password');
            $table->enum('tipo', ['comum', 'admin', 'medico'])->default('comum');
            $table->string('funcao')->default('paciente');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}