<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('sobrenome', 100);
            $table->string('email', 30)->unique();
            $table->string('password');
            $table->boolean('access_level')->default(0);
            $table->string('foto')->nullable();
            $table->string('capa')->nullable();
            $table->string('genero')->nullable();
            $table->string('tipo_conta')->default('normal');
            $table->date('data_nasc')->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('url', 150)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
