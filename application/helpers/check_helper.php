<?php

function check_akses($id_role, $id_menu)
{
	$ci = get_instance();

	$ci->db->where('role_id', $id_role);
	$ci->db->where('menu_id', $id_menu);
	$result = $ci->db->get('user_access_menu');

	if ($result->num_rows() > 0) {
		return "checked='checked'";
	} else {
		return '';
	}
}
