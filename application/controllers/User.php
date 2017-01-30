<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function authenticate()
	{
		$parameter = array();
		parse_str($_POST['data'], $parameter);
		$email = $parameter['email'];
		$password = $parameter["password"];
		if(isset($email) && isset($password))
		{
			$password = sha1(trim(strtolower($password)));
			echo $this->User_model->authenticate($email, $password);
		}
		else
		{
			echo "Param error.";
		}
	}

	public function logout()
	{
		echo $this->User_model->logout();
		//redirect(STARTPATH."'/home");
	}

	public function register()
	{
		$this->template->load_public('register');
	}
    
    public function register_submit()
    {
        $paramter = array();
        parse_str($_POST['data'], $parameter);
        if(!isset($parameter['role']))
        {   
            $parameter['role'] = null;
        }
        echo $this->User_model->save($parameter['first-name'], $parameter['name'], $parameter['email'], $parameter['telephone'], $parameter['passwordOne'], $parameter['role']);
    }
}
?>