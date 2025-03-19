<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;

class ClearSession extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clear';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the session data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Session::flush();
        $this->info('Session cleared successfully.');
    }
}
