<?php

namespace Fuel\Migrations;

class Add_status_to_products
{
	public function up()
	{
        \DBUtil::add_fields('products', [
            'status' => ['type' => 'int', 'constraint' => 1, 'default' => 1, 'after' => 'image'],
        ]);
	}

	public function down()
	{
        \DBUtil::drop_fields('products', ['status']);
	}
}