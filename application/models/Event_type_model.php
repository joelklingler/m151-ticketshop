<?php
class Event_type_model extends Return_vals
{
    public function get_event_types()
    {
        $CI = &get_instance();
		$CI->load->database();
		$result = $CI->db->query("SELECT * FROM eventtype");
        foreach($result->result() as $row)
		{
			$data[] = $row;
		}
		$res['res'] = $data;
		$this->db->close();
		return json_decode(json_encode($res), true);
    }

    public function get_event_type_by_id($id)
    {
    	$CI = &get_instance();
		$CI->load->database();
		$result = $CI->db->query("SELECT * FROM eventtype WHERE Id = ".$id);
        $result = $result->result_array();
        $this->db->close();
		return $result;
    }
}
?>