<?php

namespace Fuel\Migrations;

class Drop_users
{
	public function up()
	{
		\DBUtil::drop_table('users');
	}

	public function down()
	{

	}
}