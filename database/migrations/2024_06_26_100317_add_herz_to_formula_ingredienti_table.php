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
        Schema::table('formula_ingredienti', function (Blueprint $table) {
            $table->string('herz')->nullable()->after('quantita'); // Herz dell'ingrediente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formula_ingredienti', function (Blueprint $table) {
            $table->dropColumn('herz');
        });
    }
};
