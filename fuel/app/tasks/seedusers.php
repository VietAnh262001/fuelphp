<?php

namespace Fuel\Tasks;

use Auth\Auth;

class Seedusers
{

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r seedusers
	 *
	 * @return string
	 */
	public function run($count = 20)
	{
        Auth::instance()->create_user(
            'admin',
            '123',
            'admin@example.com',
            100
        );

        for ($i = 1; $i <= $count; $i++) {
            $username = 'user' . rand(1000, 9999);
            $password = 'password' . rand(1000, 9999);
            $email = $username . '@gmail.com';
            $group = 1;

            Auth::instance()->create_user($username, $password, $email, $group);
        }
	}



	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r seedusers:index "arguments"
	 *
	 * @return string
	 */
	public function index($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Seedusers:Index]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}

}
/* End of file tasks/seedusers.php */
