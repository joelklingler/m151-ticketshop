<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_event extends CI_Controller {

	public function index()
	{
        $data = $this->Event_type_model->get_event_types();
		$this->template->load_organizer('new', $data);
	}
    
    public function new_event_submit()
    {
        if(isset($_POST['data']))
        {
            $parameter = array();
            parse_str($_POST['data'], $parameter);
            echo $this->Event_model->save_event($parameter);
        }
        else
        {
            $this->template->load_error_all();
        }
    }
}
?>