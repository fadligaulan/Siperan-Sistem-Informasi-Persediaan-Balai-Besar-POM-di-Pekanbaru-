<?php
class Model_barang_masuk extends CI_Model {
    public $tablebarang = 'barang_masuk';
    

    public function __construct()
    {
        $this->load->database();

    }

    
    public function get_barang_masuk()
    {
        $this->db->select('*');
        $this->db->from('barang_masuk');
        $this->db->join('barang', 'barang_masuk.kode_barang = barang.kode_barang');
        $this->db->join('kadaluarsa', 'barang_masuk.id_barang_masuk = kadaluarsa.id_barang_masuk');      
        $this->db->order_by('barang_masuk.id_barang_masuk', 'DESC');
        $query = $this->db->get();

        return $query;
    }



    public function get_barang_byId($id)
    {
        $query = $this->db->get_where('barang_masuk', array('id_barang_masuk' => $id))->row();

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
        ->where('id_barang_masuk', $id)
        ->update($this->tablebarang, $data);
        
        // Return hasil query
        return $query;
    }


    public function delete($id)
    {
        // Jalankan query
      $query = $this->db
      ->where('id_barang_masuk', $id)
      ->delete($this->tablebarang);
      
      // Return hasil query
      return $query;
    } 
}
