<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'url' => ['type' => 'varchar', 'constraint' => 255],
            'title' => ['type' => 'varchar', 'constraint' => 255],
            'description' => ['type' => 'longtext', 'null' => true],
            'price' => ['type' => 'float', 'null' => true],
            'image' => ['type' => 'varchar','constraint' => 255, 'null' => true],
            'isActive' => ['type' => 'tinyint', 'constraint' => 11, 'null' => 0, 'default' => 0],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
            'deleted_at' => ['type' => 'datetime', 'null' => true],
            //'deleted_at'       => ['type' => 'datetime', 'null' => true],
            //'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            //'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('services');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('services');
    }
}
