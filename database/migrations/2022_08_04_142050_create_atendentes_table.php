<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendentes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('numero');
            $table->foreignId('setor_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('mensagem_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable();
            // $table->unsignedBigInteger('client_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('atendentes');
    }
}
