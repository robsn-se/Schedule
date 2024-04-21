<?php

namespace controllers;

use core\Request;
use services\MemberService;

class MemberController
{
    public static function createMember(): string {
        $bodyArray = Request::getBodyArray();
        $member = MemberService::createMember(
            $bodyArray["user_id"],
            $bodyArray["project_id"],
            $bodyArray["name"],
            $bodyArray["status"]
        );
        return "<pre>" . print_r($member->toArray(), true);
    }

    public static function updateMember(int $id): string {
        $bodyArray = Request::getBodyArray();
        $member = MemberService::updateMember($id, $bodyArray);
        return "<pre>" . print_r($member->toArray(), true);
    }

    public static function getAllMembers(): string {
        $members = MemberService::getAllMembers();
        foreach ($members as $key => $member) {
            $members[$key] = $member->toArray();
        }
        return "<pre>" . print_r($members, true);
    }

    public static function deleteMemberById(int $id): string {
        MemberService::deleteMemberById($id);
        echo "Member {$id} has been deleted successfully";
    }
}