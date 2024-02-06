<?php

namespace services;

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
}