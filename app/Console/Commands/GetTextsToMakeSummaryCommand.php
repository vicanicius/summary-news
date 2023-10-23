<?php

namespace App\Console\Commands;

use App\Services\Contracts\SummaryNewsServiceContract;
use Illuminate\Console\Command;

class GetTextsToMakeSummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-texts-to-make-summary-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SummaryNewsServiceContract $service): void
    {
        $service->handle();
    }
}
