<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'unsigned' => TRUE,
						'auto_increment' => TRUE
				),
				'name' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
				),
				'avatar' => array(
						'type' => 'VARCHAR',
						'constraint' => '128',
						'null' => TRUE,
				),
				'username' => array(
						'type' => 'VARCHAR',
						'constraint' => '128'
				),
				'password' => array(
						'type' => 'VARCHAR',
						'constraint' => '128'
				),
				'type' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'default' => 'hotel'
				),
				'status' => array(
						'type' => 'TINYINT',
						'constraint' => '2',
						'default' => '1'
				),
				'parrent' => array(
						'type' => 'INT',
						'constraint' => '11',
						'default' => '0'
				),

		));

		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('dip_users');
	}

	public function down()
	{
		$this->dbforge->drop_table('dip_users');
	}
}