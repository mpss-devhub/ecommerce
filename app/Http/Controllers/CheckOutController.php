<?php

namespace App\Http\Controllers;

use App\Http\Services\PaymentService;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class CheckOutController extends Controller
{
    protected $paymentInterface;

    public function __construct(PaymentService $paymentInterface)
    {
        $this->paymentInterface = $paymentInterface;
    }

    public function redirectCheckOut()
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
        $payData = $this->paymentInterface->encodeJWT($payload, config('octoverse.redirect_merchant_secret_key'));
        $paymentTokenData = $this->paymentInterface->getPaymentToken($payData, config('octoverse.base_url') . 'auth/token');
        $paymentToken = $this->paymentInterface->decodeJWT($paymentTokenData, config('octoverse.redirect_merchant_secret_key'));

        return redirect()->away($paymentToken->paymenturl);
    }

    public function checkout(Request $request)
    {
        if ($request->isMethod("get")) {
            if (session()->has('cart') && count(session()->get('cart')) > 0) {
                $cart = session()->get('cart');
                $amount = 0;
                foreach ($cart as $item) {
                    $amount += $item['price'] * $item['qty'];
                }
                $payload = [
                    'merchantID' => config('octoverse.direct_merchant_id'),
                    'frontendUrl' => route('home'),
                    'backendUrl' => route('octoverse.backend.redirect-callback'),
                    'currencyCode' => 'MMK',
                    'amount' => $amount,
                    'invoiceNo' => config('octoverse.invoice_prefix') . uniqid()
                ];
                $payData = $this->paymentInterface->encodeJWT($payload, config('octoverse.direct_merchant_secret_key'));
                $paymentTokenData = $this->paymentInterface->getPaymentToken($payData, config('octoverse.base_url') . 'auth/token');
                $decodedToken = $this->paymentInterface->decodeJWT($paymentTokenData, config('octoverse.direct_merchant_secret_key'));
                session([
                    'accessToken' => $decodedToken->accessToken,
                    'paymentToken' => $decodedToken->paymentToken,
                ]);
                $accessToken = session('accessToken');
                $paymentToken = session('paymentToken');
                $response = $this->paymentInterface->getAvailablePaymentsList($accessToken, $paymentToken, config('octoverse.base_url') . 'getAvailablePaymentsList');
                return view('checkout', compact('cart', 'response'));
            }
            Toastr::info('Your Cart is Empty', 'INFO');
            return back();
        }
        $accessToken = session('accessToken');
        $paymentToken = session('paymentToken');
        $jwtPayload = [
            "phoneNo" => $request->input('phoneNo'),
            "email" => $request->input('email'),
            "name" => $request->input('name')
        ];
        $encodedPayload = $this->paymentInterface->encryptPayload($jwtPayload, config('octoverse.direct_merchant_data_key'));
        $response = $this->paymentInterface->processPayment($accessToken, $paymentToken,  $request->input('selectedPaymentCode'), $encodedPayload, config('octoverse.base_url') . 'dopay');
        if ($response["respCode"] === "0000" && isset($response["data"])) {
            $type = isset($response["data"]["qrImg"]) ? "QR" : (isset($response["data"]["deeplink"]) ? "DEEP_LINK" : "MESSAGE");
            $data = $response["data"]["qrImg"] ?? $response["data"]["deeplink"] ?? $response["data"];

            return response()->json([
                "status" => $response["respCode"],
                "data" => [
                    "type" => $type,
                    "data" => $data
                ]
            ]);
        }
        return response()->json([
            "status" => $response["respCode"],
            "message" => $response["respMsg"]
        ]);
    }
}
