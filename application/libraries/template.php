<?php
class Template
{
	function load($view, $data = null)
	{
		$CI = &get_instance();
		if(isset($view))
		{
			if(isset($data))
			{
				$dataArray['data'] = $data;
				$CI->load->view($view, $dataArray);
			}
			else
			{
				$CI->load->view($view);
			}
		}		
		$CI->load->view('partials/footer');
	}

	function load_public($view, $data = null)
	{
		$this->load_common();
		$this->load($view, $data);
	}

	function load_customer($view, $data = null)
	{
		$this->load_common();
		if(isset($_SESSION['roleId']))
		{
			if($_SESSION['roleId'] == 2)
			{
				$this->load($view, $data);
			}
			else
			{
				$this->load_error();
			}
		}
		else
		{
			$this->load_error();
		}
	}

	function load_organizer($view, $data = null)
	{
		$this->load_common();
		if(isset($_SESSION['roleId']))
		{
			if($_SESSION['roleId'] == 1)
			{
				$this->load($view, $data);
			}
			else
			{
				$this->load_error();
			}
		}
		else
		{
			$this->load_error();
		}
	}

	function load_loggedIn($view, $data = null)
	{
		$this->load_common();
		if(isset($_SESSION['userId']))
		{
			$this->load($view, $data);
		}
		else
		{
			$this->load_error();
		}
	}

	function load_common()
	{
		$CI = &get_instance();
		$CI->load->view('partials/assets_loader');
		$CI->load->view('partials/header');
		$CI->load->view('partials/loader');
		$CI->load->view('partials/loginForm');
	}

	function load_error()
	{
		$CI = &get_instance();
		$CI->load->view('errors/auth/security');
		$CI->load->view('partials/footer');
	}

	function load_error_all()
	{
		$CI = &get_instance();
		$this->load_common();
		$CI->load->view('errors/auth/security');
		$CI->load->view('partials/footer');
	}

	function load_db_info($data)
	{
		$CI = &get_instance();
		$this->load_common();
		$this->load('database_create', $data);
	}
}
?>