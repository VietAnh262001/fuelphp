<?php

use Auth\Auth;

class Controller_Admin_Dashboard extends Controller_Admin_Base {

    /**
     * Action index dashboard
     *
     * @return void
     */
    public function action_index()
    {
        $username = Auth::get_screen_name();
        $this->template->title = 'Dashboard';
        $this->template->content = View::forge('admin/dashboard/index', ['username' => $username]);
    }
}
