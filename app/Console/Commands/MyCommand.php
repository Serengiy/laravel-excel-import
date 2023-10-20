<?php

namespace App\Console\Commands;

use App\Imports\ProjectDynamicImport;
use App\Imports\ProjectFile;
use App\Imports\ProjectImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Symfony\Component\Console\Command\Command as CommandAlias;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new ProjectDynamicImport(), 'files/projects2.xlsx', 'public');
        return CommandAlias::SUCCESS;
    }
}
