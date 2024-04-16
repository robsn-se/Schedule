<?php

namespace controllers;

use core\Request;
use services\PaymentService;

class PaymentController
{
    public static function createPayment(): string {
        $bodyArray = Request::getBodyArray();
        $payment = PaymentService::createPayment(
            $bodyArray["date"],
            $bodyArray["project_id"],
            $bodyArray["user_id"],
            $bodyArray["date"],
            $bodyArray["price_id"]
        );
        return "<pre>" . print_r($payment->toArray(), true);
    }

    public static function updatePayment(int $id): string {
        $bodyArray = Request::getBodyArray();
        $payment = PaymentService::updatePayment($id, $bodyArray);
        return "<pre>" . print_r($payment->toArray(), true);
    }

    public static function getAllPayments(): string {
        $payments = PaymentService::getAllPayments();
        foreach ($payments as $key => $payment) {
            $payments[$key] = $payment->toArray();
        }
        return "<pre>" . print_r($payments, true);
    }
}