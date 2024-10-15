<?php

namespace App\Http\Services;

use App\Contracts\Services\paymentInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Http;

class PaymentService implements paymentInterface
{
    public function encodeJWT($payload, $secretKey)
    {
        return JWT::encode($payload, $secretKey, 'HS256');
    }

    public function decodeJWT($token, $secretKey)
    {
        return JWT::decode($token, new Key($secretKey, 'HS256'));
    }

    public function encryptPayload($payload, $secretKey)
    {
        $encodedPayload = openssl_encrypt(json_encode($payload), "AES-128-ECB", $secretKey, OPENSSL_RAW_DATA);
        return rtrim(base64_encode($encodedPayload), '=');
    }

    public function getPaymentToken($payData, $url)
    {
        return Http::post($url, ["payData" => $payData])->json()['data'];
    }

    public function getAvailablePaymentsList($accessToken, $paymentToken, $url)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $accessToken"
        ])->post($url, ["paymentToken" => $paymentToken])->json()['data']['paymentList'];
    }

    public function processPayment($accessToken, $paymentToken, $paymentCode, $payData, $url)
    {
        return Http::withHeaders([
            'Authorization' => "Bearer $accessToken"
        ])->post($url, [
            "paymentToken" => $paymentToken,
            "paymentCode" => $paymentCode,
            "payData" => $payData
        ])->json();
    }
}
