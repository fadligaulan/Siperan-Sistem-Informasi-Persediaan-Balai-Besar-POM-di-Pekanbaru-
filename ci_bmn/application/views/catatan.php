<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller {

    public function __construct()
    {
     parent::__construct();
     $this->load->library('form_validation');
     $this->load->helper('tgl_indonesia_helper');
     $this->load->model('Model_barang');
 }


 public function index()
 {
    $data['pageTitle'] = 'Barang';   
    $data['barang'] = $this->Model_barang->get_barang()->result();
    $data['pageContent'] = $this->load->view('data_barang', $data, TRUE);

    $this->load->view('template/layout', $data);
}


public function insert() 
{
    $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|is_unique[barang.kode_barang]');
    $this->form_validation->set_rules('nama_barang', 'Nomor Katalog', 'required');
    $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
    $this->form_validation->set_rules('tgl_kadaluarsa', 'Tanggal Kadaluarsa', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required');
    $this->form_validation->set_rules('no_gudang', 'Nomor Gudang', 'required');

    $this->form_validation->set_message('required', '%s masih kosong, silahkan isi');

    $this->form_validation->set_message('is_unique', '%s sudah ada, silahkan isi dengan value yang berbeda');

    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    if($this->form_validation->run() ) {

     if ($this->input->post('submit')) {
        if (!empty($_FILES['foto_barang']['name'])) {
            // Konfigurasi library upload codeigniter
            $config['upload_path'] = './assets/images/foto';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2000;
            $config['width']= 600;
            $config['height']= 400;
            $config['file_name'] = 'foto_';
                
            // Load library upload
            $this->load->library('upload', $config);
                    
            // Jika terdapat error pada proses upload maka exit
            if (!$this->upload->do_upload('foto_barang')) {
                exit($this->upload->display_errors());
            }
            else
            {
                $foto_barang = $this->upload->data()['file_name'];
            }

            print_r($foto_barang); die;                                            
        }

            $foto_barang = $this->input->post('foto_barang');
            $kode_barang = $this->input->post('kode_barang');
            $data = array(
                'kode_barang'       => $kode_barang,                      
                'nama_barang'       => $this->input->post('nama_barang'),
                'jenis_barang'      => $this->input->post('jenis_barang'),
                'tgl_kadaluarsa'    => $this->input->post('tgl_kadaluarsa'),
                'satuan'            => $this->input->post('satuan'),
                'no_gudang'         => $this->input->post('no_gudang'),
                'foto_barang'       => $foto_barang           
            );

            $this->db->insert('barang', $data);

            

            $data  = array(
                    'id_stock_barang'  => $this->input->post(''),
                    'kode_barang'      => $kode_barang
                );
            $this->db->insert('stock_barang', $data);

            // print_r($data); die;

            $this->db->trans_complete();

                            // cek jika query berhasil
            if ($this->db->trans_status() === true)  {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang telah ditambahkan');
            }
            else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang gagal ditambahkan');
            }

                            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);


                            // refresh page
            redirect('barang', 'refresh');
        }

    }else{

        $data['pageTitle'] = 'Barang';   
        $data['barang'] = $this->Model_barang->get_barang()->result();
        $data['pageContent'] = $this->load->view('data_barang', $data, TRUE);

        $this->load->view('template/layout', $data);
    }
}

    //FUNCTION UPDATE Barang

public function update($id = null)
{
    if ($this->input->post('submit')) {
        $id = $this->input->post('kode');
        $data = array(                                                     
            'nama_barang'       => $this->input->post('nama_barang'),
            'jenis_barang'      => $this->input->post('jenis_barang'),
            'tgl_kadaluarsa'    => $this->input->post('tgl_kadaluarsa'),
            'satuan'            => $this->input->post('satuan'),
            'no_gudang'         => $this->input->post('no_gudang')                 
        );

            // Jalankan function update pada model

        $query = $this->Model_barang->update($id, $data);


            // cek jika query berhasil
        if ($this->db->trans_status() === true)  {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'Barang telah diupdate');
        }
        else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'Barang gagal diupdate');
        }

            // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

            // print_r($data);die;

            // refresh page
        redirect('barang', 'refresh');
    }    
}


    //FUNCTION DELETE Barang

public function delete($id = null)
{
    $barang = $this->Model_barang->get_barang_byId($id);

    if (!$barang) show_404();

    $query = $this->Model_barang->delete($id);


            // cek jika query berhasil
    if ($this->db->trans_status() === true)  {
        $this->db->trans_commit();
        $message = array('status' => true, 'message' => 'Barang telah dihapus');
    }
    else {
        $this->db->trans_rollback();
        $message = array('status' => true, 'message' => 'Barang gagal dihapus');
    }

            // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    redirect('barang', 'refresh');
}

}