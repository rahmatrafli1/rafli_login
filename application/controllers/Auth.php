<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
						Password anda salah! Silahkan coba lagi!
					</div>');
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Email anda belum diaktifasi!
				</div>');
				redirect('/');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
				Email anda tidak terdaftar! Silahkan daftar akun anda!
			</div>');
			redirect('/');
		}
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['required' => 'Email anda wajib diisi!', 'valid_email' => 'Email anda tidak valid!']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]', ['required' => 'Password anda wajib diisi!', 'min_length' => 'Password anda terlalu pendek!']);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Halaman Login';
			$this->load->view('auth/login', $data);
		} else {
			$this->_login();
		}
	}

	public function register()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama Lengkap anda wajib diisi!']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', ['required' => 'Email anda wajib diisi!', 'valid_email' => 'Email anda tidak valid!', 'is_unique' => 'Email ini sudah terdaftar!']);
		$this->form_validation->set_rules('password1', 'Password1', 'trim|required|matches[password2]|min_length[5]', ['required' => 'Password anda wajib diisi!', 'matches' => 'Password anda tidak cocok!', 'min_length' => 'Password anda terlalu pendek!']);
		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|min_length[5]', ['required' => 'Password anda wajib diisi!', 'min_length' => 'Password anda terlalu pendek!']);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Halaman Register';
			$this->load->view('auth/register', $data);
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'image' => 'default.jpg',
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];

			// siapkan token
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
			Berhasil terdaftar! Silahkan aktivasi akun anda!
		  </div>');
			redirect('/');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'sandbox.smtp.mailtrap.io',
			'smtp_port' => 2525,
			'smtp_user' => 'de71ce68815d83',
			'smtp_pass' => 'd6202dc5c5b843',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);

		$this->email->from('admin@example.com', 'Administrator Rafli Login');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function blocked()
	{
		$data['title'] = "403 Forbidden";
		$this->load->view('403', $data);
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Akun anda sudah di aktivasi! Silahkan masuk akun anda.</div>');
					redirect('/');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktivasi akun anda gagal! Token sudah tidak berlaku.</div>');
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktivasi akun anda gagal! Token anda salah.</div>');
				redirect('/');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Aktivasi akun anda gagal! Email anda salah.</div>');
			redirect('/');
		}
	}

	public function lupapassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['required' => 'Email anda wajib diisi!', 'valid_email' => 'Email anda tidak valid!']);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Lupa Password';
			$this->load->view('auth/lupapassword', $data);
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil! Silahkan cek email anda untuk mereset password!</div>');
				redirect('auth/lupapassword');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal! Email anda tidak terdaftar atau tidak diaktivasi!</div>');
				redirect('auth/lupapassword');
			}
		}
	}

	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->ubahpassword();
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Reset password gagal! Token anda salah.</div>');
				redirect('/');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Reset password gagal! Email anda salah.</div>');
			redirect('/');
		}
	}

	public function ubahpassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('/');
		}

		$this->form_validation->set_rules('password1', 'Password1', 'trim|required|matches[password2]|min_length[5]', ['required' => 'Password anda wajib diisi!', 'matches' => 'Password anda tidak cocok!', 'min_length' => 'Password anda terlalu pendek!']);
		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|min_length[5]', ['required' => 'Password anda wajib diisi!', 'min_length' => 'Password anda terlalu pendek!']);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Ubah Password';
			$this->load->view('auth/ubahpassword', $data);
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->db->delete('user_token', ['email' => $email]);

			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password berhasil diubah! Silahkan masuk akun anda.</div>');
			redirect('/');
		}
	}
}
