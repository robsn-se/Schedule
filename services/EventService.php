<?php

namespace services;

use exceptions\SystemFailure;
use models\Event;

class EventService
{
    public static function createEvent
    (
        string $name,
        string $description,
        int $projectId,
        int $fromTime,
        int $toTime,
        bool $active,
        string $weekDays
    ): Event {
        $event = new Event();
        $event->setName($name);
        $event->setDescription($description);
        $event->setProjectId($projectId);
        $event->setFromTime($fromTime);
        $event->setToTime($toTime);
        $event->setActive($active);
        $event->setWeekDays($weekDays);
        $event->save();
        return $event;
    }

    /**
     * @throws SystemFailure
     */
    public static function updateEvent
    (
        int $id,
        array $fields
    ): Event {
        $event = new Event($id);
        foreach ($fields as $key => $value) {
            $camelKey = $event->snakeToCamel($key);
            $event->{"set" . ucfirst($camelKey)}($value);
        }
        $event->save();
        return $event->get();
    }

    /**
     * @return Event[]
     */
    public static function getAllEvents(): array {
        return Event::getAll();
    }
}