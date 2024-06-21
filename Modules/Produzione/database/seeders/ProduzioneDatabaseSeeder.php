<?php

namespace Modules\Produzione\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Produzione\Models\Produzione;

class ProduzioneDatabaseSeeder extends Seeder
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
         * Produzione Seed
         * ------------------
         */

        // DB::table('produzione')->truncate();
        // echo "Truncate: produzione \n";

        Produzione::factory()->count(20)->create();
        $rows = Produzione::all();
        echo " Insert: produzione \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
