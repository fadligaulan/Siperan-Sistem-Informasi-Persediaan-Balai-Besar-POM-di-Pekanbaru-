<?php
class Model_laporan extends CI_Model {

    public function __construct()
    {
        $this->load->database();

    }

    
    public function get_laporan()
    {
        $this->db->select('*');
        $this->db->from('stock_barang');
        $this->db->join('barang', 'barang.kode_barang = stock_barang.kode_barang');
        $this->db->order_by('id_stock_barang', 'DESC');
        $query = $this->db->get();

        return $query;
    }
    
    // public function laporan_periode($tanggal1, $tanggal2, $nama_barang)
    // {
    //     $this->db->select('*');
    //     $this->db->from('stock_barang');
    //     $this->db->join('barang', 'barang.kode_barang = stock_barang.kode_barang');
    //     $this->db->where('tanggal >=', $tanggal1);
    //     $this->db->where('tanggal <=', $tanggal2);
    //     $this->db->where('nama_barang', $nama_barang);
    //     return $query = $this->db->get()->row_array();
    // }

    public function laporan_periode($tanggal1, $tanggal2, $nama_barang){
        $this->db->select('*');
        $this->db->from('stock_barang');
        $this->db->join('barang', 'barang.kode_barang = stock_barang.kode_barang');
        $this->db->join('barang_masuk', 'barang.kode_barang = barang_masuk.kode_barang');
        $this->db->where('tanggal >=', $tanggal1);
        $this->db->where('tanggal <=', $tanggal2);
        $this->db->where('nama_barang', $nama_barang);
        $query = $this->db->get();
        $result = $query->row_array();
        
        // Get order items
        $this->db->select('*');
        $this->db->from('stock_barang');
        $this->db->join('barang', 'barang.kode_barang = stock_barang.kode_barang');
        $this->db->where('tanggal >=', $tanggal1);
        $this->db->where('tanggal <=', $tanggal2);
        $this->db->where('nama_barang', $nama_barang);
        $this->db->order_by('id_stock_barang', 'ASC');
        $query2 = $this->db->get();
        $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
         
        // Return fetched data
        return !empty($result)?$result:false;
        // return $result;
    }

}
