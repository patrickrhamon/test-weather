<?php

namespace App\Console\Commands;

use App\Mail\SendWeatherLastIP;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = $
        Mail::send(new SendWeatherLastIP($user->id));
    }
}
