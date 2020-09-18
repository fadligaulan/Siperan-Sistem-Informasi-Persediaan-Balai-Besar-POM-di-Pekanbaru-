<?php
class Model_barang extends CI_Model {
    public $tablebarang = 'barang';
    

    public function __construct()
    {
        $this->load->database();

    }
    
    
    public function get_barang()
    {
        $this->db->select('*');
        $this->db->from('barang');        
        $this->db->order_by('kode_barang', 'ASC');
        $query = $this->db->get();

        return $query;
    }



    public function get_barang_byId($id)
    {
        $query = $this->db->get_where('barang', array('kode_barang' => $id))->row();

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
        ->where('kode_barang', $id)
        ->update($this->tablebarang, $data);
        
        // Return hasil query
        return $query;
    }


    public function delete($id)
    {
        // Jalankan query
      $query = $this->db
      ->where('kode_barang', $id)
      ->delete($this->tablebarang);
      
      // Return hasil query
      return $query;
    } 
}
