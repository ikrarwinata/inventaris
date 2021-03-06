<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semua_asets_view_model extends CI_Model
{

    public $table = 'semua_asets_view';
    public $id = 'kodebarang';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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
    function total_rows($q = NULL) {
        $this->db->like('', $q);
    $this->db->or_like('kodebarang', $q);
    $this->db->or_like('namabarang', $q);
    $this->db->or_like('merk', $q);
    $this->db->or_like('ukuran', $q);
    $this->db->or_like('tipe', $q);
    $this->db->or_like('bahan', $q);
    $this->db->or_like('tanggal', $q);
    $this->db->or_like('tahun', $q);
    $this->db->or_like('harga', $q);
    $this->db->or_like('kondisi', $q);
    $this->db->or_like('keterangan', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    // get total rows
    function total() {
        $this->db->select("SUM(unit) AS res");
        return $this->db->get($this->table)->row()->res;
    }
    
    // get total rows
    function count_all() {
        $this->db->select("COUNT(*) AS res");
        return $this->db->get($this->table)->row()->res;
    }
    
    // get total rows
    function total_rows_by($field, $val) {
        $this->db->where($field, $val);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get total rows
    function total_nilai() {
        $this->db->select("SUM(harga * unit) AS res");
        return $this->db->get($this->table)->row()->res;
    }
    // get total rows
    function total_barang_baik() {
        $this->db->select("SUM(unit) AS res");
        $this->db->like("kondisi", "BAIK");
        return $this->db->get($this->table)->row()->res;
    }
    // get total rows
    function total_barang_rusak() {
        $this->db->select("SUM(unit) AS res");
        $this->db->like("kondisi", "RUSAK");
        return $this->db->get($this->table)->row()->res;
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $q);
	$this->db->or_like('kodebarang', $q);
	$this->db->or_like('namabarang', $q);
	$this->db->or_like('merk', $q);
	$this->db->or_like('ukuran', $q);
	$this->db->or_like('tipe', $q);
	$this->db->or_like('bahan', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('tahun', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('kondisi', $q);
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Semua_asets_view_model.php */
/* Location: ./application/models/Semua_asets_view_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:35 */
/* http://harviacode.com */