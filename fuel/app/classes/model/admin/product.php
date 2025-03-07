<?php

class Model_Admin_Product extends Orm\Model
{
    protected static $_table_name = 'products';
    protected static $_properties = [
        'id',
        'category_id',
        'name',
        'price',
        'image',
        'note',
        'created_at',
        'updated_at',
    ];
    protected static $_belongs_to = [
        'category' => [
            'model_to' => 'Model_Admin_Category',
            'key_from' => 'category_id',
            'key_to'   => 'id',
        ],
    ];
}