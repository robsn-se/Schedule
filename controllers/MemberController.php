<?php

namespace controllers;

use core\Request;
use services\MemberService;

class MemberController
{
    public static function createMember(): string {
        $member = MemberService::createMember(8555, 88,"ndj_jxj", 1, true);
        return "<pre>" . print_r($member, true);
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
}