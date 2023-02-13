<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class StoreEtudiant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:etudiants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'afficher liste etudiant';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getActiveSheet(storage_path('data/Data.xlsx'));

        $this->comment('liste affiché OK');
        // return Command::SUCCESS;
    }
    private function getActiveSheet(string $path):worksheet
    {
        (new Xlsx)
        ->load($path) 
        ->getActiveSheet();

    }
}
