<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_rooms extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
				'id' => array(
						'type' => 'INT',
						'constraint' => 11,
						'unsigned' => TRUE,
						'auto_increment' => TRUE
				),
				'user_id' => array(
						'type' => 'INT',
						'constraint' => 11
				),
				'res_phone' => array(
						'type' => 'VARCHAR',
						'constraint' => '50',
						'null' => TRUE,
				),
				'res_email' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'room_name' => array(
						'type' => 'VARCHAR',
						'constraint' => '255',
						'null' => TRUE,
				),
				'room_desc' => array(
						'type' => 'VARCHAR',
						'constraint' => '255',
						'null' => TRUE,
				),
				'room_pics' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'position' => array(
						'type' => 'INT',
						'constraint' => '11',
						'null' => TRUE,
				),
		));

		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('dip_rooms');
	}

	public function down()
	{
		$this->dbforge->drop_table('dip_rooms');
	}
}