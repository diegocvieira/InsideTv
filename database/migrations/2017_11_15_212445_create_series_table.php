<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', '100')->nullable();
            $table->string('titulo_original', '100')->unique();
            $table->string('slug', '100')->unique();
            $table->string('sinopse', '5000')->nullable();
            $table->string('poster', '50')->nullable();
            $table->string('capa', '50')->nullable();
            $table->date('data_lancamento')->nullable();
            $table->string('trailer', '200')->nullable();
            $table->integer('emissora_id')->unsigned();
            $table->foreign('emissora_id')->references('id')->on('emissoras')->onDelete('cascade');
            $table->integer('status')->comment('0-Em producao. 1-Em andamento. 2-Completa. 3-Cancelada');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('series');
    }
}
