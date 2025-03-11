<?php

use Auth\Auth;
use Fuel\Core\Pagination;
use Fuel\Core\View;

class Controller_Admin_User extends Controller_Admin_Base
{
    /**
     * Action index user
     *
     * @return void
     */
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

    /**
     * Handle search user
     *
     * @param $query
     * @return mixed
     */
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

    /**
     * Action edit user
     *
     * @param $id
     * @return void
     */
    public function action_edit($id)
    {
        $user = Model_Admin_User::find($id);

        if (!$user) {
            throw new HttpNotFoundException();
        }

        if (Input::method() == 'POST') {
            if (!$this->is_admin()) {
                Session::set_flash('error', 'You do not have access');
            } else {
                $group = Input::post('group');
                $result = Auth::update_user(['group' => $group], $user->username);
                $result
                    ? Session::set_flash('success', 'User updated')
                    : Session::set_flash('error', 'Could not update user');
            }
        }

        $this->template->title = 'Edit User';
        $this->template->content = View::forge('admin/user/edit', ['user' => $user]);
    }

    /**
     * Action delete user
     *
     * @param $id
     * @return void
     */
    public function action_delete($id)
    {
        $user = Model_Admin_User::find($id);
        if (!$user) {
            throw new HttpNotFoundException();
        }

        if (!$this->is_admin()) {
            Session::set_flash('error', 'You do not have access');
            return Response::redirect('/admin/user/index');
        }

        $username = $user->username;
        if (Auth::delete_user($username)) {
            Session::set_flash('success', 'User has been deleted');
        } else {
            Session::set_flash('error', 'Could not delete user');
        }
        Response::redirect('/admin/user/index');
    }

    /**
     * Action reset password
     *
     * @param $id
     * @return void
     */
    public function action_reset_password($id)
    {
        $user = Model_Admin_User::find($id);
        if (!$user) {
            throw new HttpNotFoundException();
        }

        if (!$this->is_admin()) {
            Session::set_flash('error', 'You do not have access');
            return Response::redirect('/admin/user/index');
        }

        $username = $user->username;

        $new_password = Auth::reset_password($username);
        if ($new_password) {
            Session::set_flash('success', "User's new password: {$new_password}");
        } else {
            Session::set_flash('error', 'Could not reset password');
        }

        Response::redirect('/admin/user/edit/' . $id);
    }

    /**
     * Action change password
     *
     * @return void
     */
    public function action_change_password()
    {
        $errors = [];
        if (Input::method() == 'POST') {
            $val = Model_Admin_User::validate_change_password();

            if ($val->run()) {
                $old_password = Input::post('old_password');
                $new_password = Input::post('new_password');

                if (Auth::change_password($old_password, $new_password)) {
                    Auth::logout();
                    Auth::dont_remember_me();
                    Session::set_flash('success', 'Password changed successfully');

                    Response::redirect('admin/auth/login');
                } else {
                    Session::set_flash('error', 'Incorrect old password');
                }
            } else {
                $errors = $val->error();
            }
        }

        $this->template->title = 'Change Password';
        $this->template->content = View::forge('admin/user/change_password', [
            'errors' => $errors
        ]);
    }
}