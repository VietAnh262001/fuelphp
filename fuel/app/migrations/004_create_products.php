<?php

namespace Fuel\Migrations;

class Create_products
{
	public function up()
	{
        \DBUtil::create_table('products', [
            'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
            'category_id' => ['type' => 'int', 'constraint' => 11],
            'name' => ['type' => 'varchar', 'constraint' => 255],
            'price' => ['type' => 'float'],
            'image' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'note' => ['type' => 'varchar', 'constraint' => 1000, 'null' => true],
            'created_at' => ['type' => 'int', 'null' => true],
            'updated_at' => ['type' => 'int', 'null' => true],
        ], ['id']);
	}

	public function down()
	{
		\DBUtil::drop_table('products');
	}
}