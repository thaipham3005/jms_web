<?php

class Model_auth extends CI_Model
{
    public function __construct()
    {
        // parent::__construct();
    }

    /* 
		This function checks if the login_id exists in the database
	*/
    public function check_login_id($login_id)
    {
        if ($login_id) {
            $sql = 'SELECT * FROM users WHERE login_id = ?';
            $query = $this->db->query($sql, array($login_id));
            $result = $query->num_rows();
            return ($result == 1) ? true : false;
        }

        return false;
    }

    /* 
		This function checks if the email and password matches with the database
	*/
    public function login($login_id, $password)
    {
        
        if ($login_id && $password) {
            $sql = "SELECT * FROM users WHERE login_id = ?";
            $query = $this->db->query($sql, array($login_id));

            if ($query->num_rows() == 1) {
                $result = $query->row_array();

                $hash_password = password_verify($password, $result['password']);
                if ($hash_password === true) {
                    return $result;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}
