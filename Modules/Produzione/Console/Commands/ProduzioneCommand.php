<?php

namespace Modules\Produzione\Console\Commands;

use Illuminate\Console\Command;

class ProduzioneCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ProduzioneCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Produzione Command description';

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
