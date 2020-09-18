<?php
class Model_barang_kadaluarsa extends CI_Model
{
    public $tablebarang = 'barang_kadaluarsa';
    public $table_kadaluarsa = 'kadaluarsa';


    public function __construct()
    {
        $this->load->database();
    }


    public function get_barang_kadaluarsa()
    {
        $this->db->select('*');
        $this->db->from('barang_kadaluarsa');
        $this->db->join('barang', 'barang_kadaluarsa.kode_barang = barang.kode_barang');
        $query = $this->db->get();

        return $query;
    }

    public function get_barang_byId($id)
    {
        $query = $this->db->get_where('barang_kadaluarsa', array('id_kadaluarsa' => $id))->row();

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
            ->where('id_kadaluarsa', $id)
            ->update($this->tablebarang, $data);

        // Return hasil query
        return $query;
    }


    public function delete($id)
    {
        // Jalankan query
        $query = $this->db
            ->where('id_kadaluarsa', $id)
            ->delete($this->tablebarang);

        // Return hasil query
        return $query;
    }
}