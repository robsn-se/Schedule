<?php

namespace controllers;

use core\Request;
use services\PriceService;

class PriceController
{
    public static function createPrice(): string {
        $price = PriceService::createPrice(02.02,"800", 899, true);
        return "<pre>" . print_r($price, true);
    }

    public static function updatePrice(int $id): string {
        $bodyArray = Request::getBodyArray();
        $price = PriceService::updatePrice($id, $bodyArray);
        return "<pre>" . print_r($price->toArray(), true);
    }

    public static function getAllPrices(): string {
        $prices = PriceService::getAllPrices();
        foreach ($prices as $key => $price) {
            $prices[$key] = $price->toArray();
        }
        return "<pre>" . print_r($prices, true);
    }
}