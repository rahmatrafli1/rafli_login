<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function getRoleById($id)
    {
        $query = $this->db->get_where('user_role', array('id' => $id));
        return $query->row_array();
    }

    public function editRole()
    {
        $data = array(
            'role' => $this->input->post('role', true),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }

    public function deleteRoleID($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }
}
