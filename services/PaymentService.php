<?php

namespace services;

use models\Payment;

class PaymentService
{
    public static function createPayment
    (
        string $date,
        int $projectId,
        int $userId,
        int $priceId,
        array $details
    ): Payment {
        $payment = new Payment();
        $payment->setDate($date);
        $payment->setProjectId($projectId);
        $payment->setUserId($userId);
        $payment->setPriceId($priceId);
        $payment->setDetails($details);
        $payment->save();
        return $payment;
    }
}