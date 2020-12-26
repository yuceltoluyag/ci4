<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'company_name'     => ['type' => 'varchar', 'constraint' => 255],
            'about_us'         => ['type' => 'longtext','null' => true],
            'mission'          => ['type' => 'longtext','null' => true],
            'vision'           => ['type' => 'longtext', 'null' => true],
            'logo'             => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'mobile_logo'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'favicon'          => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'phone_1'          => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
            'phone_2'          => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
            'fax_1'            => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
            'fax_2'            => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'facebook'         => ['type' => 'varchar', 'constraint' => 225, 'null' => true],
            'twitter'          => ['type' => 'varchar', 'constraint' => 225, 'null' => true],
            'instagram'        => ['type' => 'varchar', 'constraint' => 225, 'null' => true],
            'linkedin'         => ['type' => 'varchar', 'constraint' => 225, 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            //'deleted_at'       => ['type' => 'datetime', 'null' => true],
            //'active'           => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            //'force_pass_reset' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->forge->dropTable('settings');
	}
}
