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
        Schema::table('produzione', function (Blueprint $table) {
            $table->integer('created_by')->unsigned()->nullable()->after('cliente'); // replace 'existing_column' with the column name after which you want to add this column
            $table->integer('updated_by')->unsigned()->nullable()->after('created_by');
            $table->integer('deleted_by')->unsigned()->nullable()->after('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produzione', function (Blueprint $table) {
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
    }
};
