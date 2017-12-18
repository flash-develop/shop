<?php

class Users_model extends CI_Model {

	function __construct() 
	{ 
		parent::__construct(); 
	}

	function authentication($post)
	{
		$hashed_password = $this->encrypting($post['password']);

		$q = "SELECT * 
			FROM users 
			WHERE (email = '{$post['email_or_username']}' AND password = '{$hashed_password}')
			OR (username = '{$post['email_or_username']}' AND password = '{$hashed_password}')
			";

		$query = $this->db->query($q);
		$result = $query->row();

		return $result;
	}

	function isLoggedIn()
	{
		$user_id = $this->session->userdata('user_id');

		if(!$user_id) {
			return false;
		}
		return true;
	}

	function set_new_user($post)
	{
		$last_address_id = 'DEFAULT';

		if (isset($post['show-address-checkbox'])) {
			$last_address_id = $this->set_new_user_address($post);
		}

		$hashed_password = $this->encrypting($post['password']);

		$q = "INSERT INTO users (email, password, username, first_name, last_name, address_id) 
		VALUES (
			'{$post['email']}', 
			'{$hashed_password}', 
			'{$post['username']}', 
			'{$post['first_name']}', 
			'{$post['last_name']}',
			{$last_address_id}
		)";
//var_dump($q);exit;
		$query = $this->db->query($q);
		return true;
	}

	function set_new_user_address($post)
	{
		$q = "INSERT INTO addresses (city, street, building, apartment, region_id, country_id) 
		VALUES (
		'{$post['city']}', 
		'{$post['street']}', 
		'{$post['building']}', 
		'{$post['apartment']}', 
		'{$post['region']}',
		'{$post['country']}')";
		$query = $this->db->query($q);

		return $this->db->insert_id();;
	}

	function encrypting($data)
	{
		$sault = md5('flasher');
		$email = md5($data);
		$hashed_data = md5($email.$sault);

		return $hashed_data;
	}

	function checkEmail($post)
	{
		$q = "SELECT * FROM users WHERE email = '{$post['email']}'";

		$query = $this->db->query($q);
		$user = $query->row();

		if ($user) {
			return $this->hash_email($user);
		}

		return false;
	}

	function hash_email($user)
	{
		$sault = md5('flasher');
		$email = md5($user->email);
		$hashed_email = md5($email.$sault);

		$q = "INSERT INTO users_hash_data (user_id, hashed_email) 
		VALUES (
		'{$user->id}', 
		'{$hashed_email}')";
		$query = $this->db->query($q);

		return $hashed_email;
	}

	function get_hash_id($hashed_in_url_email)
	{
		$q = "SELECT user_id FROM users_hash_data WHERE hashed_email = '{$hashed_in_url_email}'";
		$query = $this->db->query($q);
		$result = $query->row();

		if (!$result) {
			return false;
		}

		return $result->user_id;
	}

	function get_user_id($id_from_user_hash_data)
	{
		$q = "SELECT * FROM users WHERE id = '{$id_from_user_hash_data->user_id}'";
		$query = $this->db->query($q);
		$get_id_from_users = $query->row();

		return $get_id_from_users;
	}

	function changePassInTable($post)
	{
		$hashed_password = $this->encrypting($post['password']);

		$q = "UPDATE users SET password = '{$hashed_password}' WHERE id = '{$post['user_id']}'";
		$query = $this->db->query($q);

		return true;
	}
}