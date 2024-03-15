<?php

namespace controllers;

use core\Request;
use services\PaymentService;

class PaymentController
{
    public static function createPayment(): string {
        $payment = PaymentService::createPayment(8555,55,55,77, [88, 99]);
        return "<pre>" . print_r($payment, true);
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