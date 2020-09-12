<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['title'] = 'Role';
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->set('role', $this->input->post('role'));
            $this->db->insert('user_role');

            $this->session->set_flashdata('message', 'New Role Added');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    // parameter diambil lewat url
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['title'] = 'Role Access';
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        // agar menu admin tidak muncul
        $data['menu'] = $this->db->get_where('user_menu', [
            'id != ' => 1
        ])->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }
    public function deleterole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', 'Role Deleted');
        redirect('admin/role');
    }
    public function editrole($role_id)
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->result_array();

        $this->form_validation->set_rules('edit-role', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-role', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->set('role', $this->input->post('edit-role'));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_role');

            $this->session->set_flashdata('message', 'Edit Role');
            redirect('admin/role');
        }
    }
    public function changeAccess()
    {
        // mengambil data dari ajax pada halaman view footer
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        // select * FROM tabel user_access_menu WHERE $data
        $result = $this->db->get_where('user_access_menu', $data);

        // mengecek apakah data data ada apa tidak jika ada maka insert jika tidak hapus sesuai dengan perintah
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed !
             </div>');
        // sudah diredirect oleh javascript pada halaman view footer
    }
}
