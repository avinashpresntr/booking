<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_hotelgroups extends CI_Migration {

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

				//contact person
				'contact_person' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'contact_email' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'contact_phone' => array(
						'type' => 'VARCHAR',
						'constraint' => '50',
						'null' => TRUE,
				),

				// dates
				'creation_date' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'null' => TRUE,
				),
				'renewal_date' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'null' => TRUE,
				),

				// mobile app datas
				'ios_status' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'null' => TRUE,
				),
				'android_status' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'null' => TRUE,
				),
				'ios_url' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'android_url' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),

				// languages
				'default_language' => array(
						'type' => 'INT',
						'constraint' => '5',
						'default' => 1
				),
				'languages' => array(
						'type' => 'VARCHAR',
						'constraint' => '20',
						'null' => TRUE,
				),
		));

		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('dip_hotelgroups');

	}

	public function down()
	{
		$this->dbforge->drop_table('dip_hotelgroups');
	}
}