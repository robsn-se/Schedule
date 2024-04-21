<?php

namespace controllers;

use core\Request;
use services\PriceService;

class PriceController
{
    public static function createPrice(): string {
        $bodyArray = Request::getBodyArray();
        $price = PriceService::createPrice($bodyArray["date"], $bodyArray["duration"], $bodyArray["sum"]);
        return "<pre>" . print_r($price->toArray(), true);
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

    public static function deletePriceById(int $id): string {
        PriceService::deletePriceById($id);
        echo "Price {$id} has been deleted successfully";
    }
}