<?php

namespace Fuel\Migrations;

class Create_categories
{
	public function up()
	{
		\DBUtil::create_table('categories', array(
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'name' => ['type' => 'varchar', 'constraint' => 255],
            'created_at' => ['type' => 'int', 'null' => true],
            'updated_at' => ['type' => 'int', 'null' => true],
		), ['id']);
	}

	public function down()
	{
		\DBUtil::drop_table('categories');
	}
}