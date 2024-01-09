<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

protected $addHttpCookie = true;


protected $except = [
    'paytm-callback','paytm-callback-app','paytm-callback-wallet','premierpay/response','onlinepay/response','newthankyou','paytmserver','/wallet/ipaywalletresponse','/wallet/ipayappwalletresponse','qrcode-callback','tableipayresponse','senangpay/serverresponse'
    ];
}
