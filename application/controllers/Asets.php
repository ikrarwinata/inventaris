<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asets extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Asets_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model("Semua_asets_view_model");
        $jumlah_nilai = 0;
        $total_barang = $this->Semua_asets_view_model->total();
        $barang_baik = 0;
        $barang_rusak = 0;
        $p_baik = 0;
        $p_rusak = 0;

        if($total_barang>=1){
            $jumlah_nilai = format_number($this->Semua_asets_view_model->total_nilai(), 0);
            $barang_rusak = $this->Semua_asets_view_model->total_barang_rusak();
            $barang_baik = $this->Semua_asets_view_model->total_barang_baik();
            if ($barang_rusak == NULL) $barang_rusak = 0;
            if ($barang_baik == NULL) $barang_baik = 0;

            $p_rusak = format_coma(($barang_rusak * 100) / $total_barang);

            $p_baik = format_coma(($barang_baik * 100) / $total_barang);
        }else{
            $total_barang = 0;
        }

        $data = array(
            'judul' => "Sistem Informasi Inventaris",
            'breadcrumb' => array("Dashboard"),
            'konten' => "home",
            'total_barang' => $total_barang,
            'jumlah_nilai' => $jumlah_nilai,
            'barang_baik' => $barang_baik,
            'barang_rusak' => $barang_rusak,
            'p_baik' => $p_baik,
            'p_rusak' => $p_rusak,
        );
        $this->load->view('container', $data);
    }

    public function set_truncate(){
        $data = array(
            'judul' => "Mengosongkan Data",
            'breadcrumb' => array("Proses Data", "Kosongkan Data"),
            'konten' => "set_truncate",
        );
        $this->load->view('container', $data);
    }

    public function truncate_all()
    {
        $this->load->model("Semua_asets_view_model");
        $rows = $this->Semua_asets_view_model->get_all();
        foreach ($rows as $value) {
            if($value->foto != NULL){
                if(file_exists($value->foto)) unlink($value->foto);
            };
        };
        $res = $this->db->query("TRUNCATE asets;");
        $res = $this->db->query("TRUNCATE asets_ruangan;");
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan semua Asset');
        }
        redirect("Asets/set_truncate");
    }

    public function truncate_asets()
    {
        $this->load->model("Asets_non_ruangan_view_model");
        $rows = $this->Asets_non_ruangan_view_model->get_all();
        foreach ($rows as $value) {
            if($value->foto != NULL){
                if(file_exists($value->foto)) unlink($value->foto);
            };
        };
        $table = "asets";
        $res = $this->db->query("TRUNCATE ".$table);
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan data Asset Non Ruangan');
        }
        redirect("Asets/set_truncate");
    }

    public function truncate_asets_ruangan()
    {
        $this->load->model("Asets_ruangan_view_model");
        $rows = $this->Asets_ruangan_view_model->get_all();
        foreach ($rows as $value) {
            if($value->foto != NULL){
                if(file_exists($value->foto)) unlink($value->foto);
            };
        };
        $table = "asets_ruangan";
        $res = $this->db->query("TRUNCATE ".$table);
        if($res){
            $this->session->set_flashdata('truncated', 'Berhasil membersihkan data Asset Ruangan');
        }
        redirect("Asets/set_truncate");
    }

    public function get_by_kode(){
        $id = $this->input->post("id");

        $this->load->model('Asets_ruangan_model');
        $this->load->model('Ruangan_model');
        $this->load->model('List_kondisi_model');
        $this->load->model('Tipe_asets_model');
        $row = $this->Asets_model->get_by_kode($id);
        if($row == NULL) $row = $this->Asets_ruangan_model->get_by_kode($id);

        if ($row) {
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
            echo $row->kodebarang." </br>";
            echo $row->namabarang." </br>";
            echo $row->merk." </br>";
            echo $row->ukuran." </br>";
            echo $type." </br>";
            echo $ruangan." </br>";
            echo $kondisi." </br>";
            echo $row->unit." </br>";
        } else {
            echo "-</br>-</br>-</br>-</br>-</br>-</br>-</br>-</br>";
        }
    }

    public function all()
    {
        $this->load->model("Semua_asets_view_model");
        $data = array(
            'asets_data' => $this->Semua_asets_view_model->get_all(),
            'judul' => "Semua Barang",
            'breadcrumb' => array("Inventaris Barang", "Semua Barang"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "semua_asets_view/semua_asets_view_list",
        );
        $this->load->view('container', $data);
    }

    public function non_ruangan()
    {
        $this->load->model("Asets_non_ruangan_view_model");
        $data = array(
            'asets_data' => $this->Asets_non_ruangan_view_model->get_all(),
            'judul' => "Barang Luar Ruangan",
            'breadcrumb' => array("Inventaris Barang", "Barang Luar Ruangan"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "asets_non_ruangan_view/asets_non_ruangan_view_list",
        );
        $this->load->view('container', $data);
    }

    public function ruangan()
    {
        $this->load->model("Asets_ruangan_view_model");
        $this->load->model("Ruangan_model");
        $data = array(
            'asets_data' => $this->Asets_ruangan_view_model->get_all(),
            'ruangan_data' => $this->Ruangan_model->get_all(),
            'judul' => "Barang Dalam Ruangan",
            'breadcrumb' => array("Inventaris Barang", "Barang Dalam Ruangan"),
            'bootstrap' => array("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css", "assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "asets_ruangan_view/asets_ruangan_view_list",
        );
        $this->load->view('container', $data);
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

        $row = $this->Asets_model->get_by_kode($id);
        if($row == NULL) $row = $this->Asets_ruangan_model->get_by_kode($id);

        if ($row) {
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
                'id' => set_value('id', $row->id),
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'idruangan' => set_value('kodebarang', $idruangan),
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
                'ruangan_data' => $this->Ruangan_model->get_all(),
                'tipe_asets_data' => $this->Tipe_asets_model->get_all(),
                'bahan_asets_data' => $this->Bahan_asets_model->get_all(),
                'kondisi_data' => $this->List_kondisi_model->get_all(),
                'foto' => $row->foto,
                'judul' => "Detail Data Barang",
                'breadcrumb' => array("Inventaris Barang", "Detail Data Barang"),
                'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
                'konten' => "asets_ruangan_view/asets_ruangan_read",
                );
            $this->load->view('container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("Asets/all");
        }
    }

    public function create_ruangan($id)
    {
        $this->load->model("Asets_model");
        $this->load->model("Asets_ruangan_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Tipe_asets_model");
        $this->load->model("Bahan_asets_model");
        $this->load->model("List_kondisi_model");
        $m = $this->Asets_model->get_new_kode();
        $m = strlen($m)<=1?"0".$m:$m;
        $m .= ".".date("d")."/".date("m")."/".date("y");
        $ruangan = $this->Ruangan_model->get_by_id($id);
        $data = array(
            'action' => site_url('Asets/create_action'),
            'id' => set_value('id'),
            'kodebarang' => set_value('kodebarang', "ASSETS".$m),
            'idruangan' => isset($ruangan->nama_ruangan)?$id:NULL,
            'ruangan' => isset($ruangan->nama_ruangan)?$ruangan->nama_ruangan:"-",
            'namabarang' => set_value('namabarang'),
            'merk' => set_value('merk'),
            'ukuran' => set_value('ukuran'),
            'idtipe' => NULL,
            'tipe' => "-",
            'idbahan' => set_value('idbahan'),
            'bahan' => set_value('idbahan', "-"),
            'tanggal' => set_value('tanggal'),
            'tahun' => set_value('tahun', date("Y")),
            'harga' => set_value('harga', "0"),
            'idkondisi' => set_value('idkondisi'),
            'kondisi' => set_value('idkondisi', '-'),
            'foto' => set_value('foto'),
            'unit' => set_value('unit', "1"),
            'keterangan' => set_value('keterangan'),
            'ruangan_data' => $this->Ruangan_model->get_all(),
            'tipe_asets_data' => $this->Tipe_asets_model->get_all(),
            'bahan_asets_data' => $this->Bahan_asets_model->get_all(),
            'kondisi_data' => $this->List_kondisi_model->get_all(),
            'judul' => "Tambah Barang",
            'breadcrumb' => array("Inventaris Barang", "Tambah Barang"),
            'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "semua_asets_view/semua_asets_view_form",
        );
        $this->load->view('container', $data);
    }

    public function create() 
    {
        $this->load->model("Asets_model");
        $this->load->model("Asets_ruangan_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Tipe_asets_model");
        $this->load->model("Bahan_asets_model");
        $this->load->model("List_kondisi_model");
        $m = $this->Asets_model->get_new_kode();
        $m = strlen($m)<=1?"0".$m:$m;
        $m .= date("dmy");
        $data = array(
            'action' => site_url('Asets/create_action'),
    	    'id' => set_value('id'),
            'kodebarang' => set_value('kodebarang', "ASSETS".$m),
            'idruangan' => NULL,
    	    'ruangan' => "-",
    	    'namabarang' => set_value('namabarang'),
    	    'merk' => set_value('merk'),
    	    'ukuran' => set_value('ukuran'),
            'idtipe' => NULL,
    	    'tipe' => "-",
            'idbahan' => set_value('idbahan'),
    	    'bahan' => set_value('idbahan', "-"),
    	    'tanggal' => set_value('tanggal'),
    	    'tahun' => set_value('tahun', date("Y")),
    	    'harga' => set_value('harga', "0"),
            'idkondisi' => set_value('idkondisi'),
    	    'kondisi' => set_value('idkondisi', '-'),
            'foto' => set_value('foto'),
            'unit' => set_value('unit', "1"),
    	    'keterangan' => set_value('keterangan'),
            'ruangan_data' => $this->Ruangan_model->get_all(),
            'tipe_asets_data' => $this->Tipe_asets_model->get_all(),
            'bahan_asets_data' => $this->Bahan_asets_model->get_all(),
            'kondisi_data' => $this->List_kondisi_model->get_all(),
            'judul' => "Tambah Barang",
            'breadcrumb' => array("Inventaris Barang", "Tambah Barang"),
            'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
            'script' => TRUE,
            'konten' => "semua_asets_view/semua_asets_view_form",
    	);
        $this->load->view('container', $data);
    }
    
    public function create_action() 
    {
        $ruangan = $this->input->post('idruangan',TRUE);

        $data['kodebarang'] = $this->input->post('kodebarang',TRUE);
        if($ruangan != NULL) $data['idruangan'] = $ruangan;
        $data['namabarang'] = $this->input->post('namabarang',TRUE);
        $data['merk'] = $this->input->post('merk',TRUE);
        $data['ukuran'] = $this->input->post('ukuran',TRUE);
        $data['idtipe'] = $this->input->post('idtipe',TRUE);
        $data['idbahan'] = $this->input->post('idbahan',TRUE);
        $data['tanggal'] = date("d-m-Y");
        $data['tahun'] = $this->input->post('tahun',TRUE);
        $data['harga'] = $this->input->post('harga',TRUE);
        $data['unit'] = $this->input->post('unit',TRUE);
        $data['idkondisi'] = $this->input->post('idkondisi',TRUE);
        $data['keterangan'] = $this->input->post('keterangan',TRUE);
        $data['foto'] = $this->input->post('oldfoto',TRUE);

        $this->load->helper(array('form', 'url'));
        $config['upload_path']          = upload_path("foto");
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']             = 100000;
        $config['max_width']            = 1500;
        $config['max_height']           = 2000;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('foto')){
            if($this->input->post('oldfoto',TRUE) != NULL) unlink($this->input->post('oldfoto',TRUE));
            $udata = $this->upload->data();
            $data["foto"] = upload_path("foto").$data['kodebarang'].date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $data["foto"]);
        };

        $target_ref = "Asets/all";
        if($ruangan != NULL){
            $this->load->model("Asets_ruangan_model");
            $this->Asets_ruangan_model->insert($data);
            $target_ref = "Asets/ruangan";
        }else{
            $this->Asets_model->insert($data);
            $target_ref = "Asets/non_ruangan";
        }
        $this->session->set_flashdata('message', 'Assets berhasil ditambahkan');
        redirect($target_ref);
    }
    
    public function update($id) 
    {
        $this->load->model("Asets_model");
        $this->load->model("Asets_ruangan_model");
        $this->load->model("Ruangan_model");
        $this->load->model("Tipe_asets_model");
        $this->load->model("Bahan_asets_model");
        $this->load->model("List_kondisi_model");
        $this->load->model("Semua_asets_view_model");

        $row = $this->Asets_model->get_by_kode($id);
        if($row == NULL) $row = $this->Asets_ruangan_model->get_by_kode($id);

        if ($row) {
            $tipe = $this->Tipe_asets_model->get_by_id($row->idtipe);

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
                'button' => 'Update',
                'action' => site_url('asets/update_action'),
        		'id' => set_value('id', $row->id),
                'kodebarang' => set_value('kodebarang', $row->kodebarang),
                'idruangan' => set_value('kodebarang', $idruangan),
                'ruangan' => set_value('kodebarang', $ruangan),
        		'namabarang' => set_value('namabarang', $row->namabarang),
        		'merk' => set_value('merk', $row->merk),
        		'ukuran' => set_value('ukuran', $row->ukuran),
                'tipe' => set_value('idtipe', $tipe->tipe),
        		'idtipe' => set_value('idtipe', $row->idtipe),
                'idbahan' => set_value('idbahan', $idbahan),
        		'bahan' => set_value('idbahan', $bahan),
        		'tanggal' => set_value('tanggal', $row->tanggal),
        		'tahun' => set_value('tahun', $row->tahun),
                'harga' => set_value('harga', $row->harga),
        		'unit' => set_value('unit', $row->unit),
                'idkondisi' => set_value('idkondisi', $idkondisi),
        		'kondisi' => set_value('idkondisi', $kondisi),
        		'keterangan' => set_value('keterangan', $row->keterangan),
                'ruangan_data' => $this->Ruangan_model->get_all(),
                'tipe_asets_data' => $this->Tipe_asets_model->get_all(),
                'bahan_asets_data' => $this->Bahan_asets_model->get_all(),
                'kondisi_data' => $this->List_kondisi_model->get_all(),
                'foto' => $row->foto,
                'judul' => "Tambah Barang",
                'breadcrumb' => array("Inventaris Barang", "Ubah Data Barang"),
                'bootstrap' => array("assets/plugins/select2/css/select2.min.css","assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"),
                'script' => TRUE,
                'konten' => "semua_asets_view/semua_asets_view_form",
        	    );
            $this->load->view('container', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("Asets/all");
        }
    }
    
    public function update_action() 
    {
        $ruangan = $this->input->post('idruangan',TRUE);

        if($this->input->post('oldkode',TRUE) != $this->input->post('kodebarang',TRUE)) $data['kodebarang'] = $this->input->post('kodebarang',TRUE);
        if($ruangan != NULL) $data['idruangan'] = $ruangan;
        $data['namabarang'] = $this->input->post('namabarang',TRUE);
        $data['merk'] = $this->input->post('merk',TRUE);
        $data['ukuran'] = $this->input->post('ukuran',TRUE);
        $data['idtipe'] = $this->input->post('idtipe',TRUE);
        $data['idbahan'] = $this->input->post('idbahan',TRUE);
        $data['tanggal'] = date("d-m-Y");
        $data['tahun'] = $this->input->post('tahun',TRUE);
        $data['harga'] = $this->input->post('harga',TRUE);
        $data['unit'] = $this->input->post('unit',TRUE);
        $data['idkondisi'] = $this->input->post('idkondisi',TRUE);
        $data['keterangan'] = $this->input->post('keterangan',TRUE);
        $data['foto'] = $this->input->post('oldfoto',TRUE);

        $this->load->helper(array('form', 'url'));
        $config['upload_path']          = upload_path("foto");
        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
        $config['max_size']             = 100000;
        $config['max_width']            = 1500;
        $config['max_height']           = 2000;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('foto')){
            if($this->input->post('oldfoto',TRUE) != NULL) unlink($this->input->post('oldfoto',TRUE));
            $udata = $this->upload->data();
            $data["foto"] = upload_path("foto").$data['kodebarang'].date("dmYHis").$udata["file_ext"];
            rename($udata["full_path"], $data["foto"]);
        };

        $this->load->model("Asets_ruangan_model");
        $target_ref = "Asets/all";
        if($ruangan != NULL){
            $this->Asets_model->delete_by_kode($this->input->post('kodebarang',TRUE));
            $this->Asets_ruangan_model->update($this->input->post('id',TRUE), $data);
            $target_ref = "Asets/ruangan";
        }else{
            $this->Asets_ruangan_model->delete_by_kode($this->input->post('kodebarang',TRUE));
            $this->Asets_model->update($this->input->post('id',TRUE), $data);
            $target_ref = "Asets/non_ruangan";
        }
        $this->session->set_flashdata('message', 'Assets berhasil di ubah');
        redirect($target_ref);
    }
    
    public function delete($id) 
    {
        $this->load->model("Semua_asets_view_model");
        $this->load->model("Asets_ruangan_model");
        $row = $this->Semua_asets_view_model->get_by_id($id);

        if ($row) {
            if($row->foto != NULL){
                if(file_exists($row->foto)) unlink($row->foto);
            };
            $this->Asets_model->delete_by_kode($id);
            $this->Asets_ruangan_model->delete_by_kode($id);
            $this->session->set_flashdata('message', 'Assets berhasil dihapus');
            redirect("Asets/all");
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect("Asets/all");
        }
    }

    public function laporan_all(){
        $this->load->model("Semua_asets_view_model");
        $data = array(
            'total_rows' => $this->Semua_asets_view_model->count_all(),
            'judul' => "Laporan Semua Data Barang",
            'breadcrumb' => array("Laporan", "Assets", "Semua Assets"),
            'konten' => "laporan/asets_all",
        );
        $this->load->view('container', $data);
    }

    public function laporan_non_ruangan(){
        $this->load->model("Asets_non_ruangan_view_model");
        $data = array(
            'total_rows' => $this->Asets_non_ruangan_view_model->count_all(),
            'judul' => "Laporan Data Barang (Luar Ruangan)",
            'breadcrumb' => array("Laporan", "Assets", "Assets Non Ruangan"),
            'konten' => "laporan/asets_non_ruangan",
        );
        $this->load->view('container', $data);
    }

    public function laporan_ruangan()
    {
        $this->load->model('Ruangan_model');
        $ruangan = $this->Ruangan_model->get_view();
        $data = array(
            'ruangan_data' => $ruangan,
            'judul' => "Laporan Data Barang (@ Ruangan)",
            'breadcrumb' => array("Laporan", "Assets", "Assets Dalam Ruangan"),
            'konten' => "laporan/asets_ruangan",
        );
        $this->load->view('container', $data);
    }

}

/* End of file Asets.php */
/* Location: ./application/controllers/Asets.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:33 */
/* http://harviacode.com */