<?php

namespace controllers;

use services\EventService;

class EventController
{
    public static function createEvent(): string {
        $event = EventService::createEvent(
            "rob",
            "ndj_jxj",
            5,
            4,
            3,
            true,
            "monday"
        );
        return "<pre>" . print_r($event, true);
    }
}