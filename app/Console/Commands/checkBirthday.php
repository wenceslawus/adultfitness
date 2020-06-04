<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class checkBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make notify for birthday';

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
    public function handle() {
        echo "Get user with birthday\r\n";
        $dt = Carbon::now();

        $admin = User::admin();
        $users = User::where("birthday", $dt->format('Y-m-d'))
            ->get();

        foreach($users as $user) {
            echo "{$user->name} birthday was on {$user->birthday->format('M d')}". "\r\n";

            /*$admin->Notifies()->create([
                'text' => "User '{$user->name}' upload new video",
                'state' => 0,
                'route' => 'profile.videos',
            ]);//*/
        }
    }
}
