<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'Users/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Users/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Users/index';
            $config['first_url'] = base_url() . 'Users/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul' => "Akun Pengguna",
            'breadcrumb' => array("Data Akun"),
            'konten' => "users/users_list",
        );
        $this->load->view('container', $data);
    }

    public function truncate_all()
    {
        $res = $this->db->query("DELETE FROM users WHERE username <> '".$this->session->userdata("Username")."'");
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan Akun Pengguna');
        }
        redirect("Asets/set_truncate");
    }

    public function read($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'action' => site_url('Users/update_action'),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'nama' => set_value('nama', $row->nama),
                'email' => set_value('email', $row->email),
                'telepon' => set_value('telepon', $row->telepon),
                'judul' => "Tambah Akun Pengguna",
                'breadcrumb' => array("Data Akun", "Tambah Akun"),
                'konten' => "users/users_read",
                );
            $this->load->view('container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upps!! data tidak ditemukan');
            redirect('Users');
        }
    }

    public function create() 
    {
        $data = array(
            'action' => site_url('Users/create_action'),
    	    'username' => set_value('username'),
    	    'password' => set_value('password'),
    	    'nama' => set_value('nama'),
    	    'email' => set_value('email'),
    	    'telepon' => set_value('telepon'),
            'judul' => "Tambah Akun Pengguna",
            'breadcrumb' => array("Data Akun", "Tambah Akun"),
            'konten' => "users/users_form",
    	);
        $this->load->view('container', $data);
    }
    
    public function create_action() 
    {
        $check = $this->Users_model->get_by_id($this->input->post('username',TRUE));

        if($check){
            $this->session->set_flashdata('errU', 'Username Ini telah digunakan');
            $data = array(
            'action' => site_url('Users/create_action'),
            'username' => $this->input->post('username',TRUE),
            'password' => $this->input->post('password',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            'telepon' => $this->input->post('telepon',TRUE),
            'judul' => "Tambah Data Akun",
            'breadcrumb' => array("Data Akun", "Tambah Akun"),
            'konten' => "users/users_form",
            );
            $this->load->view('container', $data);
            return;
        }else if($this->input->post('password',TRUE) != NULL){
            $this->session->set_flashdata('errP', 'Password tidak boleh kosong');
            $data = array(
            'action' => site_url('Users/create_action'),
            'username' => $this->input->post('username',TRUE),
            'password' => $this->input->post('password',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            'telepon' => $this->input->post('telepon',TRUE),
            'judul' => "Tambah Data Akun",
            'breadcrumb' => array("Data Akun", "Tambah Akun"),
            'konten' => "users/users_form",
            );
            $this->load->view('container', $data);
        }

        $data = array(
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            'telepon' => $this->input->post('telepon',TRUE),
            );

        $this->Users_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect('Users');
    }
    
    public function update($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'action' => site_url('Users/update_action'),
        		'username' => set_value('username', $row->username),
        		'password' => set_value('password', $row->password),
        		'nama' => set_value('nama', $row->nama),
        		'email' => set_value('email', $row->email),
        		'telepon' => set_value('telepon', $row->telepon),
                'judul' => "Tambah Akun Pengguna",
                'breadcrumb' => array("Data Akun", "Tambah Akun"),
                'konten' => "users/users_form",
        	    );
            $this->load->view('container', $data);
        } else {
            $this->session->set_flashdata('message', 'Upps!! data tidak ditemukan');
            redirect('Users');
        }
    }
    
    public function update_action() 
    {
        if($this->session->userdata("Username") != $this->input->post('username',TRUE)){
            $check = $this->Users_model->get_by_id($this->input->post('username',TRUE));
            if($check){
                $this->session->set_flashdata('errU', 'Username Ini telah digunakan');
                $data = array(
                'action' => site_url('Users/update_action'),
                'username' => $this->input->post('username',TRUE),
                'password' => $this->input->post('password',TRUE),
                'nama' => $this->input->post('nama',TRUE),
                'email' => $this->input->post('email',TRUE),
                'telepon' => $this->input->post('telepon',TRUE),
                'judul' => "Ubah Data Akun",
                'breadcrumb' => array("Data Akun", "Ubah Data Akun"),
                'konten' => "users/users_form",
                );
                $this->load->view('container', $data);
                return;
            }
        }
        
        $data['username'] = $this->input->post('username',TRUE);
        if($this->input->post('password',TRUE)!=NULL) $data['password'] = md5($this->input->post('password',TRUE));
        $data['nama'] = $this->input->post('nama',TRUE);
        $data['email'] = $this->input->post('email',TRUE);
        $data['telepon'] = $this->input->post('telepon',TRUE);

        $this->Users_model->update($this->input->post('oldusername', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');

        $updatemutasi = array('user_posting' => $this->input->post('username',TRUE));
        $this->db->where("user_posting", $this->input->post('oldusername', TRUE))->update("mutasi", $updatemutasi);

        if($this->session->userdata("Username") == $this->input->post('oldusername',TRUE)){
            $sess_data['Username'] = $this->input->post('username',TRUE);
            if($this->input->post('password',TRUE)!=NULL) $sess_data['Password'] = md5($this->input->post('password',TRUE)); $sess_data['Password Clear'] = $this->input->post('password',TRUE);
            $sess_data['Nama'] = $this->input->post('nama',TRUE);
            $sess_data['Email'] = $this->input->post('email',TRUE);
            $sess_data['Telepon'] = $this->input->post('telepon',TRUE);

            $sess_data[session_key()] = 1;
            $this->session->set_userdata($sess_data);
        }

        redirect('Users');
    }
    
    public function change_pass() 
    {        
        $data['password'] = md5($this->input->post('password',TRUE));
        $this->Users_model->update($this->session->userdata("Username"), $data);

        if($this->input->post('password',TRUE)!=NULL) $sess_data['Password'] = md5($this->input->post('password',TRUE)); $sess_data['Password Clear'] = $this->input->post('password',TRUE);
        $this->session->set_userdata($sess_data);

        redirect('Asets');
    }
    
    public function delete($id) 
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect('Users');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('Users');
        }
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:35 */
/* http://harviacode.com */