<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    // --------Menu---------------
    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['title'] = 'Menu Management';
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $id = $this->uri->segment('3');
        $data['menu_user'] = $this->db->get_where('user_menu', [
            'id' => $id
        ])->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', 'Added Successfully');
            redirect('menu');
        }
    }

    // $id dari url 
    public function editmenu($id)
    {
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->result_array();
        // $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('edit-menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editmenu', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->set('menu', $this->input->post('edit-menu'));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_menu');

            $this->session->set_flashdata('message', 'Edit Menu');
            redirect('menu');
        }
    }
    // $id dari url
    public function deletemenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('message', 'Deleted Successfully');
        redirect('menu');
    }

    // --------Sub Menu---------------
    public function submenu()
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['title'] = 'Submenu Management';
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] =  $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', 'New Sub Menu Added');
            redirect('menu/submenu');
        }
    }

    // $id mengambil dari url
    public function editSubMenu($id)
    {
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['title'] = 'Edit Submenu Management';
        $this->load->model('Menu_model', 'menu');
        $data['submenu'] = $this->menu->getSubMenuById($id);
        $data['menu'] =  $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('edit_title', 'Title', 'required');
        $this->form_validation->set_rules('edit_menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('edit_url', 'URL', 'required');
        $this->form_validation->set_rules('edit_icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit-submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('edit_title'),
                'menu_id' => $this->input->post('edit_menu_id'),
                'url' => $this->input->post('edit_url'),
                'icon' => $this->input->post('edit_icon')
            ];
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu', $data);
            $this->session->set_flashdata('message', 'Sub Menu Changed');
            redirect('menu/submenu');
        }
    }
    public function deletesubmenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('message', 'Deleted Successfully');
        redirect('menu/submenu');
    }
}
