<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->library('form_validation');
        $this->load->helper('tgl_indonesia_helper');
        $this->load->model('Model_barang');
        $this->load->helper(array('form', 'url'));
    }


    public function index()
    {
        $data['pageTitle'] = 'Data Barang';
        $data['barang'] = $this->Model_barang->get_barang()->result();
        $data['pageContent'] = $this->load->view('data_barang', $data, TRUE);

        $this->load->view('template/layout', $data);
    }



    public function insert()
    {
        $kode_barang = $this->db->insert_id();
        if ($this->input->post('submit')) {
            $this->db->trans_start();
            if (!empty($_FILES['foto_barang']['name'])) {
                // Konfigurasi library upload codeigniter
                $config['upload_path'] = './assets/images/foto';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2000;
                $config['width'] = 600;
                $config['height'] = 400;
                $config['file_name'] = '';

                // Load library upload
                $this->load->library('upload', $config);

                // Jika terdapat error pada proses upload maka exit
                if (!$this->upload->do_upload('foto_barang')) {
                    exit($this->upload->display_errors());
                } else {
                    $foto_barang = $this->upload->data()['file_name'];
                }
            }


            $kode_barang = $this->db->insert_id();
            $data = array(
                'kode_barang'       => $kode_barang,
                'no_katalog'        => $this->input->post('no_katalog'),
                'nama_barang'       => $this->input->post('nama_barang'),
                'jenis_barang'      => $this->input->post('jenis_barang'),
                'no_gudang'         => $this->input->post('no_gudang'),
                'foto_barang'       => $foto_barang
            );
            $this->db->trans_begin();
            $this->db->insert('barang', $data);


            $kode_barang = $this->db->insert_id();
            $stock  = array(
                'kode_barang'   => $kode_barang
            );
            // echo '<pre>',print_r($stock).'</pre>'; die;
            $this->db->insert('stock', $stock);



            $this->db->trans_complete();

            // cek jika query berhasil
            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang telah ditambahkan</i>');
            } else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang gagal ditambahkan');
            }

            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);


            // refresh page
            redirect('barang', 'refresh');
        }

        $data['pageTitle'] = 'Tambah barang';
        $data['barang'] = $this->Model_barang->get_barang()->result();
        $data['pageContent'] = $this->load->view('tambah_data_barang', $data, TRUE);

        $this->load->view('template/layout', $data);
    }


    //FUNCTION UPDATE Barang

    public function update($id = null)
    {
        if ($this->input->post('submit')) {
            $this->db->trans_start();
            if (!empty($_FILES['foto_barang']['name'])) {
                // Konfigurasi library upload codeigniter
                $config['upload_path'] = './assets/images/foto';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2000;
                $config['width'] = 600;
                $config['height'] = 400;
                $config['file_name'] = 'foto_';

                // Load library upload
                $this->load->library('upload', $config);

                // Jika terdapat error pada proses upload maka exit
                if (!$this->upload->do_upload('foto_barang')) {
                    exit($this->upload->display_errors());
                } else {
                    $foto_barang = $this->upload->data()['file_name'];
                }
            } else {
                $foto_barang = $this->input->post('foto_lama');
            }

            $data = array(
                'no_katalog'        => $this->input->post('no_katalog'),
                'nama_barang'       => $this->input->post('nama_barang'),
                'jenis_barang'      => $this->input->post('jenis_barang'),
                'no_gudang'         => $this->input->post('no_gudang'),
                'foto_barang'       => $foto_barang
            );

            // Jalankan function update pada model
            $this->db->trans_begin();
            $id = $this->input->post('kode_barang');
            $query = $this->Model_barang->update($id, $data);

            $this->db->trans_complete();
            // cek jika query berhasil
            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang telah diupdate');
            } else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang gagal diupdate');
            }

            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);

            // print_r($data);die;

            // refresh page
            redirect('barang', 'refresh');
        }

        $data['pageTitle'] = 'Edit barang';
        $data['barang'] = $this->Model_barang->get_barang_byId($id);
        $data['pageContent'] = $this->load->view('update_barang', $data, TRUE);

        $this->load->view('template/layout', $data);
    }


    //FUNCTION DELETE Barang

    public function delete($id = null)
    {
        $barang = $this->Model_barang->get_barang_byId($id);

        if (!$barang) show_404();

        $query = $this->Model_barang->delete($id);


        // cek jika query berhasil
        if ($this->db->trans_status() === true) {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'Barang telah dihapus');
        } else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'Barang gagal dihapus');
        }

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        redirect('barang', 'refresh');
    }
}