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
        Schema::create('formula', function (Blueprint $table) {
            $table->bigIncrements('numero'); // Colonna ID primaria con auto-incremento
            $table->dateTime('data')->nullable(); // Campo datetime con default NULL
            $table->string('prodotto');
            $table->unsignedBigInteger('id_prodotto')->nullable();
            $table->integer('versione')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            // Campo JSON (identifica la formula, gli ingredienti che possiede) per salvare ulteriori campi riferiti a un modello che identificano la formula
            $table->json('elenco_formule')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Definisci le chiavi esterne
            $table->foreign('id_prodotto')->references('n_prodotto')->on('prodotto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formula');
    }
};
