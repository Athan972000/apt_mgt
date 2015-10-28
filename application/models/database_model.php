<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Database_Model extends CI_Model {
	
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
			return $row->confirm;
		}
	}
	
	public function verifier($email,$key)
	{
		$sql = "SELECT email, password FROM api_users WHERE email ='".$email."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 1)
		{
			return FALSE;
		}
		else
		{
			$row = $query->row();
			// echo $key." ".$row->email.$row->password;
			if( $key == md5($row->email.$row->password) )
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	public function confirmed($email)
	{
		$data = array('confirm' => '1');
		$this->db->where('email', $email);
		$this->db->update('api_users', $data); 
	}
	
	public function get_password($email)
	{
		$sql = "SELECT password FROM api_users WHERE email = '".$email."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->password;
	}
	//get data from api_usage_text table
	public function get_usage($apikey,$table)
	{
		$this->db->select('datetime');
		$this->db->select('length');
		$this->db->from($table);
		$this->db->where('apikey',$apikey);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$data = array();
			foreach($query->result_array() as $key => $value){
				$old =  $value['datetime'];
				$temp = strtotime($old);
				$newDate = date('m-d-Y',$temp);
				$data[$key]['date'] = $newDate;
				$data[$key]['length'] =(int)$value['length'];
			}
			return $data;
		}
		
		return NULL;
	}
	
	
	
	
	
	
}
?>