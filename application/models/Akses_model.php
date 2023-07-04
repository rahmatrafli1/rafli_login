<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akses_model extends CI_Model
{
	public function getExceptAdmin()
	{
		$query = "SELECT * FROM `user_role` WHERE `role` != 'Admin'";
		return $this->db->query($query)->result_array();
	}
}
