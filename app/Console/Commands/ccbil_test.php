<?php

namespace App\Console\Commands;

use App\Services\ccbill;
use Illuminate\Console\Command;
use App\Models\user;

class ccbil_test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ccbill:test';

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

    protected $tdata = '{"accountingAmount":"4.99","accountingCurrency":"USD","accountingCurrencyCode":"840","billedAmount":"4.99","billedCurrency":"USD","billedCurrencyCode":"840","cardType":"VISA","clientAccnum":"951647","clientSubacc":"0000","expDate":"0323","last4":"0610","nextRenewalDate":"2019-08-01","paymentAccount":"7f406898906424ee100000009553771","paymentType":"CREDIT","subscriptionId":"0119185402000000238","timestamp":"2019-07-02 16:12:09","transactionId":"0119183201000049527","renewalDate":"2019-07-02","eventType":"RenewalSuccess","eventGroupType":"Subscription"}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ccbill $bill) {
        /*echo($bill->GetPayLink(user::first()));
        echo "\r\n";
        echo($bill->SubscribeStatus('0000034663'));
        echo "\r\n";
        //*/
        $request = json_decode($this->tdata);

        $data = [];
        foreach($request as $key => $value) {
            $data[$key] = $value;
        }

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://localhost:8000/api/payhook',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);


        dd($resp);
        /*dd($request);
        $userID = $request->{'X-userID'};
        $user = user::findOrFail($userID);

        $user->Subscription()->create([
            'name' => 'subscription',
            'stripe_id' => $request->subscriptionId,
            'stripe_plan' => 1,
            'quantity' => 1,
            'trial_ends_at' => $request->nextRenewalDate,
            'ends_at' => $request->nextRenewalDate,
        ]);//*/
    }
}
