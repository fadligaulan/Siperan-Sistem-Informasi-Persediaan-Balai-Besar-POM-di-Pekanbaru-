<?php
class Model_supplier extends CI_Model {
    public $tablesupplier = 'supplier';
    

    public function __construct()
    {
        $this->load->database();

    }

    
    public function get_supplier()
    {
        $this->db->select('*');
        $this->db->from('supplier');        
        $this->db->order_by('nama_supplier', 'ASC');
        $query = $this->db->get();

        return $query;
    }



    public function get_supplier_byId($id)
    {
        $query = $this->db->get_where('supplier', array('id_supplier' => $id))->row();

        // Return hasil query
        return $query;

    }



    public function insert($data)
    {
        // Jalankan query
        $query = $this->db->insert($this->tablesupplier, $data);

        // Return hasil query
        return $query;
    }



    public function update($id, $data)
    {
        // Jalankan query
        $query = $this->db
        ->where('id_supplier', $id)
        ->update($this->tablesupplier, $data);
        
        // Return hasil query
        return $query;
    }


    public function delete($id)
    {
        // Jalankan query
      $query = $this->db
      ->where('id_supplier', $id)
      ->delete($this->tablesupplier);
      
      // Return hasil query
      return $query;
    } 
}
