<?php

namespace controllers;

use services\PaymentService;

class PaymentController
{
    public static function createPayment(): string {
        $payment = PaymentService::createPayment(8555,55,55,77, [88, 99]);
        return "<pre>" . print_r($payment, true);
    }
}