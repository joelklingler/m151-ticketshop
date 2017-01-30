<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		if(isset($_SESSION['userId']))
		{
			$data = $this->User_model->get_user_data();
			$this->template->load_loggedIn('profile', $data);
		}
		else
		{
			$this->template->load_error_all();
		}
	}

	public function edit_profile_submit()
	{
		if(isset($_POST['data']))
		{
			$parameter = array();
	        parse_str($_POST['data'], $parameter);
        	if($parameter['password-one'] == "")
    	    {
	        	$parameter['password-one'] = -1;
        	}
			echo $data = $this->User_model->save($parameter['first-name'], $parameter['name'], $parameter['email'], $parameter['telephone'], $parameter['password-one'], -1, $parameter['user-id']);
		}
		else
		{
			$this->template->load_error_all();
		}
	}
}
?>