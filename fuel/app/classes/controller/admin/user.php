<?php

use Fuel\Core\Pagination;
use Fuel\Core\View;

class Controller_Admin_User extends Controller_Admin_Base
{
    public function action_index()
    {
        $query = Model_Admin_User::query();
        $query = $this->handle_search($query);
        $total = $query->count();

        $pagination = $this->handle_pagination($total, '/admin/user/index');

        $users = $query
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

        $this->template->title = 'User';
        $this->template->js = 'admin/user.js';
        $this->template->content = View::forge('admin/user/index', [
            'users' => $users,
            'data_pagination' => $data_pagination,
            'search' => Input::get(),
        ]);
    }

    private function handle_search($query)
    {
        $username = Input::get('username');
        if (!empty($username)) {
            $query->where('username', 'LIKE', '%' . $username . '%');
        }

        $email = Input::get('email');
        if (!empty($email)) {
            $query->where('email', 'LIKE', $email . '%');
        }

        return $query;
    }

    public function action_edit($id)
    {
        $user = Model_Admin_User::find($id);

        if (!$user) {
            throw new HttpNotFoundException();
        }

        if (Input::method() == 'POST') {
            $group = Input::post('group');
            Auth::update_user(['group' => $group], $user->username);
        }

        $this->template->title = 'Edit User';
        $this->template->content = View::forge('admin/user/edit', ['user' => $user]);
    }
    public function action_delete($id)
    {
        if (!$this->is_admin()) {
            Session::set_flash('error', 'You do not have the right to do so');
            return Response::redirect('/admin/user/index');
        }
        if ($user = Model_Admin_User::find($id)) {
            $user->delete();
            Session::set_flash('success', 'User has been deleted');
        } else {
            Session::set_flash('error', 'Could not delete user');
        }
        Response::redirect('/admin/user/index');
    }
}