<?php

namespace controllers;

use services\MemberService;

class MemberController
{
    public static function createMember(): string {
        $member = MemberService::createMember(8555, 88,"ndj_jxj", 1, true);
        return "<pre>" . print_r($member, true);
    }
}