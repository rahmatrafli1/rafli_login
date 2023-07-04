<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
			Anda harus masuk akun!
		  </div>');
			redirect('/');
		}
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Pengaturan";
		$this->load->view('pengaturan/index', $data);
	}
}
