<?php

use Fuel\Core\Validation;

class Model_Admin_Product extends Orm\Model
{
    protected static $_table_name = 'products';
    protected static $_properties = [
        'id',
        'category_id',
        'name',
        'price',
        'image',
        'status',
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

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add('name', 'Name')
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255)
            ->set_error_message('required', '{field} is required.')
            ->set_error_message('min_length', '{field} must be at least {param} characters.')
            ->set_error_message('max_length', '{field} must be less than {param} characters.');
        $val->add('category_id', 'Category')
            ->add_rule('required')
            ->set_error_message('required', '{field} is required.');
        $val->add('price', 'Price')
            ->add_rule('required')
            ->add_rule('match_pattern', '#^\d{1,10}$#')
            ->set_error_message('required', '{field} is required.')
            ->set_error_message('match_pattern', '{field} must be at least {param} characters.');
        $val->add('image', 'Image')
            ->add_rule('match_pattern', '#\.(jpeg|jpg|png)$#i')
            ->set_error_message('match_pattern', '{field} must be a PNG or JPEG image.');
        $val->add('note', 'Note')
            ->add_rule('max_length', 1000)
            ->set_error_message('max_length', '{field} must be less than {param} characters.');

        return $val;
    }
}
