<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_kadaluarsa extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->library('form_validation');
        $this->load->helper('tgl_indonesia_helper');
        $this->load->model('Model_barang_kadaluarsa');
        $this->load->model('Model_barang');
        $this->load->model('Model_supplier');
    }


    public function index()
    {
        $data['pageTitle'] = 'Data Barang Kadaluarsa';
        $data['barang'] = $this->Model_barang->get_barang()->result();
        $data['supplier'] = $this->Model_supplier->get_supplier()->result();
        $data['barang_kadaluarsa'] = $this->Model_barang_kadaluarsa->get_barang_kadaluarsa()->result();
        $data['pageContent'] = $this->load->view('data_barang_kadaluarsa', $data, TRUE);

        $this->load->view('template/layout', $data);
    }


    public function insert()
    {
        if ($this->input->post('submit')) {
            $this->db->trans_start();
            $no_kadaluarsa = $this->input->post('no_kadaluarsa', TRUE);
            $kode_barang = $this->input->post('kode_barang', TRUE);
            $jumlah_barang_kadaluarsa = $this->input->post('jumlah_barang_kadaluarsa', TRUE);
            $nama_supplier = $this->input->post('nama_supplier', TRUE);

            $data = array(
                'id_kadaluarsa'                  => $this->input->post('id_kadaluarsa'),
                'no_kadaluarsa'                  => $no_kadaluarsa,
                'kode_barang'                    => $kode_barang,
                'jumlah_barang_kadaluarsa'       => $jumlah_barang_kadaluarsa,
                'nama_supplier'                  => $nama_supplier,
                'tgl_kadaluarsa'                 => $this->input->post('tgl_kadaluarsa'),
                'satuan'                         => $this->input->post('satuan'),
                'keterangan'                     => $this->input->post('keterangan')
            );

            $this->db->insert('barang_kadaluarsa', $data);
            $id_kadaluarsa = $this->db->insert_id();
            // $this->db->delete('kadaluarsa', array('kode_barang' => $kode_barang));
            $query = $this->db
                ->where('kode_barang', $kode_barang)
                ->order_by('kode_barang', 'ASC')
                ->limit('1')
                ->delete('kadaluarsa');

            $this->db->select('stock_barang');
            $this->db->from('stock_barang');
            $this->db->where('kode_barang', $kode_barang);
            $this->db->order_by('date_time', 'DESC');
            $this->db->limit('1');

            $cekStock = $this->db->get()->row();

            if ($cekStock) {
                $stock_barang = $cekStock->stock_barang - $jumlah_barang_kadaluarsa;
            } else {
                $stock_barang = $jumlah_barang_kadaluarsa;
            }

            $data = array(
                'id_stock_barang' => $this->input->post(''),
                'no_registrasi' => $no_kadaluarsa,
                'kode_barang'   => $kode_barang,
                'asal_distribusi'   => $nama_supplier,
                'stock_out' => $jumlah_barang_kadaluarsa,
                'stock_barang' => $stock_barang,
                'date_time'    => date('Y-m-d H:i:s')
            );
            $this->db->trans_begin();
            $this->db->insert('stock_barang', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang Kadaluarsa telah ditambahkan');
            } else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang Kadaluarsa gagal ditambahkan');
            }

            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);


            // refresh page
            redirect('barang_kadaluarsa', 'refresh');
        }
    }

    //FUNCTION UPDATE Barang Kadaluarsa

    public function update($id = null)
    {
        $this->db->trans_start();
        if ($this->input->post('submit')) {
            $id = $this->input->post('id');
            $kode_barang = $this->input->post('kode_barang', TRUE);
            $jumlah_barang_kadaluarsa = $this->input->post('jumlah_barang_kadaluarsa', TRUE);
            $data = array(
                'no_kadaluarsa'             => $this->input->post('no_kadaluarsa'),
                'kode_barang'               => $kode_barang,
                'id_supplier'               => $this->input->post('id_supplier'),
                'jumlah_barang_kadaluarsa'  => $this->input->post('jumlah_barang_kadaluarsa'),
                'tgl_masuk'                 => $this->input->post('tgl_masuk'),
                'satuan'                    => $this->input->post('satuan'),
                'keterangan'                => $this->input->post('keterangan')
            );

            // Jalankan function update pada model
            $this->db->where('id_barang_kadaluarsa', $id);
            $this->db->update('barang_kadaluarsa', $data);

            $this->db->delete('kadaluarsa', array('id_barang_kadaluarsa' => $id));

            $id_barang_kadaluarsa = $this->db->insert_id();
            $data = array(
                'id_kadaluarsa' => $this->input->post(''),
                'id_barang_kadaluarsa'   => $id,
                'kode_barang'   => $kode_barang,
                'tgl_kadaluarsa' => $this->input->post('tgl_kadaluarsa')
            );

            $this->db->trans_begin();
            $this->db->insert('kadaluarsa', $data);
            $this->db->trans_complete();
            // cek jika query berhasil
            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang Kadaluarsa telah diupdate');
            } else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang Kadaluarsa gagal diupdate');
            }

            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);

            // print_r($data);die;

            // refresh page
            redirect('barang_kadaluarsa', 'refresh');
        }
    }


    //FUNCTION DELETE Barang Kadaluarsa

    public function delete($id = null)
    {
        $barang_kadaluarsa = $this->Model_barang_kadaluarsa->get_barang_byId($id);

        if (!$barang_kadaluarsa) show_404();

        $query = $this->Model_barang_kadaluarsa->delete($id);


        // cek jika query berhasil
        if ($this->db->trans_status() === true) {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'Barang Kadaluarsa telah dihapus');
        } else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'Barang Kadaluarsa gagal dihapus');
        }

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        redirect('barang_kadaluarsa', 'refresh');
    }
}