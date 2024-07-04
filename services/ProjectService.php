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
        string $delay_time
    ): Project {
        $project = new Project();
        $project->setName($name);
        $project->setUserId($userId);
        $project->setDelayTime($delay_time);
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
        if (!$project->getId()) {
            throw new SystemFailure("Project ID `{$id}` not found!");
        }
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

    public static function getProjectById(int $id): Project {
       return new Project($id);
    }

    public static function deleteProjectById(int $id): void {
        $project = new Project($id);
        $project->delete();
        unset($project);
    }
}