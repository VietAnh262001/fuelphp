<?php

use Fuel\Core\Controller;
use Fuel\Core\Input;
use Fuel\Core\Pagination;
use Fuel\Core\Response;

class Controller_Admin_Category extends Controller_Admin_Base
{
    public function action_index()
    {
        $search_name = Input::get('search_name');
        $total = Model_Admin_Category::count();

        $config = [
            'name' => 'default',
            'pagination_url' => Uri::create('admin/category/index'),
            'total_items'    => $total,
            'per_page'       => 10,
            'uri_segment'    => 4,
        ];

        $pagination = Pagination::forge('mypagination', $config);
        $query = Model_Admin_Category::query();
        if ($search_name) {
            $query->where('name', 'like', '%' . $search_name . '%');
        }

        $categories = $query
            ->rows_limit($pagination->per_page)
            ->rows_offset($pagination->offset)
            ->get();

        $this->template->title = 'Categories';
        $this->template->content = View::forge('admin/category/index', [
            'categories' => $categories,
            'search_name' => $search_name,
            'pagination' => $pagination->render(),
            'total' => $total,
            'first_item' => $pagination->offset + 1,
            'last_item' => min($pagination->offset + $pagination->per_page, $total),
        ]);
    }

    public function action_create()
    {
        $this->template->title = 'Create Category';

        if (Input::method() == 'POST') {
            $category = Model_Admin_Category::forge(Input::post());
            if ($category->save()) {
                Response::redirect('/admin/category/index');
            }
        }

        $this->template->content = View::forge('admin/category/create');
    }

    public function action_edit($id)
    {
        $category = Model_Admin_Category::find($id);
        if (Input::method() == 'POST') {
            $category->name = Input::post('name');
            $category->note = Input::post('note');
            if ($category->save()) {
                Response::redirect('/admin/category/index');
            }
        }
        $this->template->title = 'Edit Category';
        $this->template->content = View::forge('admin/category/edit', ['category' => $category]);
    }

    public function action_delete($id)
    {
        if ($category = Model_Admin_Category::find($id)) {
            $category->delete();
        }
        Response::redirect('/admin/category/index');
    }
}