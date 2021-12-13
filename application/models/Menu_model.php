<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getMenuById($id)
    {
        $query = $this->db->get_where('user_menu', array('id' => $id));
        return $query->row_array();
    }

    public function editMenu()
    {
        $data = array(
            'menu' => $this->input->post('menu', true),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }
}
