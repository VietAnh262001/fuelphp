<?php

namespace Fuel\Migrations;

class Add_note_to_categories
{
    public function up()
    {
        \DBUtil::add_fields('categories', [
            'note' => ['type' => 'text', 'null' => true, 'after' => 'name'],
        ]);
    }

    public function down()
    {
        \DBUtil::drop_fields('categories', ['note']);
    }
}