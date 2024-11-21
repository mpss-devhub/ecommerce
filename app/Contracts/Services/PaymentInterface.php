<?php

namespace App\Contracts\Services;

interface PaymentInterface
{
    public function encodeJWT($payload, $secretkey);
    public function decodeJWT($token, $secretkey);
    public function encryptPayload($payload, $secretKey);
    public function decryptPayload($payload, $secretKey);
    public function getPaymentToken($payData, $url);
    public function getAvailablePaymentsList($accessToken, $paymentToken, $url);
    public function processPayment($accessToken, $paymentToken, $paymentCode, $payData, $url);
    public function updateDirectPaymentSuccess($request);
}
