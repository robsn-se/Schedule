<?php

namespace services;

use exceptions\SystemFailure;
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

    /**
     * @throws SystemFailure
     */
    public static function updatePayment
    (
        int $id,
        array $fields
    ): Payment {
        $payment = new Payment($id);
        foreach ($fields as $key => $value) {
            $camelKey = $payment->snakeToCamel($key);
            $payment->{"set" . ucfirst($camelKey)}($value);
        }
        $payment->save();
        return $payment->get();
    }


    /**
     * @return Payment[]
     */
    public static function getAllPayments(): array {
        return Payment::getAll();
    }
}