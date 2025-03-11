<?php

namespace Rule;
use DB;

class MyRules
{
    /**
     * Validation unique email
     *
     * @param $email
     * @return bool
     */
    public static function _validation_unique_email($email)
    {
        $exists = DB::select()->from('users')->where('email', '=', $email)->execute()->count();

        return $exists === 0;
    }

    /**
     * Validation unique username
     *
     * @param $username
     * @return bool
     */
    public static function _validation_unique_name($username)
    {
        $exists = DB::select()->from('users')->where('username', '=', $username)->execute()->count();

        return $exists === 0;
    }

    /**
     * Validation required image
     *
     * @return bool
     */
    public static function _validation_required_image()
    {
        return isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK;
    }
}