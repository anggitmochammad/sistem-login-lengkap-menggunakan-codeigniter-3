<?php

function is_logged_in()
{
    // instance untuk memanggil library CI karena helper tidak termasuk dalam struktur MVC
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        //mendapatkan role_id
        $role_id = $ci->session->userdata('role_id');
        //mendapatkan menu dari url
        $menu = $ci->uri->segment(1);

        // mencari menu_id dengan cara mencocokan dengan $menu
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];


        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    // mengecek tabel use_acccess_menu dengan mencocokkan role_id dan menu_id
    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    // memeriksa $result kalau ada maka di checklist
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
