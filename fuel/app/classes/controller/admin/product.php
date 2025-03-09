<?php

use Fuel\Core\Input;
use Fuel\Core\Pagination;
use Fuel\Core\Response;
use Fuel\Core\Session;

class Controller_Admin_Product extends Controller_Admin_Base
{
    public function action_index()
    {
        $query = Model_Admin_Product::query();

        $name = Input::get('name');
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $category_id = Input::get('category_id');
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        $status = Input::get('status');
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $price_max = Input::get('price_max');
        if (!empty($price_max)) {
            $query->where('price', '<=', $price_max);
        }

        $price_min = Input::get('price_min');
        if (!empty($price_min)) {
            $query->where('price', '>=', $price_min);
        }

        $total = $query->count();

        $config = [
            'name' => 'default',
            'total_items'    => $total,
            'per_page'       => 5,
            'uri_segment'    => 4,
        ];

        $search_params = [
            'name'       => Input::get('name', ''),
            'category_id' => Input::get('category_id', ''),
            'status'     => Input::get('status', ''),
            'price_min'  => Input::get('price_min', ''),
            'price_max'  => Input::get('price_max', ''),
        ];

        $config['pagination_url'] = Uri::create('/admin/product/index', [], $search_params);

        $pagination = Pagination::forge('mypagination', $config);

        $products = $query
            ->rows_limit($pagination->per_page)
            ->rows_offset($pagination->offset)
            ->order_by('id', 'desc')
            ->get();

        $categories = Model_Admin_Category::find('all');
        $this->template->title = 'Products';
        $this->template->js = 'admin/product.js';
        $this->template->content = View::forge('admin/product/index', [
            'products' => $products,
            'categories' => $categories,
            'pagination' => $pagination->render(),
            'total' => $total,
            'first_item' => $pagination->offset + 1,
            'last_item' => min($pagination->offset + $pagination->per_page, $total),
            'search' => compact('name', 'category_id', 'status', 'price_max', 'price_min'),
        ]);
    }

    public function action_create()
    {
        $categories = Model_Admin_Category::find('all');

        $errors = [];
        if (Input::method() == 'POST') {
            $val = Model_Admin_Product::validate('create');

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                if ($val->run()) {
                    $image_name = '';
                    if (!empty($_FILES['image']['name'])) {
                        $upload_path = DOCROOT . 'uploads/';
                        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        $new_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $extension;
                        $file_path = $upload_path . $new_name;

                        if (!is_dir($upload_path)) {
                            mkdir($upload_path, 0777, true);
                        }

                        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                            $image_name = $new_name;
                        }
                    }

                    $product = Model_Admin_Product::forge([
                        'category_id' => Input::post('category_id'),
                        'name' => Input::post('name'),
                        'price' => Input::post('price'),
                        'image' => $image_name,
                        'status' => Input::post('status', 1),
                        'note' => Input::post('note'),
                    ]);

                    if ($product->save()) {
                        Session::set_flash('success', 'product added');
                        Response::redirect('/admin/product/index');
                    } else {
                        Session::set_flash('error', 'Could not add product');
                    }
                } else {
                    $errors = $val->error();
                }
            } else {
                $errors['image'] = 'image chua upload';
            }
        }

        $this->template->title = 'Create Product';
        $this->template->js = 'admin/product.js';
        $this->template->content = View::forge('admin/product/create', [
            'categories' => $categories,
            'errors' => $errors,
        ]);
    }

    public function action_edit($id)
    {
        $product = Model_Admin_Product::find($id);
        if (!$product) {
            Response::redirect('/admin/product/index');
        }
        $categories = Model_Admin_Category::find('all');
        $errors = [];

        if (Input::method() == 'POST') {
            $val = Model_Admin_Product::validate('edit');

            if ($val->run()) {
                $image_name = $product->image;

                if (!empty($_FILES['image']['name'])) {
                    $upload_path = DOCROOT . 'uploads/';
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $new_name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $extension;
                    $file_path = $upload_path . $new_name;

                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                        if (!empty($product->image) && file_exists($upload_path . $product->image)) {
                            unlink($upload_path . $product->image);
                        }
                        $image_name = $new_name;
                    }
                }

                $product->category_id = Input::post('category_id');
                $product->name = Input::post('name');
                $product->price = Input::post('price');
                $product->image = $image_name;
                $product->status = Input::post('status', $product->status);
                $product->note = Input::post('note');

                if ($product->save()) {
                    Session::set_flash('success', 'product updated');
                    Response::redirect('/admin/product/index');
                } else {
                    Session::set_flash('error', 'Could not update product');
                }
            } else {
                $errors = $val->error();
            }
        }

        $this->template->title = 'Edit Product';
        $this->template->js = 'admin/product.js';
        $this->template->content = View::forge('admin/product/edit', [
            'product' => $product,
            'categories' => $categories,
            'errors' => $errors,
        ]);
    }

    public function action_delete($id)
    {
        $product = Model_Admin_Product::find($id);

        if ($product) {
            $upload_path = DOCROOT . 'uploads/';
            if (!empty($product->image) && file_exists($upload_path . $product->image)) {
                unlink($upload_path . $product->image);
            }

            $product->delete();
            Session::set_flash('success', 'product deleted');
        } else {
            Session::set_flash('error', 'Could not delete product');
        }

        Response::redirect('/admin/product/index');
    }
}