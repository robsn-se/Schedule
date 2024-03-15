<?php

namespace services;

use exceptions\SystemFailure;
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
    /**
     * @throws SystemFailure
     */
    public static function updateProject
    (
        int $id,
        array $fields
    ): Project {
        $project = new Project($id);
        foreach ($fields as $key => $value) {
            $camelKey = $project->snakeToCamel($key);
            $project->{"set" . ucfirst($camelKey)}($value);
        }
        $project->save();
        return $project->get();
    }
    /**
     * @return Project[]
     */
    public static function getAllProjects(): array {
        return Project::getAll();
    }
}