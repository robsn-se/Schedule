<?php

namespace services;

use models\Project;


class ProjectService
{
    public static function createProject
    (
        string $name,
        int $userId,
        bool $active
    ): Project {
        $project = new Project();
        $project->setName($name);
        $project->setUserId($userId);
        $project->setActive($active);
        $project->save();
        return $project;
    }
}