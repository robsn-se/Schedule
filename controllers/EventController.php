<?php

namespace controllers;

use core\Request;
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

    public static function updateEvent(int $id): string {
        $bodyArray = Request::getBodyArray();
        $event = EventService::updateEvent($id, $bodyArray);
        return "<pre>" . print_r($event->toArray(), true);
    }

    public static function getAllEvents(): string {
        $events = EventService::getAllEvents();
        foreach ($events as $key => $event) {
            $events[$key] = $event->toArray();
        }
        return "<pre>" . print_r($events, true);
    }
}