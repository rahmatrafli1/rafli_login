<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_log_in();
	}

	public function index()
	{
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Kelola Menu";
		$this->load->view('menu/index', $data);
	}

	public function submenu()
	{
		$this->form_validation->set_rules('menu_id', 'Menu ID', 'required', ['required' => 'Menu wajib diisi!']);
		$this->form_validation->set_rules('title', 'Title', 'required', ['required' => 'Sub Menu wajib diisi!']);
		$this->form_validation->set_rules('url', 'URL', 'required', ['required' => 'URL wajib diisi!']);
		$this->form_validation->set_rules('icon', 'Icon', 'required', ['required' => 'Icon wajib diisi!']);
		$this->form_validation->set_rules('is_active', 'Active', 'required', ['required' => 'Aktif wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			$data['submenu'] = $this->menu->getSubMenu();
			$data['menu'] = $this->menu->getExceptMenu();
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = "Kelola Sub Menu";
			$this->load->view('menu/submenu', $data);
		} else {
			$data = [
				'menu_id' => $this->input->post('menu_id'),
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active'),
			];

			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('pesan', 'ditambah!');
			redirect('menu/submenu');
		}
	}

	public function tambah_menu()
	{
		$this->form_validation->set_rules('menu', 'Menu', 'required', ['required' => 'Menu wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			$data['menu'] = $this->db->get('user_menu')->result_array();
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = "Kelola Menu";
			$this->load->view('menu/index', $data);
		} else {
			$menu_input = $this->input->post('menu', true);
			$data = [
				'menu' => $menu_input
			];

			$this->db->insert('user_menu', $data);
			$this->session->set_flashdata('pesan', 'ditambah!');
			redirect('menu');
		}
	}

	public function edit_menu($id_menu)
	{
		$this->form_validation->set_rules('menu', 'Menu', 'required', ['required' => 'Menu wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			$data['menu'] = $this->db->get('user_menu')->result_array();
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = "Kelola Menu";
			$this->load->view('menu/index', $data);
		} else {
			$id = $this->input->post('id');
			$menu_input = $this->input->post('menu', true);
			$data = [
				'id' => $id,
				'menu' => $menu_input
			];

			$this->db->where('id', $id_menu);
			$this->db->update('user_menu', $data);
			$this->session->set_flashdata('pesan', 'diubah!');
			redirect('menu');
		}
	}

	public function hapus_menu($id_menu)
	{
		$id = $this->input->post('id');
		$data = [
			'id' => $id,
		];

		$this->db->where('id', $id_menu);
		$this->db->delete('user_menu', $data);
		$this->session->set_flashdata('pesan', 'dihapus!');
		redirect('menu');
	}

	public function hapus_submenu($id_submenu)
	{
		$id = $this->input->post('id');
		$data = [
			'id' => $id,
		];

		$this->db->where('id', $id_submenu);
		$this->db->delete('user_sub_menu', $data);
		$this->session->set_flashdata('pesan', 'dihapus!');
		redirect('menu/submenu');
	}

	public function edit_submenu($id_submenu)
	{
		$this->form_validation->set_rules('menu_id', 'Menu ID', 'required', ['required' => 'Menu wajib diisi!']);
		$this->form_validation->set_rules('title', 'Title', 'required', ['required' => 'Sub Menu wajib diisi!']);
		$this->form_validation->set_rules('url', 'URL', 'required', ['required' => 'URL wajib diisi!']);
		$this->form_validation->set_rules('icon', 'Icon', 'required', ['required' => 'Icon wajib diisi!']);
		$this->form_validation->set_rules('is_active', 'Active', 'required', ['required' => 'Aktif wajib diisi!']);
		if ($this->form_validation->run() == FALSE) {
			$data['submenu'] = $this->menu->getSubMenu();
			$data['menu'] = $this->menu->getExceptMenu();
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['title'] = "Kelola Sub Menu";
			$this->load->view('menu/submenu', $data);
		} else {
			$id = $this->input->post('id');
			$data = [
				'id' => $id,
				'menu_id' => $this->input->post('menu_id'),
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active'),
			];

			$this->db->where('id', $id_submenu);
			$this->db->update('user_sub_menu', $data);
			$this->session->set_flashdata('pesan', 'diubah!');
			redirect('menu/submenu');
		}
	}
}
