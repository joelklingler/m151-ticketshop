<?php
class Return_vals extends CI_Model
{
	public $returnValues = array(
		'success' => false,
		'message' => ""
	);
}

class My_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
}
?>