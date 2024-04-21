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
            $bodyArray["price_id"],
            $bodyArray["details"]
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

    public static function deletePaymentById(int $id): string {
        PaymentController::deletePaymentById($id);
        echo "Payment {$id} has been deleted successfully";
    }
}