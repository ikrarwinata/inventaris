<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ruangan_model');
    }

    public function get_by_kode(){
        $id = $this->input->post("id");

        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            echo $row->lokasi." </br>";
            echo $row->keterangan." </br>";
        } else {
            echo "-</br>-</br>-</br>-</br>-</br>-</br>-</br>";
        }
    }

    public function truncate_all()
    {
        $res = $this->db->query("TRUNCATE ruangan;");
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan data Ruangan');
        }
        redirect("Asets/set_truncate");
    }

    public function index()
    {
        $ruangan = $this->Ruangan_model->get_view();

        $data = array(
            'ruangan_data' => $ruangan,
            'judul' => "Ruangan",
            'breadcrumb' => array("Data Lainnya", "Data Ruangan"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "ruangan/ruangan_list",
        );
        $this->load->view('container', $data);
    }
    
    public function create_action() 
    {
        $data = array(
            'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
            'lokasi' => $this->input->post('lokasi',TRUE),
            'keterangan' => $this->input->post('keterangan',TRUE),
        );

        $this->Ruangan_model->insert($data);
        $this->session->set_flashdata('message', 'Data ruangan berhasil ditambah');
        redirect('Ruangan');
    }
    
    public function update() 
    {
        $id = $this->input->post("id");
        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            echo $row->id." </br>";
            echo $row->nama_ruangan." </br>";
            echo $row->lokasi." </br>";
            echo $row->keterangan." </br>";
        } else {
            echo "Record Not Found";
        }
    }
    
    public function update_action() 
    {
        $data = array(
            'nama_ruangan' => $this->input->post('nama_ruangan',TRUE),
            'lokasi' => $this->input->post('lokasi',TRUE),
            'keterangan' => $this->input->post('keterangan',TRUE),
        );

        $this->Ruangan_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Data ruangan berhasil diubah');
        redirect('Ruangan');
    }
    
    public function delete($id) 
    {
        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            $this->Ruangan_model->delete($id);
            $this->session->set_flashdata('message', 'Data ruangan telah dihapus');
            redirect('Ruangan');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('Ruangan');
        }
    }
    
    public function delete_asets($id) 
    {
        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            $this->Ruangan_model->delete($id);

            $rows = $this->db->where("idruangan", $id)->get("asets_ruangan")->result();
            foreach ($rows as $value) {
                if($value->foto != NULL){
                    if(file_exists($value->foto)) unlink($value->foto);
                };
            };

            $this->Ruangan_model->delete_asets($id);
            $this->session->set_flashdata('message', 'Ruangan beserta isinya telah dihapus');
            redirect('Ruangan');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('Ruangan');
        }
    }
    
    public function truncate($id) 
    {
        $row = $this->Ruangan_model->get_by_id($id);

        if ($row) {
            $rows = $this->db->where("idruangan", $id)->get("asets_ruangan")->result();
            foreach ($rows as $value) {
                if($value->foto != NULL){
                    if(file_exists($value->foto)) unlink($value->foto);
                };
            };
            $this->Ruangan_model->delete_asets($id);
            $this->session->set_flashdata('message', 'Ruangan telah dikosongkan');
            redirect('Ruangan');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('Ruangan');
        }
    }

    public function laporan(){
        $data = array(
            'total_rows' => $this->Ruangan_model->count_all(),
            'judul' => "Laporan Ruangan",
            'breadcrumb' => array("Laporan", "Ruangan"),
            'konten' => "laporan/ruangan",
        );
        $this->load->view('container', $data);
    }

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/Ruangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:34 */
/* http://harviacode.com */