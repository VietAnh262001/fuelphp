<?php

use Fuel\Core\Input;
use Fuel\Core\Pagination;
use Fuel\Core\Response;
use Fuel\Core\Session;

class Controller_Admin_Category extends Controller_Admin_Base
{
    public function action_index()
    {
        $query = Model_Admin_Category::query();
        $search_name = Input::get('search_name');
        if ($search_name) {
            $query->where('name', 'like', '%' . $search_name . '%');
        }
        $total = $query->count();

        $config = [
            'name' => 'default',
            'total_items'    => $total,
            'per_page'       => 5,
            'uri_segment'    => 4,
        ];
        $search_params = ['search_name' => $search_name];
        $config['pagination_url'] = Uri::create('/admin/category/index', [], $search_params);
        $pagination = Pagination::forge('mypagination', $config);

        $categories = $query
            ->rows_limit($pagination->per_page)
            ->rows_offset($pagination->offset)
            ->order_by('id', 'desc')
            ->get();

        $this->template->title = 'Categories';
        $this->template->js = 'admin/category.js';
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
        $errors = [];
        if (Input::method() == 'POST') {
            $val = Model_Admin_Category::validate('create');
            if ($val->run()) {
                $category = Model_Admin_Category::forge(Input::post());
                if ($category->save()) {
                    Session::setFlash('success', 'Category has been created');
                    Response::redirect('/admin/category/index');
                } else {
                    Session::set_flash('error', 'Could not save category');
                }
            } else {
                $errors = $val->error();
            }
        }
        $this->template->title = 'Create Category';
        $this->template->content = View::forge('admin/category/create', ['errors' => $errors]);
    }

    public function action_edit($id)
    {
        $errors = [];
        $category = Model_Admin_Category::find($id);
        if (Input::method() == 'POST') {
            $val = Model_Admin_Category::validate('edit');
            if ($val->run()) {
                $category->name = Input::post('name');
                $category->note = Input::post('note');
                if ($category->save()) {
                    Session::set_flash('success', 'Category has been edited');
                    Response::redirect('/admin/category/index');
                } else {
                    Session::set_flash('error', 'Could not edit category');
                }
            } else {
                $errors = $val->error();
            }
        }
        $this->template->title = 'Edit Category';
        $this->template->content = View::forge('admin/category/edit', [
            'category' => $category,
            'errors' => $errors,
        ]);
    }

    public function action_delete($id)
    {
        if ($category = Model_Admin_Category::find($id)) {
            $category->delete();
            Session::set_flash('success', 'Category has been deleted');
        } else {
            Session::set_flash('error', 'Could not delete category');
        }
        Response::redirect('/admin/category/index');
    }
}