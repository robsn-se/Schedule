<?php

namespace services;

use exceptions\SystemFailure;
use models\Price;

class PriceService
{
    public static function createPrice
    (
        string $date,
        int $duration,
        int $sum,
        bool $active
    ): Price {
        $price = new Price();
        $price->setDate($date);
        $price->setDuration($duration);
        $price->setSum($sum);
        $price->setActive($active);
        $price->save();
        return $price;
    }

    /**
     * @throws SystemFailure
     */
    public static function updatePrice
    (
        int $id,
        array $fields
    ): Price {
        $price = new Price($id);
        foreach ($fields as $key => $value) {
            $camelKey = $price->snakeToCamel($key);
            $price->{"set" . ucfirst($camelKey)}($value);
        }
        $price->save();
        return $price->get();
    }

    /**
     * @return Price[]
     */
    public static function getAllPrices(): array {
        return Price::getAll();
    }
}