<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Computation_Model extends CI_Model {

	public function __construct() {
        parent::__construct();
    }
	
	public function compute_length($length)
	{
		$result = $length * 0.00002;
		return round($result, 2);
	}
	
	public function compute_total($arr)
	{
		$total = 0;
		foreach($arr as $v)
		{
			$total += $v;
		}
		return round($total, 2);
	}
}
?>