<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do installation for Scaffold Laravel';

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
     * @return mixed
     */
    public function handle()
    {
        $this->setAppKeyIfNecessary();
        $this->runMigrationsIfNecessary();
    }

    /**
     * Sets the application key if it's not currently set to anything
     *
     * @return void
     */
    private function setAppKeyIfNecessary()
    {
        $key = config('app.key');

        if (!empty($key)) return;

        $this->call('key:generate');
    }

    /**
     * Runs any database migrations (and seeds data) if they haven't
     * run previously.
     *
     * @return void
     */
    private function runMigrationsIfNecessary()
    {
        if (Schema::hasTable('migrations')) return;

        $this->call('migrate', [
            '--seed' => true
        ]);
    }
}
