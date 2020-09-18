<?php
class Model_daftar_order extends CI_Model {
    public $ordItemsTable = 'order_items';
    public $ordTable = 'orders';
    public $custTable = 'customers';
    public $bidangTable = 'bidang';
    public $barangTable = 'barang';
    public $pegawaiTable = 'pegawai';
    

    public function __construct()
    {
        $this->barangTable = 'barang';
        $this->barangMasuk = 'barang_masuk';
        $this->pegawaiTable = 'pegawai';
        $this->bidangTable = 'bidang';
        $this->custTable = 'customers';
        $this->ordTable = 'orders';
        $this->ordItemsTable = 'order_items';
        $this->load->database();

    }

    
    public function getOrder($id){
        $this->db->select('o.*, o.id, b.kode_bidang, b.nama_bidang, p.nama_pegawai, p.nip, p.ttd_user, p.ttd_atasan1, p.ttd_atasan2, c.no_order, c.date, c.bulan, c.tahun');
        $this->db->from($this->ordTable.' as o');
        $this->db->join($this->custTable.' as c', 'c.id = o.customer_id', 'left');
        $this->db->join($this->bidangTable.' as b', 'b.kode_bidang = c.kode_bidang');
        $this->db->join($this->pegawaiTable.' as p', 'p.id_pegawai = c.id_pegawai');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        
        // Get order items
        $this->db->select('i.*, b.nama_barang, b.jenis_barang, m.satuan, i.quantity, b.no_gudang');
        $this->db->from($this->ordItemsTable.' as i');
        $this->db->join($this->barangTable.' as b', 'b.kode_barang = i.kode_barang', 'left');
        $this->db->join($this->barangMasuk.' as m', 'b.kode_barang = m.kode_barang', 'left');
        $this->db->join($this->ordTable.' as o', 'o.id = i.order_id');
        $this->db->join($this->custTable.' as c', 'c.id = o.customer_id');
        $this->db->where('i.order_id', $id);
        $this->db->group_by('kode_barang');
        $this->db->order_by('nama_barang', 'ASC');
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
        
        // Return fetched data
        return !empty($result)?$result:false;
    }

    public function getDaftarOrder(){
        
        $id_pegawai = $this->session->userdata('id_pegawai');
        $this->db->select('*, SUM(quantity) as quantity');
        $this->db->from('order_items');
        $this->db->join('orders', 'orders.id = order_items.order_id');
        $this->db->join('barang', 'barang.kode_barang = order_items.kode_barang');
        $this->db->join('customers', 'customers.id = orders.customer_id');
        $this->db->join('bidang', 'bidang.kode_bidang = customers.kode_bidang');
        $this->db->join('pegawai', 'pegawai.id_pegawai = customers.id_pegawai');
        $this->db->where('customers.id_pegawai', $id_pegawai);
        $this->db->group_by('order_items.order_id');
        $this->db->order_by('customers.id', 'DESC');
        $query = $this->db->get();

        return $query;
    }
    
    public function getDaftarOrderAdmin(){

        $this->db->select('*, SUM(quantity) as quantity');
        $this->db->from('order_items');
        $this->db->join('orders', 'orders.id = order_items.order_id');
        $this->db->join('barang', 'barang.kode_barang = order_items.kode_barang');
        $this->db->join('customers', 'customers.id = orders.customer_id');
        $this->db->join('bidang', 'bidang.kode_bidang = customers.kode_bidang');
        $this->db->join('pegawai', 'pegawai.id_pegawai = customers.id_pegawai');
        $this->db->group_by('order_items.order_id');
        $this->db->order_by('customers.id', 'DESC');
        $query = $this->db->get();

        return $query;
    }
    public function getDaftarOrderById($id){
        $query = $this->db->get_where('customers', array('id' => $id))->row();

        return $query;
    }

    public function delete($id){
        $query = $this->db
        ->where('id', $id)
        ->delete('customers');
    }
}
