<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_log_in();
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Dashboard";
		$this->load->view('admin/index', $data);
	}

	public function role()
	{
		$this->form_validation->set_rules('role', 'Role', 'required', ['required' => 'Nama Akses wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = "Kelola Akses";
			$data['role'] = $this->akses->getExceptAdmin();
			$this->load->view('admin/role', $data);
		} else {
			$data = [
				'role' => $this->input->post('role')
			];

			$this->db->insert('user_role', $data);
			$this->session->set_flashdata('pesan', 'ditambah!');
			redirect('admin/role');
		}
	}

	public function hapus_role($id_role)
	{
		$id = $this->input->post('id');
		$data = [
			'id' => $id,
		];

		$this->db->where('id', $id_role);
		$this->db->delete('user_role', $data);
		$this->session->set_flashdata('pesan', 'dihapus!');
		redirect('admin/role');
	}

	public function edit_role($id_role)
	{
		$id = $this->input->post('id');
		$data = [
			'id' => $id,
			'role' => $this->input->post('role')
		];

		$this->db->where('id', $id_role);
		$this->db->update('user_role', $data);
		$this->session->set_flashdata('pesan', 'diubah!');
		redirect('admin/role');
	}

	public function akses($id_role)
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Kelola Akses";
		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['role'] = $this->db->get_where('user_role', ['id' => $id_role])->row_array();
		$this->load->view('admin/kelolaakses', $data);
	}

	public function ubah_akses()
	{
		$id_menu = $this->input->post('menuId');
		$id_role = $this->input->post('roleId');

		$data = [
			'role_id' => $id_role,
			'menu_id' => $id_menu
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() > 0) {
			$this->db->delete('user_access_menu', $data);
		} else {
			$this->db->insert('user_access_menu', $data);
		}

		$this->session->set_flashdata('pesan', 'diubah!');
	}
}
