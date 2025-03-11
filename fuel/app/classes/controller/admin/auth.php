<?php

use Auth\Auth;
use Fuel\Core\Input;
use Fuel\Core\Response;

class Controller_Admin_Auth extends Controller
{
    /**
     * Action login
     *
     * @return mixed
     */
    public function action_login()
    {
        if (Auth::check()) {
            Response::redirect('admin/dashboard');
        }

        if (Input::method() === 'POST') {
            $username = Input::post('username');
            $password = Input::post('password');
            $remember = Input::post('remember', false);

            if (Auth::login($username, $password)) {
                $group_id = Auth::get_groups()[0][1];
                if ($group_id == 50 || $group_id == 100) {
                    $remember ? Auth::remember_me() : Auth::dont_remember_me();

                    Session::set_flash('success', 'Log in successfully');
                    Response::redirect('admin/dashboard');
                } else {
                    Auth::logout();
                    Session::set_flash('error', 'You do not have access');
                    Response::redirect('admin/dashboard');
                }
            } else {
                Session::set_flash('error', 'Incorrect username or password');
            }
        }

        return View::forge('admin/auth/login');
    }

    /**
     * Action logout
     *
     * @return void
     */
    public function action_logout()
    {
        Auth::logout();
        Auth::dont_remember_me();

        Session::set_flash('success', 'Signed out');
        Response::redirect('admin/auth/login');
    }

    /**
     * Action register
     *
     * @return mixed
     */
    public function action_register()
    {
        $errors = [];

        if (Input::method() == 'POST') {
            $val = Model_Admin_User::validate_register();

            if ($val->run()) {
                $email = Input::post('email');
                $username = Input::post('username');
                $password = Input::post('password');

                $user = Auth::create_user($username, $password, $email, 1);

                if ($user) {
                    Session::set_flash('success', 'register successfully');
                    Response::redirect('admin/auth/login');
                } else {
                    Session::set_flash('error', 'register failed');
                }
            } else {
                $errors = $val->error();
            }
        }

        return View::forge('admin/auth/register', ['errors' => $errors]);
    }
}
