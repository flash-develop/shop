<?php

class Addresses_model extends CI_Model {

	function __construct() 
	{ 
		parent::__construct(); 
	}

	public function getCountry()
	{
		$q = "SELECT * 
			FROM countries
			WHERE 1";
		
		$query = $this->db->query($q);
		$result = $query->result();

		return $result;
	}

	public function getRegion()
	{
		$q = "SELECT * 
			FROM regions
			WHERE 1";
		
		$query = $this->db->query($q);
		$result = $query->result();

		return $result;
	}
}