<?php

namespace services;

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
}