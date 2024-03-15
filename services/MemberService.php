<?php

namespace services;

use exceptions\SystemFailure;
use models\Member;

class MemberService
{
    public static function createMember
    (
        int $userId,
        int $projectId,
        string $name,
        int $status,
        bool $active
    ): Member {
        $member = new Member();
        $member->setUserId($userId);
        $member->setProjectId($projectId);
        $member->setName($name);
        $member->setStatus($status);
        $member->setActive($active);
        $member->save();
        return $member;
    }

    /**
     * @throws SystemFailure
     */
    public static function updateMember
    (
        int $id,
        array $fields
    ): Member {
        $member = new Member($id);
        foreach ($fields as $key => $value) {
            $camelKey = $member->snakeToCamel($key);
            $member->{"set" . ucfirst($camelKey)}($value);
        }
        $member->save();
        return $member->get();
    }


    /**
     * @return Member[]
     */
    public static function getAllMembers(): array {
        return Member::getAll();
    }
}