<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formula_ingredienti', function (Blueprint $table) {
            $table->unsignedBigInteger('id_formula'); // ID della formula
            $table->unsignedBigInteger('id_ingrediente'); // ID dell'ingrediente
            $table->float('quantita')->nullable(); // Quantità dell'ingrediente

            // Definisci le chiavi esterne
            $table->foreign('id_formula')->references('numero')->on('formula')->onDelete('cascade');
            $table->foreign('id_ingrediente')->references('id')->on('ingrediente')->onDelete('cascade');

            $table->primary(['id_formula', 'id_ingrediente']); // Chiave primaria composta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formula_ingredienti');
    }
};
