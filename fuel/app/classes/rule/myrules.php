<?php

namespace Rule;
use DB;

class MyRules
{
    public static function _validation_unique_email($email)
    {
        $exists = DB::select()->from('users')->where('email', '=', $email)->execute()->count();

        return $exists === 0;
    }

    public static function _validation_unique_name($username)
    {
        $exists = DB::select()->from('users')->where('username', '=', $username)->execute()->count();

        return $exists === 0;
    }
}