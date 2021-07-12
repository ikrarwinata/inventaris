<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Peminjaman_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $peminjaman = $this->Peminjaman_model->get_all();
        $peminjaman_ruangan = $this->Peminjaman_model->get_all_ruangan();

        $data = array(
            'peminjaman_data' => $peminjaman,
            'peminjaman_ruangan_data' => $peminjaman_ruangan,
            'judul' => "Data Peminjaman Barang",
            'breadcrumb' => array("Data Lainnya", "Data Peminjaman Barang"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "peminjaman/peminjaman_list",
        );
        $this->load->view('container', $data);
    }

    public function read($id) 
    {
        $row = $this->Peminjaman_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idpeminjaman' => $row->idpeminjaman,
		'username' => $row->username,
		'tanggalpinjam' => $row->tanggalpinjam,
		'tanggalkembali' => $row->tanggalkembali,
		'status' => $row->status,
	    );
            $this->load->view('peminjaman/peminjaman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peminjaman'));
        }
    }

    public function create() 
    {
        $this->load->model('Semua_asets_view_model');
        $this->load->model('Ruangan_model');
        $data = array(
            'asets_data' => $this->Semua_asets_view_model->get_all(),
            'ruangan_data' => $this->Ruangan_model->get_all(),
            'action' => site_url('Peminjaman/create_action'),
            'idpeminjaman' => set_value('idpeminjaman'),
            'button' => set_value('Simpan'),
            'kodeasets' => set_value('kodeasets'),
            'username' => set_value('username', $this->session->userdata("Username")),
            'tanggalpinjam' => set_value('tanggalpinjam', date("Y-m-d")),
            'tanggalkembali' => set_value('tanggalkembali'),
            'status' => set_value('status'),
            'judul' => "Tambah Peminjaman Barang",
            'breadcrumb' => array("Data Lainnya", "Data Peminjaman Barang", "Peminjaman Barang"),
            'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "peminjaman/peminjaman_form",
        );
        $this->load->view('container', $data);
    }
    
    public function create_action() 
    {
        $id = $this->db->query("SELECT COUNT(*) AS res FROM peminjaman")->row()->res+1;
        $id = strlen($id)<=1?"0".$id:$id;
        $idp = "PNJ".$id.date("dmyHi");

        $tanggalpinjam = $this->input->post('tanggalpinjam',TRUE)." 00:00:00";
        $tanggalkembali = $this->input->post('tanggalkembali',TRUE)." 00:00:00";

        $kd = $this->input->post('kodebarang_lama',TRUE);

        $data = array(
        'idpeminjaman' => $idp,
        'kodeasets' => $kd,
        'username' => $this->input->post('username',TRUE),
        'tanggalpinjam' => date_timestamp_get(new DateTime($tanggalpinjam)),
        'tanggalkembali' => date_timestamp_get(new DateTime($tanggalkembali)),
        'status' => "Masih Dipinjam",
        );
        $this->db->query("UPDATE asets SET unit=unit-1 WHERE kodebarang='$kd'");
        $this->db->query("UPDATE asets_ruangan SET unit=unit-1 WHERE kodebarang='$kd'");

        $this->Peminjaman_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect('Peminjaman');
    }
    
    public function cancel_item($id) 
    {
        $this->db->query("UPDATE peminjaman SET status='Dibatalkan' WHERE kodeasets='$id'");
        $this->db->query("UPDATE asets SET unit=unit+1 WHERE kodebarang='$id'");
        $this->db->query("UPDATE asets_ruangan SET unit=unit+1 WHERE kodebarang='$id'");

        $this->session->set_flashdata('message', 'Create Record Success');
        redirect('Peminjaman');
    }
    
    public function return_item($id) 
    {
        $this->db->query("UPDATE peminjaman SET status='Sudah Kembali' WHERE kodeasets='$id'");
        $this->db->query("UPDATE asets SET unit=unit+1 WHERE kodebarang='$id'");
        $this->db->query("UPDATE asets_ruangan SET unit=unit+1 WHERE kodebarang='$id'");

        $this->session->set_flashdata('message', 'Create Record Success');
        redirect('Peminjaman');
    }
    
    public function delete($id) 
    {
        $row = $this->Peminjaman_model->get_by_asets($id);

        if ($row) {
            $this->Peminjaman_model->delete_by_asets($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect('Peminjaman');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('Peminjaman');
        }
    }
    
    public function truncate_all() 
    {
        $res = $this->db->query("TRUNCATE peminjaman;");
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan data Peminjaman');
        }
        redirect("Asets/set_truncate");
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('tanggalpinjam', 'tanggalpinjam', 'trim|required');
	$this->form_validation->set_rules('tanggalkembali', 'tanggalkembali', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('idpeminjaman', 'idpeminjaman', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/Peminjaman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-20 16:45:38 */
/* http://harviacode.com */