<?php

namespace controllers;

use services\ProjectService;

class ProjectController
{
    public static function createProject(): string {
        $project = ProjectService::createProject("robsnCA","4512225", true);
        return "<pre>" . print_r($project, true);
    }
}