<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{
    public function redirectCheckOut(Request $request)
    {
        $data = session()->get('cart');
        $amount = 0;
        foreach ($data as $item) {
            $amount += $item['price'] * $item['qty'];
        }
        $payload = [
            'merchantID' => config('octoverse.redirect_merchant_id'),
            'frontendUrl' => route('home'),
            'backendUrl' => route('octoverse.backend.redirect-callback'),
            'currencyCode' => 'MMK',
            'amount' => $amount,
            'invoiceNo' => config('octoverse.invoice_prefix') . uniqid()
        ];
        $payData = JWT::encode($payload, config('octoverse.redirect_merchant_secret_key'), 'HS256');
        $paymentTokenData = Http::post(config('octoverse.base_url') . 'auth/token', ["payData" => $payData])->json()['data'];
        //TODO amount less than amount
        $paymentToken = JWT::decode($paymentTokenData, new Key(config('octoverse.redirect_merchant_secret_key'), 'HS256'));
        return redirect()->away($paymentToken->paymenturl);
    }

    public function checkout(Request $request)
    {
        if ($request->isMethod("get") == true) {
            if (session()->has('cart') && count(session()->get('cart')) > 0) {
                $cart = session()->get('cart');
                return view('checkout', compact('cart'));
            }
            Toastr::info('Your Cart is Empty', 'INFO');
            return back();
        }
    }
}
