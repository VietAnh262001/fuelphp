<?php

use Fuel\Core\Controller;
use Fuel\Core\Input;
use Fuel\Core\Pagination;
use Fuel\Core\Response;

class Controller_Admin_Product extends Controller_Admin_Base
{
    public function action_index()
    {
        $products = Model_Admin_Product::find('all');
        $this->template->title = 'Products';
        $this->template->content = View::forge('admin/product/index', ['products' => $products]);
    }

    public function action_create()
    {
        $this->template->title = 'Create Product';
        $this->template->js = 'admin/product.js';
        $this->template->content = View::forge('admin/product/create');
    }

    public function action_edit($id)
    {

    }

    public function action_delete($id)
    {

    }
}