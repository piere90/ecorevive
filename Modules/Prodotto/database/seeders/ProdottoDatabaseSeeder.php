<?php

namespace Modules\Prodotto\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Prodotto\Models\Prodotto;

class ProdottoDatabaseSeeder extends Seeder
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
         * Prodottos Seed
         * ------------------
         */

        // DB::table('prodottos')->truncate();
        // echo "Truncate: prodottos \n";

        Prodotto::factory()->count(20)->create();
        $rows = Prodotto::all();
        echo " Insert: prodottos \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
