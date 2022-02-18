<?php

namespace App\Console\Commands;

use App\Mail\SendWeatherLastIP;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    public $user_service;
    public $user_id;
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
    public function __construct() {
        parent::__construct();
        $this->user_service = new UserService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = $this->user_service->findAll();

        foreach ($users as $user) {
            Mail::send(new SendWeatherLastIP($user->id));
        }
    }
}
