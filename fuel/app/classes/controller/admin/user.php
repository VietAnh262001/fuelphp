<?php

use Fuel\Core\Pagination;
use Fuel\Core\View;

class Controller_Admin_User extends Controller_Admin_Base
{
    public function action_index()
    {
        $total_users = Model_Admin_User::count();

        $config = [
            'name' => 'default',
            'pagination_url' => Uri::create('admin/user/index'),
            'total_items'    => $total_users,
            'per_page'       => 10,
            'uri_segment'    => 4,
        ];

        $pagination = Pagination::forge('mypagination', $config);

        $users = Model_Admin_User::query()
            ->rows_limit($pagination->per_page)
            ->rows_offset($pagination->offset)
            ->get();

        $this->template->title = 'User';
        $this->template->content = View::forge('admin/user/index', [
            'users' => $users,
            'pagination' => $pagination->render(),
            'total' => $total_users,
            'first_item' => $pagination->offset + 1,
            'last_item' => min($pagination->offset + $pagination->per_page, $total_users),
        ]);
    }
}