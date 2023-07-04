<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_log_in();
	}
	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Profil Saya";
		$this->load->view('user/index', $data);
	}

	public function edit()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Edit Profil";
		$this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'Email wajib diisi!', 'valid_email' => 'Email Anda tidak valid!']);
		$this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama wajib diisi!']);
		$this->form_validation->set_rules('image', 'Image', 'callback_validation_image');
		if ($this->form_validation->run() == false) {
			$this->load->view('user/edit', $data);
		} else {
			$email = $this->input->post('email');
			$name = $this->input->post('name');

			// Gambar
			$upload_gambar = $_FILES['image']['name'];

			if ($upload_gambar) {
				$config['upload_path'] = './assets/img/profile/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']     = '512';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('image')) {
					echo $this->upload->display_errors();
				} else {
					$gambar_lama = $data['user']['image'];
					if ($gambar_lama != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
					}
					$gambar_baru = $this->upload->data('file_name');
					$this->db->set('image', $gambar_baru);
				}
			}

			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');
			$this->session->set_flashdata('pesan', 'diubah!');
			redirect('user');
		}
	}

	public function validation_image()
	{
		$allowed_mime_type_arr = array('image/jpeg', 'image/jpg', 'image/png');

		$mime = get_mime_by_extension($_FILES['image']['name']);

		if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null) {
			if (filesize($_FILES['image']['tmp_name']) > 500000) {
				$this->form_validation->set_message('validation_image', 'Gambar ini tidak boleh lebih dari 500Kb!');
				return false;
			}
			if (!in_array($mime, $allowed_mime_type_arr)) {
				$this->form_validation->set_message('validation_image', 'File ini hanya berformat jpg/jpeg/png!');
				return false;
			} else {
				return true;
			}
		}
	}

	public function ubahpassword()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Ubah Password";
		$this->form_validation->set_rules('old_password', 'Old Password', 'required|min_length[5]', ['required' => 'Password Lama anda wajib diisi!', 'min_length' => 'Password lama anda terlalu pendek!']);
		$this->form_validation->set_rules('password1', 'Password1', 'required|min_length[5]|matches[password2]', ['required' => 'Password baru anda wajib diisi!', 'min_length' => 'Password baru anda terlalu pendek!', 'matches' => 'Password baru anda tidak cocok!']);
		$this->form_validation->set_rules('password2', 'Password2', 'required|min_length[5]', ['required' => 'Konfirmasi password anda wajib diisi!', 'min_length' => 'Konfirmasi password anda terlalu pendek!']);
		if ($this->form_validation->run() == false) {
			$this->load->view('user/ubahpassword', $data);
		} else {
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('password1');
			if (password_verify($old_password, $data['user']['password'])) {
				if ($old_password == $new_password) {
					$this->session->set_flashdata('pesan', 'tidak boleh sama dengan password lama!');
					redirect('user/ubahpassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('success', 'berhasil diupdate!');
					redirect('user/ubahpassword');
				}
			} else {
				$this->session->set_flashdata('pesan', 'tidak cocok dengan database!');
				redirect('user/ubahpassword');
			}
		}
	}
}
