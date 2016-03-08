<?php
class m160308_113253_create_list_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable("tbl_list",array(
			"id"=>"pk",
			"listid"=>"integer",
			"diallable_leads"=>"integer",
			"credit_used"=>"double",
			"total_minutes"=>"integer",
		));
	}
	public function safeDown()
	{
		$this->dropTable("tbl_list");
	}
}