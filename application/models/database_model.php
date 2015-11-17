<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Database_Model extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
	
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
		if( $row )
		{
			return $row->password;
		}
		else
		{
			return null;
		}
	}
	//get data from api_usage tables
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
	
	public function get_usage_admin($monthdeduct)
	{
		$return = array();
		$total_arr = array();
		$api_usage_text = array();
		$api_usage_word = array();
		$api_usage_definition = array();
		
		$today = date('Y-m-d H:i:s');
		$minus2months = date('Y-m-d H:i:s',(strtotime ( '-'.$monthdeduct.' month' , strtotime ( $today) ) ));
		$where = "WHERE datetime<='".$today."' AND datetime>='".$minus2months."'";
		// $sql = "SELECT * FROM api_usage_text ".$where." ORDER BY datetime";
		// echo $sql;exit();
		
		//TEXT
		$sql = "SELECT * FROM api_usage_text ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//api_usage_text
				if( isset( $api_usage_text[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				//total_arr
				if( isset( $total_arr[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				
			}
		}
		
		//WORD
		$sql = "SELECT * FROM api_usage_word ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//api_usage_word
				if( isset( $api_usage_word[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				//total_arr
				if( isset( $total_arr[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				
			}
		}
		
		//Definition
		$sql = "SELECT * FROM api_usage_definition ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//api_usage_definition
				if( isset( $api_usage_definition[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				//total_arr
				if( isset( $total_arr[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				
			}
		}
		ksort($total_arr);
		$return['total'] = $total_arr;
		$return['text'] = $api_usage_text;
		$return['word'] = $api_usage_word;
		$return['defi'] = $api_usage_definition;
		
		return $return;
	}
	
	//users
	public function get_usage_users($monthdeduct,$apikey)
	{
		$return = array();
		$total_arr = array();
		$api_usage_text = array();
		$api_usage_word = array();
		$api_usage_definition = array();
		
		$today = date('Y-m-d H:i:s');
		$minus2months = date('Y-m-d H:i:s',(strtotime ( '-'.$monthdeduct.' month' , strtotime ( $today) ) ));
		$where = "WHERE datetime<='".$today."' AND datetime>='".$minus2months."' AND apikey ='".$apikey."'";
		// $sql = "SELECT * FROM api_usage_text ".$where." ORDER BY datetime";
		// echo $sql;exit();
		
		//TEXT
		$sql = "SELECT * FROM api_usage_text ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//api_usage_text
				if( isset( $api_usage_text[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$api_usage_text[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				//total_arr
				if( isset( $total_arr[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				
			}
		}
		
		//WORD
		$sql = "SELECT * FROM api_usage_word ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//api_usage_word
				if( isset( $api_usage_word[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$api_usage_word[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				//total_arr
				if( isset( $total_arr[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				
			}
		}
		
		//Definition
		$sql = "SELECT * FROM api_usage_definition ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				//api_usage_definition
				if( isset( $api_usage_definition[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$api_usage_definition[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				//total_arr
				if( isset( $total_arr[date('m-d-Y',strtotime($row['datetime']))] ) )
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] += $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count']++;
				}
				else
				{
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['amount'] = $row['length'];
					$total_arr[date('m-d-Y',strtotime($row['datetime']))]['count'] = 1;
				}
				
			}
		}
		ksort($total_arr);
		$return['total'] = $total_arr;
		$return['text'] = $api_usage_text;
		$return['word'] = $api_usage_word;
		$return['defi'] = $api_usage_definition;
		
		return $return;

	}
	
	public function save_pic_link($email,$pic_link)
	{
		$this->db->where('email', $email);
		$this->db->update('api_users', array('photo_link' => $pic_link) ); 
	}
	
	public function accountsettings_edit_info($email,$value,$target)
	{
		$this->db->where('email', $email);
		$this->db->update('api_users', array($target => $value)); 
	}
	
	public function accountsettings_change_email($current_email, $new_email)
	{
		$data = array(
			'confirm' => '0',
			'email' => $new_email
			);
		$this->db->where('email', $current_email);
		$this->db->update('api_users', $data); 
	}
	
	public function change_password($email,$new_pass)
	{
		$data = array(
			'password' => $new_pass
			);
		$this->db->where('email', $email);
		$this->db->update('api_users', $data); 
	}
	
	public function get_billing_user($apikey)
	{
		$result = array();
		
		$sql = "SELECT * FROM api_billing ab LEFT JOIN api_billing_history abh 
		ON ab.billing_id = abh.api_billing_id 
		WHERE ab.apikey = '".$apikey."' 
		AND ab.amount <> '0.00' ORDER BY date_from DESC";
		// echo $sql;
		// exit();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function get_remaining_billing($apikey,$day1,$daylast)
	{
		$result = array();
		$where = "WHERE datetime>='".$day1."' AND datetime<='".$daylast."' AND apikey ='".$apikey."'";
		
		//text
		$sql = "SELECT SUM(length)as sum_text FROM api_usage_text ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if( is_null($row['sum_text']) )
			{
				$result['text'] = 0;
			}
			else
			{
				$result['text'] = $row['sum_text'];
			}
		}
		else
		{
			$result['text'] = 0;
		}
		//word
		$sql = "SELECT SUM(length)as sum_text FROM api_usage_word ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if( is_null($row['sum_text']) )
			{
				$result['word'] = 0;
			}
			else
			{
				$result['word'] = $row['sum_text'];
			}
		}
		else
		{
			$result['word'] = 0;
		}
		//definition
		$sql = "SELECT SUM(length)as sum_text FROM api_usage_definition ".$where." ORDER BY datetime";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if( is_null($row['sum_text']) )
			{
				$result['definition'] = 0;
			}
			else
			{
				$result['definition'] = $row['sum_text'];
			}
		}
		else
		{
			$result['definition'] = 0;
		}
		
		$result['total'] = $result['text'] + $result['definition'] + $result['word'];

		return $result;
	}
	
	public function get_past_billing($api_key,$today)
	{
		$result = array();
		$newday = date('Y-m-d',(strtotime ( '-1 month' , strtotime ( $today) ) ));
		$sql = "SELECT * FROM api_billing_history WHERE apikey='".$api_key."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->result_array();
			$result = $row;
		}
		return $result;
	}
	
	public function get_user_list()
	{
		$sql = "SELECT * FROM api_users WHERE user_type = 'user' ORDER BY start_date DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	
	//paypal
	public function paid_complete($api_billing,$amount_paid)
	{
		foreach($api_billing as $k => $v)
		{
			$data = array(
			   'api_billing_id' => $k ,
			   'amount_paid' => $v
			);
			$this->db->insert('api_billing_history', $data);
		}
	}
	
	public function get_billing_history($apikey)
	{
		$result = array();
		$sql = "SELECT * FROM api_billing ab LEFT JOIN api_billing_history abh
			ON ab.billing_id = abh.api_billing_id WHERE ab.apikey='".$apikey."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->result_array();
			$result = $row;
		}
		return $result;
	}
	
	public function create_billing($date1,$date2)
	{
		$result = array();
		$sql = "SELECT * FROM api_users WHERE user_type = 'user'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();
			foreach($row as $v)
			{
				// $row[] = $v['apikey'];
				$result[$v['apikey']] = $this->get_remaining_billing($v['apikey'],$date1,$date2);
			}
		}
		return $result;
	}
	
	public function last_billed_date()
	{
		// $return = date('Y-m-01');
		$return = false;
		$sql = "SELECT * FROM api_billing ORDER BY date_to DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->result_array();
			$return = date('Y-m-d',strtotime($row[0]['date_to']));
		}
		return $return;
	}
	
	public function insert_billing($data)
	{
		$this->db->insert('api_billing',$data);
	}
}
?>