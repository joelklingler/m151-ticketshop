<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {

	public function index()
	{
		if(isset($_SESSION['userId']))
		{
			$data = $this->Event_model->get_all_by_user();
			$this->template->load_organizer('overview', $data);
		}
		else
		{
			$this->template->load_error_all();
		}
	}
}
?>