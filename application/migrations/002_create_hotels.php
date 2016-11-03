<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_hotels extends CI_Migration {

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
				'phone' => array(
						'type' => 'VARCHAR',
						'constraint' => '50',
						'null' => TRUE,
				),
				'email' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'address' => array(
						'type' => 'VARCHAR',
						'constraint' => '255',
						'null' => TRUE,
				),
				'website' => array(
						'type' => 'VARCHAR',
						'constraint' => '100',
						'null' => TRUE,
				),
				'longitude' => array(
						'type' => 'DECIMAL',
						'constraint' => '11,7',
						'null' => TRUE,
				),
				'latitude' => array(
						'type' => 'DECIMAL',
						'constraint' => '11,7',
						'null' => TRUE,
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

				//push notification
				'push_notification' => array(
						'type' => 'INT',
						'constraint' => '5',
						'default' => 0,
				),
				'push_counter' => array(
						'type' => 'INT',
						'constraint' => '5',
						'default' => 0,
				),
		));

		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('dip_hotels');

	}

	public function down()
	{
		$this->dbforge->drop_table('dip_hotels');
	}
}