<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\subscription;
use App\Models\pay_hook;
use App\Services\ccbill;
use App\Models\user;

class subscribeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cardId' => 'required'
        ]);

        $user = Auth::user();
        $user->newSubscription('FitnessAdult', 'montly')
            ->create($request->cardId, [
                'email' => $user->email
            ]);
        dd($user);

        return response()->json(null, 201);
    }

    public function ccbillHook(Request $request){
        pay_hook::create([
            'request' => json_encode($request->all())
        ]);

        if (isset($request->eventType)) {
            switch ($request->eventType) {
                case "NewSaleFailure":
                    break;

                case "NewSaleSuccess":
                    $userID = $request->{'X-userID'};
                    $user = user::findOrFail($userID);
            
                    $user->Subscription()->create([
                        'name' => 'subscription',
                        'stripe_id' => $request->subscriptionId,
                        'stripe_plan' => 1,
                        'quantity' => 1,
                        'trial_ends_at' => $request->nextRenewalDate,
                        'ends_at' => $request->nextRenewalDate,
                    ]);

                    break;

                case "RenewalSuccess":
                    //echo "Renewal";
                    $subscribe = subscription::where('stripe_id', $request->subscriptionId)->first();
                    $subscribe->update(['ends_at' => $request->renewalDate]);
                    //print_r($request);
                    break;
            }
        }

        return response()->json(null, 200);
    }

    public function link(Request $request, ccbill $bill){
        $user = $request->user();
        $link = $bill->GetPayLink($user);

        return response()->json(['link' => $link], 200);
    }
}
