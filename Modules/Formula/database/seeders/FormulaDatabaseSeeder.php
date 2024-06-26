<?php

namespace Modules\Formula\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Formula\Models\Formula;

class FormulaDatabaseSeeder extends Seeder
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
         * Formulas Seed
         * ------------------
         */

        // DB::table('formulas')->truncate();
        // echo "Truncate: formulas \n";

        Formula::factory()->count(20)->create();
        $rows = Formula::all();
        echo " Insert: formulas \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
