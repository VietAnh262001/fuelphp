<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.9-dev
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	/**
	 * -------------------------------------------------------------------------
	 *  Default route
	 * -------------------------------------------------------------------------
	 *
	 */

	'_root_' => 'admin/auth/login',

	/**
	 * -------------------------------------------------------------------------
	 *  Page not found
	 * -------------------------------------------------------------------------
	 *
	 */

	'_404_' => 'welcome/404',

	/**
	 * -------------------------------------------------------------------------
	 *  Example for Presenter
	 * -------------------------------------------------------------------------
	 *
	 *  A route for showing page using Presenter
	 *
	 */

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

    // Dashboard
    'admin' => 'admin/dashboard/index',

    // Auth
    'admin/login' => 'admin/auth/login',
    'admin/logout' => 'admin/auth/logout',
    'admin/dashboard' => 'admin/dashboard/index',

    // User
    'admin/user' => 'admin/user/index',
    'admin/user/edit/(:num)' => 'admin/user/edit/$1',
    'admin/user/delete/(:num)' => 'admin/user/delete/$1',
    'admin/user/reset_password/(:num)' => 'admin/user/reset_password/$1',
    'admin/user/change_password' => 'admin/user/change_password',

    // Category
    'admin/category'              => 'admin/category/index',
    'admin/category/create'       => 'admin/category/create',
    'admin/category/edit/(:num)'  => 'admin/category/edit/$1',
    'admin/category/delete/(:num)'=> 'admin/category/delete/$1',

    // Product
    'admin/product'               => 'admin/product/index',
    'admin/product/create'        => 'admin/product/create',
    'admin/product/edit/(:num)'   => 'admin/product/edit/$1',
    'admin/product/delete/(:num)' => 'admin/product/delete/$1',
);
