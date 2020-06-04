<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\pay_hook;

class subscribe_check extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:check';

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
     * @return mixed
     */
    public function handle() {
        $pays = pay_hook::all();
        
        foreach($pays as $pay) {
            $req = json_decode($pay->request);
            $pay->status = $req->eventType;
            $pay->save();
            
            /*if($req->eventType == 'RenewalSuccess')
                dd($req);//*/

            echo $req->eventType;
            if (isset($req->subscriptionId))
                echo  " - "  . $req->paymentAccount . ' - ' . $req->subscriptionId . ' - ' . $req->transactionId;
            echo "\r\n";
        }
        //dd(json_decode($req->eventType));
    }
}
