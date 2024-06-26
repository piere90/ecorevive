<?php

namespace Modules\Ingrediente\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Ingrediente\Models\Ingrediente;

class IngredienteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Ingredientes Seed
         * ------------------
         */

        // DB::table('ingrediente')->truncate();
        // echo "Truncate: ingrediente \n";

        Ingrediente::factory()->count(20)->create();
        $rows = Ingrediente::all();
        echo " Insert: ingrediente \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
