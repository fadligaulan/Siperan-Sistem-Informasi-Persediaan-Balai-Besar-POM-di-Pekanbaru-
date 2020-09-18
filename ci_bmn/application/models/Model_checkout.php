<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_checkout extends CI_Model{
	
	function __construct() {
        $this->barangTable = 'barang';
        $this->barangMasuk = 'barang_masuk';
		$this->pegawaiTable = 'pegawai';
		$this->bidangTable = 'bidang';
		$this->custTable = 'customers';
		$this->ordTable = 'orders';
		$this->ordItemsTable = 'order_items';
    }
	
	/*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
	public function getRows($id = ''){
		$this->db->select('*');
		$this->db->from($this->proTable);
		$this->db->where('status', '1');
		if($id){
			$this->db->where('id', $id);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
			$this->db->order_by('name', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			
		}
		
		// Return fetched data
		return !empty($result)?$result:false;
	}
	
	/*
     * Fetch order data from the database
     * @param id returns a single record of the specified ID
     */
	public function getOrder($id){
		$this->db->select('o.*, o.id, b.nama_bidang, p.nama_pegawai, c.date, c.bulan, c.tahun');
		$this->db->from($this->ordTable.' as o');
		$this->db->join($this->custTable.' as c', 'c.id = o.customer_id', 'left');
		$this->db->join($this->bidangTable.' as b', 'b.kode_bidang = c.kode_bidang');
		$this->db->join($this->pegawaiTable.' as p', 'p.id_pegawai = c.id_pegawai');
		$this->db->where('o.id', $id);
		$query = $this->db->get();
		$result = $query->row_array();
		
		// Get order items
		$this->db->select('i.*, b.nama_barang, i.quantity, b.no_gudang');
		$this->db->from($this->ordItemsTable.' as i');
		$this->db->join($this->barangTable.' as b', 'b.kode_barang = i.kode_barang', 'left');
		$this->db->join($this->ordTable.' as o', 'o.id = i.order_id');
		$this->db->join($this->custTable.' as c', 'c.id = o.customer_id');
		$this->db->where('i.order_id', $id);
		$query2 = $this->db->get();
		$result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
		
		// Return fetched data
		return !empty($result)?$result:false;
	}
	
	/*
     * Insert customer data in the database
     * @param data array
     */
	public function insertCustomer($data){
		// Add created and modified date if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        // Insert customer data
        $insert = $this->db->insert($this->custTable, $data);

        // Return the status
		return $insert?$this->db->insert_id():false;
	}
	
	/*
     * Insert order data in the database
     * @param data array
     */
	public function insertOrder($data){
		// Add created and modified date if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        // Insert order data
        $insert = $this->db->insert($this->ordTable, $data);

        // Return the status
		return $insert?$this->db->insert_id():false;
	}
	
	/*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data = array()) {
        
        // Insert order items
        $insert = $this->db->insert_batch($this->ordItemsTable, $data);

        // Return the status
		return $insert?true:false;
    }
	
}