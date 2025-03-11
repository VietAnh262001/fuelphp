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

        if (!Auth::check()) {
            if (Auth::get_user_id()) {
                Auth::force_login(Auth::get_user_id()[1]);
            } else {
                Response::redirect('admin/auth/login');
            }
        }

        $group_id = Auth::get_groups()[0][1];
        if (
            $group_id != Model_Admin_User::GROUP_MODERATOR &&
            $group_id != Model_Admin_User::GROUP_ADMIN
        ) {
            Auth::logout();
            Session::set_flash('error', 'You do not have access');
            Response::redirect('admin/auth/login');
        }
    }

    /**
     * Handle pagination
     *
     * @param $total
     * @param $url
     * @return mixed
     */
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

    /**
     * Is admin
     *
     * @return bool
     */
    protected function is_admin()
    {
        $group_id = Auth::get_groups()[0][1];
        if ($group_id != Model_Admin_User::GROUP_ADMIN) {
            return false;
        }
        return true;
    }
}
