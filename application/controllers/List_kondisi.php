<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class List_kondisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('List_kondisi_model');
    }

    public function truncate_all()
    {
        $res = $this->db->query("TRUNCATE list_kondisi;");
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan data Kondisi Aset');
        }
        redirect("Asets/set_truncate");
    }

    public function index()
    {
        $list_kondisi = $this->List_kondisi_model->get_all();

        $data = array(
            'kondisi_data' => $list_kondisi,
            'judul' => "Kondisi Asets",
            'breadcrumb' => array("Data Lainnya", "Kondisi Asets"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "list_kondisi/list_kondisi_list",
        );
        $this->load->view('container', $data);
    }
    
    public function create_action() 
    {
        $data = array(
        'kondisi' => strtoupper($this->input->post('kondisi',TRUE)),
        'keterangan' => $this->input->post('keterangan',TRUE),
        );

        $this->List_kondisi_model->insert($data);
        $this->session->set_flashdata('message', 'Data Kondisi berhasil ditambahkan');
        redirect('List_kondisi');
    }
    
    public function update_action() 
    {
        $data = array(
        'kondisi' => strtoupper($this->input->post('kondisi',TRUE)),
        'keterangan' => $this->input->post('keterangan',TRUE),
        );

        $this->List_kondisi_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Data Kondisi berhasil diubah');
        redirect('List_kondisi');
    }
    
    public function delete($id) 
    {
        $row = $this->List_kondisi_model->get_by_id($id);

        if ($row) {
            $this->List_kondisi_model->delete($id);
            $this->session->set_flashdata('message', 'Data Kondisi berhasil dihapus');
            redirect(site_url('list_kondisi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('list_kondisi'));
        }
    }

}

/* End of file List_kondisi.php */
/* Location: ./application/controllers/List_kondisi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:34 */
/* http://harviacode.com */