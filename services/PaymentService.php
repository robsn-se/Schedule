<?php

namespace services;

use exceptions\SystemFailure;
use models\Payment;

class PaymentService
{
    public static function createPayment
    (
        string $date,
        int $userId,
        int $priceId,
        string $details
    ): Payment {
        $payment = new Payment();
        $payment->setDate($date);
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
        if (!$payment->getId()) {
            throw new SystemFailure("Project ID `{$id}` not found!");
        }
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

    public static function deletePaymentById(int $id): void {
        $payment = new Payment($id);
        $payment->delete();
        unset($payment);
    }
}