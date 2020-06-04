<?php
namespace App\Services;

class ccbill {
	public function GetPayLink($user) {
		/*$link = 'https://bill.ccbill.com/jpost/signup.cgi?'.
			'language=English&'.
			'allowedTypes=0000034663:1:840&'.
			'subscriptionTypeId=0000034663:1:840&'.
			'formName=211cc&'.
			'clientAccnum='.config('ccbill.account').'&'.
			'clientSubacc='.config('ccbill.subaccount').'&'.//*/
		$link = 'https://api.ccbill.com/wap-frontflex/flexforms/325c0698-f09d-4a9d-a39a-858524771795?'.
			"userID=$user->id&".
			"email=$user->email";

		return $link;
	}

	public function SubscribeStatus($subscribeID) {
		$link = 'https://datalink.ccbill.com/utils/subscriptionManagement.cgi?'.
			'action=viewSubscriptionStatus&'.
			'clientAccnum='.config('ccbill.account').'&'.
			//'usingSubacc='.config('ccbill.subaccount').'&'.
			'username='.config('ccbill.user').'&'.
			'password='.config('ccbill.password').'&'.
			"subscriptionId=$subscribeID";

			return $link;
	}
}
