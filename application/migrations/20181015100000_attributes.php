<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Attributes extends CI_Migration
{
	public function __construct()
	{
		parent::__construct();
	}

	public function up()
	{
		execute_script(APPPATH . 'migrations/sqlscripts/attributes.sql');
	}

	public function down()
	{

	}
}
?>
