<?php

namespace Modules\Prodotto\Console\Commands;

use Illuminate\Console\Command;

class ProdottoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ProdottoCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prodotto Command description';

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
