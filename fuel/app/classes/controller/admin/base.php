<?php

use Auth\Auth;
use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Response;

class Controller_Admin_Base extends Controller_Hybrid
{
    public $template = 'admin/layout/app';
    public $custom_css = '';
    public $js = '';

    public function before()
    {
        parent::before();

        if (!Auth::instance()->check()) {
            Auth::instance()->remember_me();
        }

        if (!Auth::instance()->check()) {
            Response::redirect('admin/auth/login');
        }
    }
}
