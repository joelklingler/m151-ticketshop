<?php
class Event_model extends Return_vals
{
	// Read
	// Gets all events
	public function get_all()
	{
		$CI = &get_instance();
		$CI->load->database();
		$result = $CI->db->query("SELECT * FROM events");
        if($result->num_rows() > 0)
		{
			foreach($result->result() as $row)
			{
				$data[] = $row;
			}
			$res['res'] = $data;
            $this->db->close();
			return $res;
		}
		else
		{
            $this->db->close();
			return false;
		}
        return null;
	}
    
    // Gets all events from this user 
    public function get_all_by_user()
    {
        $CI = &get_instance();
        $CI->load->database();
        $userId = $this->session->userId;
        $result = $CI->db->query("SELECT * FROM events WHERE IdUser = ".$userId);
        $result = $result->result_array();
        /*echo "<PRE>";
        print_r($result);
        echo "</PRE>";*/
        $i = 0;
        foreach ($result as $event) 
        {
            $eventTypes = array();
            // Get the types
            $types = $CI->db->query("SELECT IdEventType FROM eventtypes WHERE IdEvent = ".$event['Id']);
            $types = $types->result_array();
            foreach ($types as $typeId) 
            {
                if(isset($typeId))
                {
                    $typeDetail = $this->Event_type_model->get_event_type_by_id($typeId['IdEventType']);
                    $eventTypes[] = $typeDetail;
                }
            }
            $result[$i]['types'] = $eventTypes;
            $i++;
        }
        $this->db->close();
        return $result;
    }

	// Get a specific event
	public function get_event_by_id($id)
	{
		if(!isset($id))
		{
			return null;
		}
		$CI = &get_instance();
		$CI->load->database();
		$result = $CI->db->query("SElECT * FROM events WHERE id = ".$id);
		foreach ($result->result() as $row) 
        {
            $results[] = $row;
        }
        if(!isset($results))
        {
            return null;
        }
        $result = json_decode(json_encode($results[0]),true);
        $typearray = array();
        $query = $CI->db->query("SELECT * FROM eventtypes WHERE IdEvent = ".$id);
        foreach ($query->result() as $row) 
        {
            $eventTypeId = $row->IdEventType;
            $typearray[] = $this->Event_type_model->get_event_type_by_id($eventTypeId);
        }
        $result["types"] = $typearray;
        $this->db->close();
		return $result;
	}
    
    // Saves a specific event
    public function save_event($params)
    {
        $shortName = $params['short-name'];
        $description = $params['description'];
        $ticketQuantity = $params['ticket-quantity'];
        $ticketCost = $params['ticket-cost'];
        $location = $params['location'];
        $startDate = $params['start-date'];
        if(isset($params['start-date-time']))
        {
            $startDateTime = $params['start-date-time'];
        }
        $endDate = $params['end-date'];
        if(isset($params['end-date-time']))
        {
            $endDateTime = $params['end-date-time'];
        }
        $artist = $params['artist'];
        $imagePath = $params['image-path'];
        if(isset($params['user-id']))
        {
            $userId = $params['user-id'];
        }
        $types = explode(',', $params['type']);
        
        $CI = &get_instance();
		$CI->load->database();
        if(isset($params['event-id']))
        {
            // Save existing event
            $sql = "UPDATE events SET ShortName='".htmlspecialchars($shortName)."', Description='".htmlspecialchars($description)."', Image='".htmlspecialchars($imagePath)."', TicketCost='".htmlspecialchars($ticketCost)."', 
            TicketQuantity='".htmlspecialchars($ticketQuantity)."', Location='".htmlspecialchars($location)."', EventStartDate='".htmlspecialchars($startDate)."',
            EventEndDate='".htmlspecialchars($endDate)."', Artist='".htmlspecialchars($artist)."', isHot=0 WHERE Id = ".$params['event-id'];
            $result = $CI->db->query($sql);
        }
        else
        {

            // Create new event
            $result = $CI->db->query("INSERT INTO events (ShortName, Description, Image, TicketCost, TicketQuantity, TicketsLeft, Location, EventStartDate, EventEndDate, Artist, isHot, IdUser) 
		      VALUES ('".htmlspecialchars($params["short-name"])."','".htmlspecialchars($params["description"])."','".htmlspecialchars($params['image-path'])."','".htmlspecialchars($params["ticket-cost"])."','".htmlspecialchars($params["ticket-quantity"])."','".htmlspecialchars($params["ticket-quantity"])."','".htmlspecialchars($params["location"])."','".htmlspecialchars($params["start-date"])."','".htmlspecialchars($params["end-date"])."','".htmlspecialchars($params["artist"])."',0,".htmlspecialchars($params['user-id']).")");
        }
        // Update types
        // Get the event for the id
        if(isset($params["event-id"]))
        {
            $result = $CI->db->query("SELECT * FROM events WHERE Id=".$params["event-id"]);
        }
        else
        {
            $result = $CI->db->query("SELECT * FROM events ORDER BY Id DESC LIMIT 1");
        }
        $row = $result->row_array();
        if(isset($row))
        {
            $eventId = $row["Id"];
            foreach ($types as $type) 
            {
                if($type != "")
                {
                    // Check if type already exists
                    $existingType = $CI->db->query("SELECT * FROM eventtypes WHERE IdEvent=".$eventId." AND IdEventType=".$type);
                    $row = $existingType->row_array();
                    if(!isset($row))
                    {
                        // no - add the type
                        $result = $CI->db->query("INSERT INTO eventtypes (IdEvent, IdEventType) VALUES (".$eventId.",".$type.")");
                    }
                }    
            }
            $returnValues['success'] = true;
		    $returnValues['message'] = "Veranstaltung wurde gespeichert.";
        }
        else
        {
            $returnValues['success'] = false;
		    $returnValues['message'] = "Die Veranstaltung konnte nicht gespeichert werden.";
        }
        $this->db->close();
        return json_encode($returnValues);
    }

    // Deletes a specific events
    public function delete_event($params)
    {
        if(!isset($params['id']))
        {
            $returnValues['success'] = false;
            $returnValues['message'] = "Die Veranstaltung konnte nicht aufgelöst werden. (No id)";
            return json_encode($returnValues);
        }
        $id = $params['id'];
        $CI = &get_instance();
        $CI->load->database();
        // Delete the event-types
        if($CI->db->query("DELETE FROM eventtypes WHERE IdEvent = ".$id))
        {
            if($CI->db->query("DELETE FROM ticket WHERE IdEvent = ".$id))
            {
                if($CI->db->query("DELETE FROM events WHERE Id = ".$id))
                {
                    $returnValues['success'] = true;
                    $returnValues['message'] = "Die Veranstaltung wurde aufgelöst.";
                }
                else
                {
                    $returnValues['success'] = false;
                    $returnValues['message'] = "Metadaten und Tickets wurden entfernt, die Veranstaltung konnte nicht aufgelöst werden.";
                }
            }
            else
            {
                $returnValues['success'] = false;
                $returnValues['message'] = "Metadaten entfernt, die Veranstaltung und die Tickets konnte nicht aufgelöst werden.";
            }
        }
        else
        {
            $returnValues['success'] = false;
            $returnValues['message'] = "Die Veranstaltung konnte nicht aufgelöst werden.";
        }
        $this->db->close();
        return json_encode($returnValues);
    }
}
?>