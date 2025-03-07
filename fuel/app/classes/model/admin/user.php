<?php

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
}