<?php

use Fuel\Core\Validation;

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

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('name', 'Name', 'required|min_length[1]|max_length[255]')
            ->set_error_message('required', 'Vui long nhap category');
        $val->add_field('note', 'Note', 'max_length[255]');
        return $val;
    }
}