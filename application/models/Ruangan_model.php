<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruangan_model extends CI_Model
{

    public $table = 'ruangan';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    function count_all(){
        $this->db->select("COUNT(*) AS res");
        return $this->db->get($this->table)->row()->res;
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_view()
    {
        $this->db->select("ruangan.*, (SELECT SUM(unit) FROM asets_ruangan WHERE idruangan=ruangan.id) AS total_barang, (SELECT SUM(harga * unit) FROM asets_ruangan WHERE idruangan=ruangan.id) AS nilai");
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama_ruangan', $q);
	$this->db->or_like('lokasi', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama_ruangan', $q);
	$this->db->or_like('lokasi', $q);
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

    // delete data
    function delete_asets($id)
    {
        $this->db->where("idruangan", $id);
        $this->db->delete("asets_ruangan");
    }

}

/* End of file Ruangan_model.php */
/* Location: ./application/models/Ruangan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-05 10:55:34 */
/* http://harviacode.com */