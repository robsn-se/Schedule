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
        int $project_id,
    ): Price {
        $price = new Price();
        $price->setDate($date);
        $price->setDuration($duration);
        $price->setSum($sum);
        $price->setProjectId($project_id);
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
        if (!$price->getId()) {
            throw new SystemFailure("Price ID `{$id}` not found!");
        }
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

    public static function deletePriceById(int $id): void {
        $price = new Price($id);
        $price->delete();
        unset($price);
    }
}