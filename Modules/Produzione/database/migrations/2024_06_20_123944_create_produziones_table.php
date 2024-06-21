<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produzione', function (Blueprint $table) {

            $table->bigIncrements('numero_produzione'); // Colonna ID primaria con auto-incremento
            $table->dateTime('data_reale')->nullable(); // Campo datetime con default NULL
            $table->date('data')->nullable(); // Campo date con default NULL
            $table->unsignedBigInteger('codice_prodotto')->nullable(); // Campo varchar(45) con default NULL
            $table->unsignedBigInteger('id_user')->nullable(); // Campo varchar(45) con default NULL
            $table->integer('progressivo')->nullable(); // Campo int con default NULL
            $table->integer('peso')->nullable(); // Campo int con default NULL
            $table->integer('versione')->nullable(); // Campo int con default NULL
            $table->text('note')->nullable(); // Campo text con default NULL
            $table->string('fila', 45)->nullable(); // Campo varchar(45) con default NULL
            $table->text('stato')->nullable(); // Campo text con default NULL
            $table->string('codice_univoco', 45)->nullable(); // Campo varchar(45) con default NULL
            $table->date('data_spedizione')->nullable(); // Campo date con default NULL
            $table->text('cliente')->nullable(); // Campo text con default NULL
            $table->timestamps();
            $table->softDeletes();

            // Definisci le chiavi esterne
            $table->foreign('codice_prodotto')->references('n_prodotto')->on('prodotto')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produzione');
    }
};
