<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

    public function __construct()
    {
       parent::__construct();
       $this->cekLogin();
       $this->load->library('form_validation');
       $this->load->helper('tgl_indonesia_helper');
       $this->load->model('Model_supplier');
    }


 public function index()
 {
    $data['pageTitle'] = 'supplier';   
    $data['supplier'] = $this->Model_supplier->get_supplier()->result();
    $data['pageContent'] = $this->load->view('data_supplier', $data, TRUE);

    $this->load->view('template/layout', $data);
}


public function insert() 
{
     if ($this->input->post('submit')) {

        $data = array(
            'id_supplier'           => $this->input->post(''),                        
            'nama_supplier'         => $this->input->post('nama_supplier')            
        );


        $this->Model_supplier->insert($data);
        $kode_supplier = $this->db->insert_id();

                        // cek jika query berhasil
        if ($this->db->trans_status() === true)  {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'supplier telah ditambahkan');
        }
        else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'supplier gagal ditambahkan');
        }

                        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);


                        // refresh page
        redirect('supplier', 'refresh');
    }
}

    //FUNCTION UPDATE supplier

public function update($id = null)
{
    if ($this->input->post('submit')) {
        $id = $this->input->post('id');
        $data = array(                                                     
            'nama_supplier'       => $this->input->post('nama_supplier')                
        );

            // Jalankan function update pada model

        $query = $this->Model_supplier->update($id, $data);


            // cek jika query berhasil
        if ($this->db->trans_status() === true)  {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'supplier telah diupdate');
        }
        else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'supplier gagal diupdate');
        }

            // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

            // print_r($data);die;

            // refresh page
        redirect('supplier', 'refresh');
    }    
}


    //FUNCTION DELETE supplier

public function delete($id = null)
{
    $supplier = $this->Model_supplier->get_supplier_byId($id);

    if (!$supplier) show_404();

    $query = $this->Model_supplier->delete($id);


            // cek jika query berhasil
    if ($this->db->trans_status() === true)  {
        $this->db->trans_commit();
        $message = array('status' => true, 'message' => 'supplier telah dihapus');
    }
    else {
        $this->db->trans_rollback();
        $message = array('status' => true, 'message' => 'supplier gagal dihapus');
    }

            // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    redirect('supplier', 'refresh');
}

}