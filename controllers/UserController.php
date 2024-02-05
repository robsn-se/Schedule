<?php
namespace controllers;

use services\UserService;

class UserController
{
    public static function createUser(): string {
        $user = UserService::createUser(8555,"jddj_kjsj_ndj_jxj");
        return "<pre>" . print_r($user, true);
    }
}
