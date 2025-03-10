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
        $query = $this->handle_search($query);
        $total = $query->count();
        $pagination = $this->handle_pagination($total, '/admin/category/index');

        $categories = $query
            ->rows_limit($pagination->per_page)
            ->rows_offset($pagination->offset)
            ->order_by('id', 'desc')
            ->get();

        $data_pagination = [
            'pagination' => $pagination->render(),
            'total' => $total,
            'first_item' => $pagination->offset + 1,
            'last_item' => min($pagination->offset + $pagination->per_page, $total),
        ];

        $this->template->title = 'Categories';
        $this->template->js = 'admin/category.js';
        $this->template->content = View::forge('admin/category/index', [
            'categories' => $categories,
            'data_pagination' => $data_pagination,
            'search' => Input::get(),
        ]);
    }

    private function handle_search($query)
    {
        $name = Input::get('name');
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        return $query;
    }

    public function action_create()
    {
        $errors = [];
        if (Input::method() == 'POST') {
            $val = Model_Admin_Category::validate('create');
            if ($val->run()) {
                $category = Model_Admin_Category::forge(Input::post());
                if ($category->save()) {
                    Session::set_flash('success', 'Category has been created');
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
        if (!$category) {
            throw new HttpNotFoundException();
        }

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