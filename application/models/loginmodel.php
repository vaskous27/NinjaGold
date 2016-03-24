<?php

class loginmodel extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	public function InsertInfo($user_details) {

		$query = "INSERT INTO users(first_name, last_name, email, password, created_at, updated_at) VALUES(?,?,?,?,NOW(),NOW())";
		$values = array($user_details['firstname'], $user_details['lastname'], $user_details['email'], $user_details['password']);

	 	  return $this->db->query($query, $values); 		
	}

	public function RetrieveInfo($email) {

		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email)) -> row_array();
	}
}

?>