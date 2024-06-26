<?php

namespace Modules\Formula\Console\Commands;

use Illuminate\Console\Command;

class FormulaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:FormulaCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Formula Command description';

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
