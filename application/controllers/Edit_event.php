<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_event extends CI_Controller {

        public function index($id)
	{
                if(isset($_SESSION['roleId']) && $_SESSION['roleId'] == 1)
                {
                        $eventData = $this->Event_model->get_event_by_id($id);
                        if(isset($eventData) && isset($eventData['Id']))
                        {
                                $typeData = $this->Event_type_model->get_event_types();
                                $data['event'] = $eventData;
                                $data['types'] = $typeData;
                                $this->template->load_organizer('edit_event', $data);
                        }
                        else
                        {
                                $this->template->load_error_all();               
                        }
                }
                else
                {
                        $this->template->load_error_all();
                }
	}

        public function edit_event_submit()
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

        public function delete()
        {
                if(isset($_POST['data']))
                {
                        $parameter = array();
                        parse_str($_POST['data'], $parameter);
                        echo $this->Event_model->delete_event($parameter);
                }
                else
                {
                        $this->template->load_error_all();       
                }
        }
}
?>