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
    ): Member {
        $member = new Member();
        $member->setUserId($userId);
        $member->setProjectId($projectId);
        $member->setName($name);
        $member->setStatus($status);
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
        if (!$member->getId()) {
            throw new SystemFailure("Member ID `{$id}` not found!");
        }
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

    public static function deleteMemberById(int $id): void {
        $member = new Member($id);
        $member->delete();
        unset($member);
    }
}