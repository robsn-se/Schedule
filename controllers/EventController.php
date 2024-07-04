<?php

namespace controllers;

use core\Request;
use services\EventService;

class EventController
{
    public static function createEvent(): string {
        $bodyArray = Request::getBodyArray();
        $event = EventService::createEvent(
            $bodyArray["name"],
            $bodyArray["description"],
            $bodyArray["project_id"],
            $bodyArray["from_time"],
            $bodyArray["to_time"],
            $bodyArray["week_days"],
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

    public static function deleteEventById(int $id): string {
        EventService::deleteEventById($id);
        return "Event {$id} has been deleted successfully";
    }
}