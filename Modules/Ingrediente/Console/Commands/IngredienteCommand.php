<?php

namespace Modules\Ingrediente\Console\Commands;

use Illuminate\Console\Command;

class IngredienteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:IngredienteCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingrediente Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
