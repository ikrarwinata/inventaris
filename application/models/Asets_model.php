<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asets_model extends CI_Model
{

    public $table = 'asets';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_new_kode(){
        $this->db->select("MAX(id) AS res");
        $max_asets = $this->db->get("asets")->row()->res;

        $this->db->select("MAX(id) AS res");
        $max_asets_ruangan = $this->db->get("asets_ruangan")->row()->res;
        
        $max = max($max_asets, $max_asets_ruangan);
        if($max==NULL) $max = 0;
        $max++;

        $this->db->select("COUNT(*) AS res");
        $count_asets = $this->db->get("asets")->row()->res;
        
        $this->db->select("COUNT(*) AS res");
        $count_asets_ruangan = $this->db->get("asets_ruangan")->row()->res;

        $count = $count_asets + $count_asets_ruangan;
        if($count==NULL) $count = 0;
        $count++;

        return max($max, $count);
    }

    function get_max()
    {
        $this->db->select("MAX(id) AS res");
        return $this->db->get($this->table)->row()->res;
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_kode($id)
    {
        $this->db->where("kodebarang", $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function get_count() {
        $this->db->select("COUNT(*) AS res");
        return $this->db->get($this->table)->row()->res;
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('kodebarang', $q);
	$this->db->or_like('namabarang', $q);
	$this->db->or_like('merk', $q);
	$this->db->or_like('ukuran', $q);
	$this->db->or_like('idtipe', $q);
	$this->db->or_like('idbahan', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('tahun', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('idkondisi', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('kodebarang', $q);
	$this->db->or_like('namabarang', $q);
	$this->db->or_like('merk', $q);
	$this->db->or_like('ukuran', $q);
	$this->db->or_like('idtipe', $q);
	$this->db->or_like('idbahan', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('tahun', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('idkondisi', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update data
    function update_by_kode($id, $data)
    {
        $this->db->where("kodebarang", $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete data
    function delete_by_kode($id)
    {
        $this->db->where("kodebarang", $id);
        $this->db->delete($this->table);
    }

}

/* End of file Asets_model.php */
/* Location: ./application/models/Asets_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:33 */
/* http://harviacode.com */