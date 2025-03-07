<?php

class Model_Admin_Category extends Orm\Model
{
    protected static $_table_name = 'categories';
    protected static $_properties = [
        'id',
        'name',
        'note',
        'created_at',
        'updated_at',
    ];
}