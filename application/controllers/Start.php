<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

	public function index()
	{
		$dsn = 'mysqli://root:@localhost/';
		$this->load->database($dsn);
		$this->load->dbutil();
		if($this->dbutil->database_exists('joelklinglereventdatabase'))
		{
			$this->db->close();
			$data = $this->Event_model->get_all();
			$this->template->load_public('start', $data);
		}
		else
		{
			$this->db->close();
			$this->install();
		}
	}

	public function install()
	{
		$this->template->load_db_info(install_database());
	}
}
?>