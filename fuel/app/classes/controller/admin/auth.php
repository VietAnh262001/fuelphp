<?php

use Auth\Auth;
use Fuel\Core\Input;
use Fuel\Core\Response;

class Controller_Admin_Auth extends Controller
{
    public function action_login()
    {
        if (Auth::check()) {
            Response::redirect('admin/dashboard');
        }

        if (Input::method() === 'POST') {
            $username = Input::post('username');
            $password = Input::post('password');
            $remember = Input::post('remember', false);

            if (Auth::instance()->login($username, $password)) {
                if ($remember) {
                    Auth::remember_me();
                } else {
                    Auth::dont_remember_me();
                }

                Session::set_flash('success', 'Đăng nhập thành công');
                Response::redirect('admin/dashboard');
            } else {
                Session::set_flash('error', 'Tên đăng nhập hoặc mật khẩu không đúng');
            }
        }

        return View::forge('admin/auth/login');
    }

    public function action_logout()
    {
        Auth::instance()->logout();
        Auth::dont_remember_me();

        Session::set_flash('success', 'Đã đăng xuất');
        Response::redirect('admin/auth/login');
    }
}
