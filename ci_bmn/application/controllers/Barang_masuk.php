<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->library('form_validation');
        $this->load->helper('tgl_indonesia_helper');
        $this->load->model('Model_barang_masuk');
        $this->load->model('Model_barang');
        $this->load->model('Model_supplier');
        // $this->load->model('Model_stock_barang');
    }


    public function index()
    {
        $data['pageTitle'] = 'Data Barang Masuk';
        $data['barang'] = $this->Model_barang->get_barang()->result();
        $data['supplier'] = $this->Model_supplier->get_supplier()->result();
        $data['barang_masuk'] = $this->Model_barang_masuk->get_barang_masuk()->result();
        $data['pageContent'] = $this->load->view('data_barang_masuk', $data, TRUE);

        $this->load->view('template/layout', $data);
    }


    public function insert()
    {
        if ($this->input->post('submit')) {
            $this->db->trans_start();
            $id_barang_masuk = $this->input->post('id_barang_masuk', TRUE);
            $no_bukti = $this->input->post('no_bukti', TRUE);
            $kode_barang = $this->input->post('kode_barang', TRUE);
            $jumlah_barang_masuk = $this->input->post('jumlah_barang_masuk', TRUE);
            $nama_supplier = $this->input->post('nama_supplier', TRUE);

            $data = array(
                'id_barang_masuk'           => $id_barang_masuk,
                'no_bukti'                  => $no_bukti,
                'kode_barang'               => $kode_barang,
                'nama_supplier'             => $nama_supplier,
                'jumlah_barang_masuk'       => $jumlah_barang_masuk,
                'tgl_masuk'                 => $this->input->post('tgl_masuk'),
                'satuan'                    => $this->input->post('satuan'),
                'keterangan'                => $this->input->post('keterangan')
            );

            $this->db->insert('barang_masuk', $data);

            $id_barang_masuk = $this->db->insert_id();

            $this->db->select('stock_barang');
            $this->db->from('stock_barang');
            $this->db->where('kode_barang', $kode_barang);
            $this->db->order_by('date_time', 'DESC');
            $this->db->limit('1');

            $cekStock = $this->db->get()->row();

            if ($cekStock) {
                $stock_barang = $cekStock->stock_barang + $jumlah_barang_masuk;
            } else {
                $stock_barang = $jumlah_barang_masuk;
            }

            $data = array(
                'id_stock_barang' => $this->input->post(''),
                'id_barang_masuk' => $id_barang_masuk,
                'id_barang_keluar' => 0,
                'no_registrasi' => $no_bukti,
                'kode_barang'   => $kode_barang,
                'asal_distribusi'   => $nama_supplier,
                'stock_in' => $jumlah_barang_masuk,
                'stock_barang' => $stock_barang,
                'date_time'    => date('Y-m-d H:i:s'),
                'tanggal'    => date('Y-m-d')
            );
            $this->db->insert('stock_barang', $data);


            $data = array(
                'id_kadaluarsa' => $this->input->post(''),
                'id_barang_masuk'   => $id_barang_masuk,
                'kode_barang'   => $kode_barang,
                'tgl_kadaluarsa' => $this->input->post('tgl_kadaluarsa')
            );

            $this->db->trans_begin();
            $this->db->insert('kadaluarsa', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang Masuk telah ditambahkan');
            } else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang Masuk gagal ditambahkan');
            }

            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);


            // refresh page
            redirect('barang_masuk', 'refresh');
        }
    }

    //FUNCTION UPDATE Barang Masuk

    public function update($id = null)
    {
        $this->db->trans_start();
        if ($this->input->post('submit')) {
            $id = $this->input->post('id');
            $kode_barang = $this->input->post('kode_barang', TRUE);
            $jumlah_barang_masuk = $this->input->post('jumlah_barang_masuk', TRUE);
            $jumlah_barang_lama = $this->input->post('jumlah_barang_lama', TRUE);
            // print_r($jumlah_barang_lama); die;

            $data = array(
                'no_bukti'                  => $this->input->post('no_bukti'),
                'kode_barang'               => $kode_barang,
                'nama_supplier'             => $this->input->post('nama_supplier'),
                'jumlah_barang_masuk'       => $this->input->post('jumlah_barang_masuk'),
                'tgl_masuk'                 => $this->input->post('tgl_masuk'),
                'satuan'                    => $this->input->post('satuan'),
                'keterangan'                => $this->input->post('keterangan')
            );

            // Jalankan function update pada model
            $this->db->where('id_barang_masuk', $id);
            $this->db->update('barang_masuk', $data);

            // $this->db->delete('kadaluarsa', array('id_barang_masuk' => $id));

            // $id_barang_masuk = $this->db->insert_id();
            $data = array(
                'tgl_kadaluarsa' => $this->input->post('tgl_kadaluarsa')
            );

            // $this->db->trans_begin();
            $this->db->where('id_barang_masuk', $id);
            $this->db->update('kadaluarsa', $data);

            $this->db->select('current_stock');
            $this->db->from('stock');
            $this->db->where('kode_barang', $kode_barang);

            $ambilStockskrg = $this->db->get()->row();

            $updateStock = $ambilStockskrg->current_stock - $jumlah_barang_lama + $jumlah_barang_masuk;


            // print_r($updateStock); die;

            $data = array(
                'current_stock'     => $updateStock
            );

            $this->db->where('kode_barang', $kode_barang);
            $this->db->update('stock', $data);


            $this->db->select('stock_barang');
            $this->db->from('stock_barang');
            $this->db->where('kode_barang', $kode_barang);
            $this->db->order_by('date_time', 'DESC');
            $this->db->limit('1');

            $ambilStocklaporan = $this->db->get()->row();

            $updateStocklaporan = $ambilStockskrg->current_stock - $jumlah_barang_lama + $jumlah_barang_masuk;
            // print_r($updateStocklaporan); die;

            $data = array(
                'stock_in' => $jumlah_barang_masuk,
                'stock_barang' => $updateStocklaporan,
                'date_time'    => date('Y-m-d H:i:s')
            );
            $this->db->where('id_barang_masuk', $id);
            $this->db->update('stock_barang', $data);

            $this->db->trans_complete();
            // cek jika query berhasil
            if ($this->db->trans_status() === true) {
                $this->db->trans_commit();
                $message = array('status' => true, 'message' => 'Barang Masuk telah diupdate');
            } else {
                $this->db->trans_rollback();
                $message = array('status' => true, 'message' => 'Barang Masuk gagal diupdate');
            }

            // simpan message sebagai session
            $this->session->set_flashdata('message', $message);

            // print_r($data);die;

            // refresh page
            redirect('barang_masuk', 'refresh');
        }
    }


    //FUNCTION DELETE Barang Masuk

    public function delete($id = null)
    {
        $barang_masuk = $this->Model_barang_masuk->get_barang_byId($id);

        if (!$barang_masuk) show_404();

        $query = $this->Model_barang_masuk->delete($id);

        $this->db->where('id_barang_masuk', $id);
        $this->db->delete('stock_barang');


        // cek jika query berhasil
        if ($this->db->trans_status() === true) {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'Barang Masuk telah dihapus');
        } else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'Barang Masuk gagal dihapus');
        }

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        redirect('barang_masuk', 'refresh');
    }
}