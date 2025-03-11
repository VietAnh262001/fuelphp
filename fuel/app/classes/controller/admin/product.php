<?php

use Fuel\Core\Input;
use Fuel\Core\Pagination;
use Fuel\Core\Response;
use Fuel\Core\Session;

class Controller_Admin_Product extends Controller_Admin_Base
{
    /**
     * Action index product
     *
     * @return void
     */
    public function action_index()
    {
        $query = Model_Admin_Product::query();
        $query = $this->handle_search($query);
        $total = $query->count();

        $pagination = $this->handle_pagination($total, '/admin/product/index');

        $products = $query
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

        $categories = Model_Admin_Category::find('all');
        $this->template->title = 'Products';
        $this->template->js = 'admin/product.js';
        $this->template->content = View::forge('admin/product/index', [
            'products' => $products,
            'categories' => $categories,
            'data_pagination' => $data_pagination,
            'search' => Input::get(),
        ]);
    }

    /**
     * Handle search product
     *
     * @param $query
     * @return mixed
     */
    private function handle_search($query)
    {
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

        return $query;
    }

    /**
     * Action create product
     *
     * @return void
     * @throws Exception
     */
    public function action_create()
    {
        $categories = Model_Admin_Category::find('all');

        $errors = [];
        if (Input::method() == 'POST') {
            $val = Model_Admin_Product::validate('create');

                if ($val->run()) {
                    $image_name = $this->handle_image($_FILES['image']);

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
        }

        $this->template->title = 'Create Product';
        $this->template->js = 'admin/product.js';
        $this->template->content = View::forge('admin/product/create', [
            'categories' => $categories,
            'errors' => $errors,
        ]);
    }

    /**
     * Action edit product
     *
     * @param $id
     * @return void
     * @throws Exception
     */
    public function action_edit($id)
    {
        $product = Model_Admin_Product::find($id);
        if (!$product) {
            throw new HttpNotFoundException();
        }
        $categories = Model_Admin_Category::find('all');
        $errors = [];

        if (Input::method() == 'POST') {
            $val = Model_Admin_Product::validate('edit');

            if ($val->run()) {
                $product->category_id = Input::post('category_id');
                $product->name = Input::post('name');
                $product->price = Input::post('price');
                $product->image = $this->handle_image($_FILES['image'], $product->image);
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

    /**
     * Handle image product
     *
     * @param $file
     * @param $current_image
     * @return mixed|string|null
     */
    private function handle_image($file, $current_image = null)
    {
        if (!empty($file['name'])) {
            $upload_path = DOCROOT . 'uploads/';
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_name = pathinfo($file['name'], PATHINFO_FILENAME) . '_' . date('YmdHis') . '.' . $extension;
            $file_path = $upload_path . $new_name;

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            if (move_uploaded_file($file['tmp_name'], $file_path)) {
                if ($current_image && file_exists($upload_path . $current_image)) {
                    unlink($upload_path . $current_image);
                }
                return $new_name;
            }
        }
        return $current_image;

    }

    /**
     * Action delete product
     *
     * @param $id
     * @return void
     * @throws Exception
     */
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