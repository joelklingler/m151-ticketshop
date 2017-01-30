<?php
class User_model extends Return_vals
{
	public function authenticate($email, $password)
	{
		// Check if the email and password exists in the db
		$CI = &get_instance();
		$CI->load->database();
		$result = $CI->db->query("SELECT * FROM users WHERE email = '".$email."' && password = '".$password."' LIMIT 1;");
		if($result->num_rows() == 1)
		{
			$userData = array(
				'userId' => -1,
				'roleId' => -1
			);
			// User found
			foreach($result->result() as $row)
			{
				$data[] = $row;
			}
			$res['userInfo'] = $data;
			$userData['userId'] = json_decode(json_encode($res['userInfo'][0]->Id));
			
			// Get user role
			$result = $CI->db->query("SELECT IdRole FROM userroles WHERE IdUser = ". $userData['userId'].";");
			foreach ($result->result() as $row) {
				$roleData[] = $row;
			}
			$res['roleInfo'] = $roleData;
			$userData['roleId'] = json_decode(json_encode($res['roleInfo'][0]->IdRole));

			// Set return values
			$returnValues['success'] = true;
			$returnValues['message'] = "Erfolgreich eingeloggt.";

			// Set session
			$this->session->set_userdata($userData);
            $this->db->close();
		}
		else
		{
			// No user found
			$returnValues['success'] = false;
			$returnValues['message'] = "Die Email / Passwort Kombination ist ungültig.";
		}
		return json_encode($returnValues);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$returnValues['success'] = true;
		$returnValues['message'] = "Sie wurden erfolgreich ausgeloggt.";
		return json_encode($returnValues);
	}
    
    public function save($name, $lastName, $email, $phone, $password, $type, $id = -1)
    {
        $CI = &get_instance();
        $CI->load->database();
        if($id != -1)
        {
            // Check if all data exists
            if(isset($name) && isset($lastName) && isset($email) && isset($phone) && isset($password) && isset($type) && isset($id))
            {
                if($password != -1)
                {
                    if($CI->db->query("UPDATE users SET Name='".$lastName."', FirstName='".$name."', Email='".$email."', Telephone='".$phone."', Password='".sha1(trim(strtolower($password)))."' WHERE Id=".$id.";"))
                    {
                        $returnValues['success'] = true;
                        $returnValues['message'] = "Benutzerdaten aktualisiert. Passwort wurde geändert.";
                    }
                }
                else
                {
                    if($CI->db->query("UPDATE users SET Name='".$lastName."', FirstName='".$name."', Email='".$email."', Telephone='".$phone."' WHERE Id=".$id.";"))
                    {
                        $returnValues['success'] = true;
                        $returnValues['message'] = "Benutzerdaten aktualisiert. Passwort wurde nicht geändert.";
                    }
                }
            }
            else
            {
                $returnValues['success'] = false;
                $returnValues['message'] = "Unzureichende Parameter. Benutzer wurde nicht gespeichert";
            }
        }
        else
        {
            // User is new
            $password = sha1(trim(strtolower($password)));
            // Check if the email already allready exists
            $result = $CI->db->query("SELECT * FROM users WHERE email = '".$email."' LIMIT 1");
            $row = $result->row_array();
            if(isset($row))
            {
                // User exists
                $returnValues['success'] = false;
                $returnValues['message'] = "Die eingegebene E-Mail Adresse ist bereits vorhanden. Bitte wählen Sie eine andere.";
            }
            else
            {
                // OK
                // Create a new User
                $query = $CI->db->query("INSERT INTO users (Name, FirstName, Email, Telephone, Password) VALUES ('".$lastName."','".$name."','".$email."','".$phone."','".$password."');");
                if($query)
                {
                    // Success
                    // Get the created user
                    $result = $CI->db->query("SELECT * FROM users WHERE email = '".$email."'");
                    $row = $result->row_array();
                    if(!isset($row))
                    {
                        $returnValues['success'] = false;
                        $returnValues['message'] = "Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut. 01";
                        $this->db->close();
                        return json_encode($returnValues);
                    }
                    $id = $row["Id"];
                    // Set the user role
                    switch(isset($type))
                    {
                        case true:
                            $roleId = 1;
                            break;
                        case false:
                            $roleId = 2;
                            break;
                    }
                    $query = $CI->db->query("INSERT INTO userroles (IdUser, IdRole) VALUES (".$id.",".$roleId.")");
                    if($query)
                    {
                        $returnValues['success'] = true;
					    $returnValues['message'] = "Registrierung erfolgreich. Sie können sich jetzt einloggen.";
                    }
                    else
                    {
                        // Error
                        $returnValues['success'] = false;
                        $returnValues['message'] = "Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut. 02";    
                    }
                }
                else
                {
                    // Error
                    $returnValues['success'] = false;
                    $returnValues['message'] = "Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut. 03";
                }
            }
        }
        $this->db->close();
        return json_encode($returnValues);
    }

    public function get_user_data()
    {
        $userId = $this->session->userdata;
        $CI = &get_instance();
        $CI->load->database();
        $query = $CI->db->query("SELECT * FROM users WHERE Id = ".$userId['userId']);
        $query = $query->row_array();
        $query['role'] = $userId['roleId'];
        $this->db->close();
        return $query;
    }
}
?>