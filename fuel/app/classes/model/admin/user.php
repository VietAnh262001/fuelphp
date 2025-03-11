<?php

use Fuel\Core\DB;

class Model_Admin_User extends Orm\Model
{
    protected static $_table_name = 'users';
    protected static $_properties = [
        'id',
        'username',
        'password',
        'email',
        'group',
        'created_at',
        'updated_at',
    ];

    const GROUP_ADMIN = 100;
    const GROUP_MODERATOR = 50;
    const GROUP_USER = 1;
    const GROUP_GUEST = 0;

    public static function get_groups()
    {
        return [
            self::GROUP_ADMIN => 'Admin',
            self::GROUP_MODERATOR => 'Moderator',
            self::GROUP_USER => 'User',
            self::GROUP_GUEST => 'Guest',
        ];
    }

    public static function validate_register()
    {
        $val = Validation::forge();
        $val->add_callable('Rule\\MyRules');
        $val->add_field('username', 'Username', 'required|min_length[3]|max_length[50]')
            ->add_rule('unique_name', 'users.username')
            ->set_error_message('unique_name', 'Username already exists')
            ->set_error_message('required', 'Username is required')
            ->set_error_message('min_length', 'Username must be at least 3 characters long')
            ->set_error_message('max_length', 'Username must be less than 50 characters long');
        $val->add_field('email', 'Email', 'required|valid_email')
            ->add_rule('unique_email', 'users.email')
            ->set_error_message('required', 'Email is required')
            ->set_error_message('valid_email', 'Email is invalid')
            ->set_error_message('unique_email', 'Email is already registered');
        $val->add_field('password', 'Password', 'required|min_length[3]')
            ->set_error_message('required', 'Password is required')
            ->set_error_message('min_length', 'Password must be at least 3 characters long');
        $val->add_field('confirm_password', 'Confirm Password', 'required|match_field[password]')
            ->set_error_message('required', 'Confirm Password is required')
            ->set_error_message('match_field', 'Password does not match');

        return $val;
    }

    public static function validate_change_password()
    {
        $val = Validation::forge();

        $val->add_field('old_password', 'Old password', 'required')
            ->set_error_message('required', 'Old password is required');
        $val->add_field('new_password', 'New password', 'required|min_length[3]')
            ->set_error_message('required', 'New password is required')
            ->set_error_message('min_length', 'New password must be at least 3 characters long');
        $val->add_field('confirm_password', 'Confirm Password', 'required|match_field[new_password]')
            ->set_error_message('required', 'Confirm Password is required')
            ->set_error_message('match_field', 'New password does not match');

        return $val;
    }
}