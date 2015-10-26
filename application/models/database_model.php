<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Database_Model extends CI_Model{
	
	//insert registration data into DB0
	public function registration_insert($data){
		$condition="email ="."'".$data['email']."'";
		$this->db->select('*');
		$this->db->from('api_users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()==0){
			//insert data
			$this->db->insert('api_users',$data);
			if($this->db->affected_rows()>0){
				return true;
			}
			else{return false;}
		}
		else{
			return "Email address already in use.";
		}
	}
	
	//Read data to verify login credentials
	public function login($data){
		$condition = "email ="."'".$data['email']."' AND "."password ="."'" .$data['password']."'";
		$this->db->select('*');
		$this->db->from('api_users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows()==1){
			return true;
		}
		else{
			return false;
		}
	}
	
	// Read data from database to show data in admin page
	public function read_user_information($email) {

		$condition = "email =" . "'" . $email . "'";
		$this->db->select('*');
		$this->db->from('api_users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	//checks if email confirmed
	public function check_confirmation_email($email)
	{
		$sql = "SELECT confirm FROM api_users WHERE email = '".$email."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() < 1)
		{
			return FALSE;
		}
		else
		{
			$row = $query->row();
			return $row['confirm'];
		}
	}
}
?>