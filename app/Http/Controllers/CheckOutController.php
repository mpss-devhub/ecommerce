<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yoeunes\Toastr\Facades\Toastr;

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
        // Handle GET request for displaying the checkout page
        if ($request->isMethod("get")) {
            if (session()->has('cart') && count(session()->get('cart')) > 0) {
                $cart = session()->get('cart');
                $amount = 0;

                // Calculate total amount
                foreach ($cart as $item) {
                    $amount += $item['price'] * $item['qty'];
                }

                // Prepare payload for the payment token
                $payload = [
                    'merchantID' => config('octoverse.direct_merchant_id'),
                    'frontendUrl' => route('home'),
                    'backendUrl' => route('octoverse.backend.redirect-callback'),
                    'currencyCode' => 'MMK',
                    'amount' => $amount,
                    'invoiceNo' => config('octoverse.invoice_prefix') . uniqid()
                ];

                // Encode and send for token generation
                $payData = JWT::encode($payload, config('octoverse.direct_merchant_secret_key'), 'HS256');
                $paymentTokenData = Http::post(config('octoverse.base_url') . 'auth/token', ["payData" => $payData])->json()['data'];
                $decodedToken = JWT::decode($paymentTokenData, new Key(config('octoverse.direct_merchant_secret_key'), 'HS256'));

                // Store tokens in session
                session([
                    'accessToken' => $decodedToken->accessToken,
                    'paymentToken' => $decodedToken->paymentToken,
                ]);

                $accessToken = session('accessToken');
                $paymentToken = session('paymentToken');

                // Get available payment methods
                $response = Http::withHeaders([
                    'Authorization' => "Bearer $accessToken"
                ])->post(config('octoverse.base_url') . 'getAvailablePaymentsList', ["paymentToken" => $paymentToken])->json()['data']['paymentList'];

                // Return checkout view with cart and response data
                return view('checkout', compact('cart', 'response'));
            }
            Toastr::info('Your Cart is Empty', 'INFO');
            return back();
        }

        // Handle POST request for processing payment
        $accessToken = session('accessToken');
        $paymentToken = session('paymentToken');

        // Collect payment details from the request
        $jwtPayload = [
            "phoneNo" => $request->input('phoneNo'),
            "email" => $request->input('email'),
            "name" => $request->input('name')
        ];

        // Encrypt the payment data
        $encodedPayload = openssl_encrypt(json_encode($jwtPayload), "AES-128-ECB", config('octoverse.direct_merchant_data_key'), OPENSSL_RAW_DATA);
        $base64EncodedPayload = rtrim(base64_encode($encodedPayload), '=');

        // Post payment data to the payment API
        $response = Http::withHeaders([
            'Authorization' => "Bearer $accessToken"
        ])->post(config('octoverse.base_url') . 'dopay', [
            "paymentToken" => $paymentToken,
            "paymentCode" => $request->payment_code,
            "payData" => $base64EncodedPayload
        ]);

        // Handle the response
        $responseData = $response->json();
        if ($responseData["respCode"] === "0000" && isset($responseData["data"])) {
            if (isset($responseData["data"]["qrImg"])) {
                return response()->json(['qrImg' => $responseData["data"]["qrImg"]]);
            } elseif (isset($responseData["data"]["redirectUrl"])) {
                return redirect()->away($responseData["data"]["redirectUrl"]);
            } else {
                Toastr::info($responseData["data"], 'INFO');
                return redirect()->route('home');
            }
        }

        Toastr::info($responseData["respMsg"], 'INFO');
        return back();
    }
}
