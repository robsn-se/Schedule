<?php

namespace controllers;

use core\Request;
use services\ProjectService;

class ProjectController
{
    public static function createProject(): string {
        $bodyArray = Request::getBodyArray();
        $project = ProjectService::createProject($bodyArray["name"], $bodyArray["user_id"], $bodyArray["delay_time"]);
        return "<pre>" . print_r($project->toArray(), true);
    }

    public static function updateProject(int $id): string {
        $bodyArray = Request::getBodyArray();
        $project = ProjectService::updateProject($id, $bodyArray);
        return "<pre>" . print_r($project->toArray(), true);
    }

    public static function getAllProjects(): string {
        $projects = ProjectService::getAllProjects();
        foreach ($projects as $key => $project) {
            $projects[$key] = $project->toArray();
        }
        return "<pre>" . print_r($projects, true);
    }

    public static function deleteProjectById(int $id): string {
        ProjectService::deleteProjectById($id);
        return "Project {$id} has been deleted successfully";
    }
}