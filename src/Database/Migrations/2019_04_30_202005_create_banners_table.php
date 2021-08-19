<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('titulo', 255)->nullable();
            $table->string('subtitulo', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('link_name', 255)->nullable()->comment('Texto do botão de link');
            $table->string('imagem', 255)->nullable();
            $table->string('imagem_2', 255)->nullable();
            $table->string('tipo', 255)->nullable();
            
            $table->string('dias_semana', 255)->nullable();
            
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();
            
            $table->date('data_inicio')->nullable();
            $table->date('data_termino')->nullable();

            $table->integer('order')->nullable();
            $table->tinyInteger('ativo')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
