<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_notifikasi extends CI_Model {
	public function pengajuan_barang(){
		$this->db->select('n.*, o.*, o.id, b.kode_bidang, b.nama_bidang, p.nama_pegawai, p.nip, c.no_order, c.date, c.bulan, c.tahun');
		$this->db->from('notif n');
		$this->db->join('customers c','c.id = n.customer_id','left');
		$this->db->join('orders o', 'c.id = o.customer_id', 'left');
		$this->db->join('bidang as b', 'b.kode_bidang = c.kode_bidang');
		$this->db->join('pegawai as p', 'p.id_pegawai = c.id_pegawai');
		$this->db->where(['id_notif'=> $this->input->post('id')]);
		$query = $this->db->get();
		$result = $query->row_array();

		$this->db->select('oi.*, br.nama_barang, br.jenis_barang, bm.satuan, oi.quantity, br.no_gudang, br.no_katalog');
		$this->db->from('order_items oi');
		$this->db->join('barang br', 'br.kode_barang = oi.kode_barang', 'left');
		$this->db->join('barang_masuk as bm', 'br.kode_barang = bm.kode_barang', 'left');
		$this->db->join('orders as o', 'o.id = oi.order_id');
		$this->db->join('customers as c', 'c.id = o.customer_id');
		$this->db->join('notif as n', 'n.customer_id = o.customer_id');
		$this->db->where(['id_notif'=> $this->input->post('id')]);
		$this->db->group_by('kode_barang');
		$query2 = $this->db->get();
		$result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();

        // Return fetched data
		return !empty($result)?$result:false;
	}
	
}