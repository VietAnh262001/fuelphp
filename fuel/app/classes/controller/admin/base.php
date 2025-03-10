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

        if (!Auth::check() && Auth::check_remembered()) {
            Auth::force_login(Auth::get_user_id()[1]);
        }

        if (!Auth::check()) {
            Response::redirect('admin/auth/login');
        }

        $group_id = Auth::get_groups()[0][1];
        if ($group_id != 50 && $group_id != 100) {
            Auth::logout();
            Session::set_flash('error', 'Bạn không có quyền truy cập.');
            Response::redirect('admin/auth/login');
        }
    }

    protected function handle_pagination($total, $url)
    {
        $config = [
            'name' => 'default',
            'total_items' => $total,
            'per_page' => 5,
            'uri_segment' => 4,
            'pagination_url' => Uri::create($url, [], Input::get()),
        ];
        return Pagination::forge('mypagination', $config);
    }

    protected function is_admin()
    {
        $group_id = Auth::get_groups()[0][1];
        if ($group_id != 100) {
            return false;
        }
        return true;
    }
}
