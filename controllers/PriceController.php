<?php

namespace controllers;

use services\PriceService;

class PriceController
{
    public static function createPrice(): string {
        $price = PriceService::createPrice(02.02,"800", 899, true);
        return "<pre>" . print_r($price, true);
    }
}