<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        set_timezone();
    }

    public function index()
    {
        if($this->session->userdata(session_key())==1){
            $this->login_action($this->session->userdata("Username"), $this->session->userdata("Password Clear") != NULL?$this->session->userdata("Password Clear"):$this->session->userdata("Password"));
        }else{
            redirect("login");
        }
    }

    public function login()
    {
        $this->load->view("login");
    }

    public function login_action($ug=NULL, $pg=NULL){
        $u = $ug==NULL?$this->input->post("Username"):$ug;
        $p = $pg==NULL?$this->input->post("Password"):$pg;

        $akun_data = $this->Users_model->get_akun($u, md5($p));

        $ref = "User";
        if($akun_data){
            $ref = "Home";
            $sess_data['Username'] = $akun_data->username;
            $sess_data['Password'] = $akun_data->password;
            $sess_data['Password Clear'] = $p;
            $sess_data['Nama'] = $akun_data->nama;
            $sess_data['Email'] = $akun_data->email;
            $sess_data['Telepon'] = $akun_data->telepon;

			$sess_data[session_key()] = 1;
			$this->session->set_userdata($sess_data);
			redirect($ref);
        }else{
            $this->session->unset_userdata("Username");
            $this->session->unset_userdata("Password");
            $this->session->unset_userdata("Nama");        
            $this->session->unset_userdata("Email");
            $this->session->unset_userdata("Telepon");
            $this->session->unset_userdata(session_key());
            $this->session->set_flashdata('message', 'Username atau password yang anda masukan salah !');
			?>
            <script type="text/javascript">
                window.history.go(-1);
            </script>
            <?php
		}
    }

    public function logout(){
        $this->session->unset_userdata("Username");
        $this->session->unset_userdata("Password");
        $this->session->unset_userdata("Nama");   
        $this->session->unset_userdata("Foto");
        $this->session->unset_userdata("Level");
        $this->session->unset_userdata("Email");
        $this->session->unset_userdata("Telepon");
        $this->session->unset_userdata(session_key());
        session_destroy();
        redirect("");
    }

}