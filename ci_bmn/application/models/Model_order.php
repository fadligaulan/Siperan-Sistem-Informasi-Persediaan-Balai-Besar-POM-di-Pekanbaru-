<?php
class Model_order extends CI_Model {
    public $tablebarang = 'order';
    

    public function __construct()
    {
        $this->load->database();
        $this->barang = 'barang';

    }

    
    public function get_order()
    {
        $this->db->select('*, MIN(tgl_kadaluarsa) as kadaluarsa');
        $this->db->from('barang');
        $this->db->join('stock', 'stock.kode_barang = barang.kode_barang');
        $this->db->join('barang_masuk', 'stock.kode_barang = barang_masuk.kode_barang');
        $this->db->join('kadaluarsa', 'kadaluarsa.id_barang_masuk = barang_masuk.id_barang_masuk');
        $this->db->group_by('barang.kode_barang');   
        $query = $this->db->get();

        return $query;
    }

    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('kode_barang', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return !empty($result)?$result:false;
    }
    
    function fetch_data($query)
    {
        $this->db->select("*, MAX(tgl_kadaluarsa) as tgl_kadaluarsa");
        $this->db->from("barang");
        $this->db->join('stock', 'stock.kode_barang = barang.kode_barang');
        $this->db->join('barang_masuk', 'stock.kode_barang = barang_masuk.kode_barang');
        $this->db->join('kadaluarsa', 'kadaluarsa.id_barang_masuk = barang_masuk.id_barang_masuk');
        $this->db->group_by('barang.kode_barang');
        if($query != '')
        {
            $this->db->like('nama_barang', $query);
            $this->db->or_like('no_katalog', $query);
            $this->db->or_like('jenis_barang', $query);
            $this->db->or_like('no_gudang', $query);
        }
        $this->db->order_by('barang.kode_barang', 'ASC');
        return $this->db->get();
    }
}
