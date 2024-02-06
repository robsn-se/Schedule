<?php

namespace services;

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
}