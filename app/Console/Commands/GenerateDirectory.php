<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateDirectory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'directory:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate some directories required by the application.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->book = public_path('file/book');
        $this->conference = public_path('file/conference');
        $this->haki = public_path('file/haki');
        $this->innovation = public_path('file/innovation');
        $this->journal = public_path('file/journal');
        $this->poster = public_path('file/poster');
        $this->partner = public_path('file/partner');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directories = [$this->book, $this->conference, $this->haki, $this->innovation, $this->journal, $this->poster, $this->partner];
        foreach ($directories as $directory) {
            $check = File::isDirectory($directory);
            if (!$check) {
                File::makeDirectory($directory, 0777, true, true);
            }
        }

        $this->info('Required directories have been generated');
    }
}
