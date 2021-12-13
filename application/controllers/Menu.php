<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function index()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['name'] = $data['user']['name'];
    $data['title'] = "Menu Management";
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('menu', 'Menu', 'required', ['required' => 'Menu must required']);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('templates/footer');
    } else {
      $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Menu has been successfully added</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
      redirect('menu');
    }
  }

  public function edit($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['name'] = $data['user']['name'];
    $data['title'] = "Edit Menu";
    $data['menu'] = $this->Menu_model->getMenuById($id);
    $this->form_validation->set_rules(
      'menu',
      'Menu',
      'required',
      array('required' => 'Menu must required')
    );


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/edit', $data);
      $this->load->view('templates/footer');
    } else {
      $this->Menu_model->editMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Menu has been successfully updated</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
      redirect('menu');
    }
  }

  public function delete($id)
  {
    $this->Menu_model->deleteMenu($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Menu has been successfully deleted</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    redirect('menu');
  }

  public function submenu()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['name'] = $data['user']['name'];
    $data['title'] = "Sub Menu Management";
    $data['submenu'] = $this->SubMenu_Model->getSubMenu();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->form_validation->set_rules('title', 'Title', 'required', ['required' => 'Title must required']);
    $this->form_validation->set_rules('menu_id', 'Menu', 'required', ['required' => 'Menu must required']);
    $this->form_validation->set_rules('url', 'URL', 'required', ['required' => 'URL must required']);
    $this->form_validation->set_rules('icon', 'Icon', 'required', ['required' => 'Icon must required']);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('menu/submenu', $data);
      $this->load->view('templates/footer');
    } else {
      $this->SubMenu_Model->insertSubMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sub Menu has been successfully added</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
      redirect('menu/submenu');
    }
  }

  public function editSubMenu($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['name'] = $data['user']['name'];
    $data['title'] = "Edit Sub Menu Management";
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $data['submenu'] = $this->SubMenu_Model->getSubMenuById($id);

    $this->form_validation->set_rules('title', 'Title', 'required', ['required' => 'Title must required']);
    $this->form_validation->set_rules('menu_id', 'Menu', 'required', ['required' => 'Menu must required']);
    $this->form_validation->set_rules('url', 'URL', 'required', ['required' => 'URL must required']);
    $this->form_validation->set_rules('icon', 'Icon', 'required', ['required' => 'Icon must required']);


    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('submenu/edit', $data);
      $this->load->view('templates/footer');
    } else {
      $this->SubMenu_Model->editSubMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sub Menu has been successfully updated</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
      redirect('menu/submenu');
    }
  }

  public function deleteSM($id)
  {
    $this->SubMenu_Model->deleteSubMenu($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sub Menu has been successfully deleted</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
    redirect('menu/submenu');
  }
}
