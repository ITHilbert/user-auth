<?php

namespace ITHilbert\UserAuth\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\ComposerScripts;


class UserAuthCopyFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userauth:copyfiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kopiert die UserAuth Dateien ins Projekt';

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
        //Laravel UI
        $this->info('Dateien werden kopiert');

        //UserAuth Dateien kopieren
        exec('php artisan vendor:publish --provider="ITHilbert\UserAuth\UserAuthServiceProvider" --force');

        return 0;
    }
}
