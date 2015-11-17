<?php

class m151117_155027_create_balance_log extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_balance_log",array(
			"id"=>"pk",
			"current_balance"=>"double",
			"date_created"=>"datetime",
			"date_updated"=>"datetime",
		));
		$this->insert("tbl_balance_log",array(
			"current_balance"=>300,
			"date_created"=>date("Y-m-d H:i:s"),
			"date_updated"=>date("Y-m-d H:i:s")
		));

	}

	public function safeDown()
	{
		$this->dropTable("tbl_balance_log");
	}
}