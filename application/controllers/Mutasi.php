<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mutasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mutasi_model');
        $this->load->library('form_validation');
    }

    public function truncate_all()
    {
        $res = $this->db->query("TRUNCATE mutasi;");
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan data Mutasi');
        }
        redirect("Asets/set_truncate");
    }

    public function index()
    {
        $mutasi_view = $this->Mutasi_model->get_view();

        $data = array(
            'mutasi_view_data' => $mutasi_view,
            'judul' => "Data Mutasi Barang",
            'breadcrumb' => array("Data Lainnya", "Data Mutasi Barang"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "mutasi/mutasi_list",
        );
        $this->load->view('container', $data);
    }

    public function extern_read($id){
        $this->load->model("Asets_model");
        $this->load->model("Asets_ruangan_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Tipe_asets_model");
        $this->load->model("Bahan_asets_model");
        $this->load->model("List_kondisi_model");
        $this->load->model("Semua_asets_view_model");

        $mutasi = $this->Mutasi_model->get_by_id($id);
        

        if ($mutasi) {
            $id = $mutasi->kodebarang_baru;

            $row = $this->Asets_model->get_by_kode($id);
            if($row == NULL) $row = $this->Asets_ruangan_model->get_by_kode($id);
            $tipe = $this->Tipe_asets_model->get_by_id($row->idtipe);
            $type = isset($tipe->tipe)?$tipe->tipe:NULL;

            $ruangan = "-";
            $idruangan = NULL;
            if(isset($row->idruangan)){
                if($row->idruangan != NULL){
                    $ruangan = $this->Ruangan_model->get_by_id($row->idruangan);
                    if($ruangan) {
                        $ruangan = $ruangan->nama_ruangan;
                        $idruangan = $row->idruangan;
                    }else{
                        $ruangan = "-";
                        $idruangan = NULL;
                    }
                } 
            }
            $ruangan_lama = "-";
            $idruangan_lama = NULL;
            if(isset($mutasi->idruangan_lama)){
                if($mutasi->idruangan_lama != NULL){
                    $ruangan_lama = $this->Ruangan_model->get_by_id($mutasi->idruangan_lama);
                    if($ruangan_lama) {
                        $ruangan_lama = $ruangan_lama->nama_ruangan;
                        $idruangan_lama = $mutasi->idruangan_lama;
                    }else{
                        $ruangan_lama = "-";
                        $idruangan_lama = NULL;
                    }
                } 
            }
            $bahan = "-";
            $idbahan = NULL;
            if($row->idbahan != NULL){
                $bahan = $this->Bahan_asets_model->get_by_id($row->idbahan);
                if($bahan){
                    $bahan = $bahan->bahan;
                    $idbahan = $row->idbahan;
                }else{
                    $bahan = "-";
                    $idbahan = NULL;
                }
            }
            $kondisi = "-";
            $idkondisi = NULL;
            if($row->idkondisi != NULL){
                $kondisi = $this->List_kondisi_model->get_by_id($row->idkondisi);
                if($kondisi){
                    $kondisi = $kondisi->kondisi;
                    $idkondisi = $row->idkondisi;
                }else{
                    $kondisi = "-";
                    $idkondisi = NULL;
                }
            }
            $data = array(
                'kodebarang_lama' => $mutasi->kodebarang_lama,
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'idruangan' => set_value('kodebarang', $idruangan),
                'ruangan_lama' => set_value('kodebarang', $ruangan_lama),
                'ruangan' => set_value('kodebarang', $ruangan),
                'namabarang' => set_value('namabarang', $row->namabarang),
                'merk' => set_value('merk', $row->merk),
                'ukuran' => set_value('ukuran', $row->ukuran),
                'tipe' => set_value('idtipe', $type),
                'idtipe' => set_value('idtipe', $row->idtipe),
                'idbahan' => set_value('idbahan', $idbahan),
                'bahan' => set_value('idbahan', $bahan),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'tahun' => set_value('tahun', $row->tahun),
                'harga' => set_value('harga', $row->harga),
                'idkondisi' => $idkondisi,
                'kondisi' => $kondisi,
                'unit' => set_value('unit', $row->unit),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'keterangan_mutasi' => set_value('keterangan', $mutasi->keterangan),
                'ruangan_data' => $this->Ruangan_model->get_all(),
                'tipe_asets_data' => $this->Tipe_asets_model->get_all(),
                'bahan_asets_data' => $this->Bahan_asets_model->get_all(),
                'kondisi_data' => $this->List_kondisi_model->get_all(),
                'foto' => $row->foto,
                'judul' => "Detail Mutasi Barang",
                'breadcrumb' => array("Inventaris Barang", "Detail Mutasi Barang"),
                'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
                'konten' => "public/mutasi_read",
                );
            $this->load->view('public/container', $data);
        } else {
            $data = array(
                'judul' => "Detail Mutasi Barang",
                'breadcrumb' => array("Publci", "Detail Mutasi Barang"),
                'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
                );
            $this->load->view('public/container', $data);
        }
    }

    public function read($id) 
    {
        $this->load->model("Asets_model");
        $this->load->model("Asets_ruangan_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Tipe_asets_model");
        $this->load->model("Bahan_asets_model");
        $this->load->model("List_kondisi_model");
        $this->load->model("Semua_asets_view_model");

        $mutasi = $this->Mutasi_model->get_by_id($id);

        if ($mutasi) {
            $id = $mutasi->kodebarang_baru;

            $row = $this->Asets_model->get_by_kode($id);
            if($row == NULL) $row = $this->Asets_ruangan_model->get_by_kode($id);
            $tipe = $this->Tipe_asets_model->get_by_id($row->idtipe);
            $type = isset($tipe->tipe)?$tipe->tipe:NULL;

            $ruangan = "-";
            $idruangan = NULL;
            if(isset($row->idruangan)){
                if($row->idruangan != NULL){
                    $ruangan = $this->Ruangan_model->get_by_id($row->idruangan);
                    if($ruangan) {
                        $ruangan = $ruangan->nama_ruangan;
                        $idruangan = $row->idruangan;
                    }else{
                        $ruangan = "-";
                        $idruangan = NULL;
                    }
                } 
            }
            $ruangan_lama = "-";
            $idruangan_lama = NULL;
            if(isset($mutasi->idruangan_lama)){
                if($mutasi->idruangan_lama != NULL){
                    $ruangan_lama = $this->Ruangan_model->get_by_id($mutasi->idruangan_lama);
                    if($ruangan_lama) {
                        $ruangan_lama = $ruangan_lama->nama_ruangan;
                        $idruangan_lama = $mutasi->idruangan_lama;
                    }else{
                        $ruangan_lama = "-";
                        $idruangan_lama = NULL;
                    }
                } 
            }
            $bahan = "-";
            $idbahan = NULL;
            if($row->idbahan != NULL){
                $bahan = $this->Bahan_asets_model->get_by_id($row->idbahan);
                if($bahan){
                    $bahan = $bahan->bahan;
                    $idbahan = $row->idbahan;
                }else{
                    $bahan = "-";
                    $idbahan = NULL;
                }
            }
            $kondisi = "-";
            $idkondisi = NULL;
            if($row->idkondisi != NULL){
                $kondisi = $this->List_kondisi_model->get_by_id($row->idkondisi);
                if($kondisi){
                    $kondisi = $kondisi->kondisi;
                    $idkondisi = $row->idkondisi;
                }else{
                    $kondisi = "-";
                    $idkondisi = NULL;
                }
            }
            $data = array(
                'kodebarang_lama' => $mutasi->kodebarang_lama,
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'idruangan' => set_value('kodebarang', $idruangan),
                'ruangan_lama' => set_value('kodebarang', $ruangan_lama),
                'ruangan' => set_value('kodebarang', $ruangan),
                'namabarang' => set_value('namabarang', $row->namabarang),
                'merk' => set_value('merk', $row->merk),
                'ukuran' => set_value('ukuran', $row->ukuran),
                'tipe' => set_value('idtipe', $type),
                'idtipe' => set_value('idtipe', $row->idtipe),
                'idbahan' => set_value('idbahan', $idbahan),
                'bahan' => set_value('idbahan', $bahan),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'tahun' => set_value('tahun', $row->tahun),
                'harga' => set_value('harga', $row->harga),
                'idkondisi' => $idkondisi,
                'kondisi' => $kondisi,
                'unit' => set_value('unit', $row->unit),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'keterangan_mutasi' => set_value('keterangan', $mutasi->keterangan),
                'ruangan_data' => $this->Ruangan_model->get_all(),
                'tipe_asets_data' => $this->Tipe_asets_model->get_all(),
                'bahan_asets_data' => $this->Bahan_asets_model->get_all(),
                'kondisi_data' => $this->List_kondisi_model->get_all(),
                'foto' => $row->foto,
                'judul' => "Detail Mutasi Barang",
                'breadcrumb' => array("Inventaris Barang", "Detail Mutasi Barang"),
                'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
                'konten' => "mutasi/mutasi_read",
                );
            $this->load->view('container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('Mutasi');
        }
    }

    public function create() 
    {
        $this->load->model('Semua_asets_view_model');
        $this->load->model('Ruangan_model');
        $data = array(
            'asets_data' => $this->Semua_asets_view_model->get_all(),
            'ruangan_data' => $this->Ruangan_model->get_all(),
            'action' => site_url('Mutasi/create_action'),
    	    'id' => set_value('id'),
            'kodebarang_lama' => set_value('kodebarang_lama'),
    	    'barang_lama' => set_value('barang_lama', "-"),
    	    'kodebarang_baru' => set_value('kodebarang_baru'),
            'idruangan_baru' => set_value('idruangan_baru'),
    	    'ruangan_baru' => set_value('ruangan_baru', "-"),
    	    'unit_baru' => set_value('unit_baru'),
    	    'keterangan' => set_value('keterangan_baru'),
            'judul' => "Tambah Mutasi Barang",
            'breadcrumb' => array("Data Lainnya", "Data Mutasi Barang", "Mutasi Barang"),
            'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "mutasi/mutasi_form",
    	);
        $this->load->view('container', $data);
    }

    public function asets($id){
        $this->load->model('Semua_asets_view_model');
        $this->load->model('Ruangan_model');
        $data = array(
            'asets_data' => $this->Semua_asets_view_model->get_all(),
            'ruangan_data' => $this->Ruangan_model->get_all(),
            'action' => site_url('Mutasi/create_action'),
            'id' => set_value('id'),
            'kodebarang_lama' => set_value('kodebarang_lama', $id),
            'barang_lama' => set_value('barang_lama', $this->Semua_asets_view_model->get_by_kode($id)->namabarang),
            'kodebarang_baru' => set_value('kodebarang_baru'),
            'idruangan_baru' => set_value('idruangan_baru'),
            'ruangan_baru' => set_value('ruangan_baru', "-"),
            'unit_baru' => set_value('unit_baru'),
            'keterangan' => set_value('keterangan_baru'),
            'judul' => "Tambah Mutasi Barang",
            'breadcrumb' => array("Data Lainnya", "Data Mutasi Barang", "Mutasi Barang"),
            'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "mutasi/mutasi_form",
        );
        $this->load->view('container', $data);
    }
    
    public function create_action() 
    {
        $this->load->model("Asets_model");
        $this->load->model("Asets_ruangan_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Tipe_asets_model");
        $this->load->model("Bahan_asets_model");
        $this->load->model("List_kondisi_model");
        $this->load->model("Semua_asets_view_model");

        $id = $this->input->post('kodebarang_lama',TRUE);
        $barang = $this->Asets_model->get_by_kode($id);
        if($barang == NULL) $barang = $this->Asets_ruangan_model->get_by_kode($id);

        if($barang){
            $kode_baru = $this->Asets_model->get_new_kode();
            $kode_baru++;
            $kodebarang_baru = "ASSETS0" . $kode_baru;

            $ruangan = "-";
            $idruangan = NULL;
            if(isset($barang->idruangan)){
                if($barang->idruangan != NULL){
                    $ruangan = $this->Ruangan_model->get_by_id($barang->idruangan);
                    if($ruangan) {
                        $ruangan = $ruangan->nama_ruangan;
                        $idruangan = $barang->idruangan;
                    }else{
                        $ruangan = "-";
                        $idruangan = NULL;
                    }
                } 
            }
            $bahan = "-";
            $idbahan = NULL;
            if($barang->idbahan != NULL){
                $bahan = $this->Bahan_asets_model->get_by_id($barang->idbahan);
                if($bahan){
                    $bahan = $bahan->bahan;
                    $idbahan = $barang->idbahan;
                }else{
                    $bahan = "-";
                    $idbahan = NULL;
                }
            }
            $kondisi = "-";
            $idkondisi = NULL;
            if($barang->idkondisi != NULL){
                $kondisi = $this->List_kondisi_model->get_by_id($barang->idkondisi);
                if($kondisi){
                    $kondisi = $kondisi->kondisi;
                    $idkondisi = $barang->idkondisi;
                }else{
                    $kondisi = "-";
                    $idkondisi = NULL;
                }
            }

            $this->Asets_model->delete_by_kode($id);
            $this->Asets_ruangan_model->delete_by_kode($id);

            $data = array(
                'kodebarang_lama' => $barang->kodebarang,
                'kodebarang_baru' => $kodebarang_baru,
                'idruangan_lama' => $idruangan,
                'idruangan_baru' => $this->input->post('idruangan_baru',TRUE),
                'tanggal' => date("d-m-Y"),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'user_posting' => $this->session->userdata("Username"),
            );

            $this->Mutasi_model->insert($data);

            $databarangbaru['kodebarang'] = $kodebarang_baru;
            if($this->input->post('idruangan_baru',TRUE) != NULL) $databarangbaru['idruangan'] = $this->input->post('idruangan_baru',TRUE);
            $databarangbaru['namabarang'] = $barang->namabarang;
            $databarangbaru['merk'] = $barang->merk;
            $databarangbaru['ukuran'] = $barang->ukuran;
            $databarangbaru['idtipe'] = $barang->idtipe;
            $databarangbaru['idbahan'] = $idbahan;
            $databarangbaru['tanggal'] = $barang->tanggal;
            $databarangbaru['tahun'] = $barang->tahun;
            $databarangbaru['harga'] = $barang->harga;
            $databarangbaru['unit'] = $barang->unit;
            $databarangbaru['idkondisi'] = $idkondisi;
            $databarangbaru['keterangan'] = $barang->keterangan;
            $databarangbaru['foto'] = $barang->foto;

            $this->Asets_ruangan_model->insert($databarangbaru);

            $this->session->set_flashdata('message', 'Mutasi ditambahkan');
            redirect('Mutasi');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("Mutasi");
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mutasi_model->get_by_id($id);

        if ($row) {
            $this->Mutasi_model->delete($id);
            $this->session->set_flashdata('message', 'Data Mutasi berhasil dihapus');
            redirect(site_url('mutasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mutasi'));
        }
    }

    public function laporan(){
        $data = array(
            'total_rows' => $this->Mutasi_model->count_all(),
            'judul' => "Laporan Mutasi",
            'breadcrumb' => array("Laporan", "Mutasi"),
            'konten' => "laporan/mutasi",
        );
        $this->load->view('container', $data);
    }

}

/* End of file Mutasi.php */
/* Location: ./application/controllers/Mutasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:34 */
/* http://harviacode.com */