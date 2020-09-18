<?php
class Model_stock_barang extends CI_Model {
    public $tablebarang = 'stock_barang';
    

    public function __construct()
    {
        $this->load->database();

    }

    
    public function get_stock_barang()
    {
        $this->db->select('*, MAX(tgl_kadaluarsa) as tgl_kadaluarsa');
        $this->db->from('stock');
        $this->db->join('barang_masuk', 'stock.kode_barang = barang_masuk.kode_barang');
        $this->db->join('barang', 'stock.kode_barang = barang.kode_barang');
        $this->db->join('kadaluarsa', 'kadaluarsa.id_barang_masuk = barang_masuk.id_barang_masuk');
        $this->db->group_by('stock.kode_barang');
        $query = $this->db->get();

        return $query;
    }



    public function get_barang_byId($id)
    {
        $query = $this->db->select('*')
            ->join('barang', 'barang.kode_barang = stock_barang.kode_barang')
            ->get_where('stock_barang', array('id_stock_barang' => $id))->row();

        // Return hasil query
        return $query;

    }



    public function insert($data)
    {
        // Jalankan query
        $query = $this->db->insert($this->tablebarang, $data);

        // Return hasil query
        return $query;
    }



    public function update($id, $data)
    {
        // Jalankan query
        $query = $this->db
        ->where('id_stock_barang', $id)
        ->update($this->tablebarang, $data);
        
        // Return hasil query
        return $query;
    }


    public function delete($id)
    {
        // Jalankan query
      $query = $this->db
      ->where('id_stock_barang', $id)
      ->delete($this->tablebarang);
      
      // Return hasil query
      return $query;
    } 
}
