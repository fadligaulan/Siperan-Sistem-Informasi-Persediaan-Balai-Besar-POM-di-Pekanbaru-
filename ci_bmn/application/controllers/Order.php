<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->library('form_validation');
        $this->load->library('cart');
        $this->load->helper('tgl_indonesia_helper');
        $this->load->model('Model_order');
        $this->load->model('Model_bidang');
        $this->load->model('Model_pegawai');
    }

    public function index()
    {
        $data = array();
        $data['pageTitle'] = 'Order';
        $data['pageContent'] = $this->load->view('order_barang', $data, TRUE);
        $this->load->view('template/layout', $data);
    }

    function fetch()
    {
        $output = '';
        $query = '';
        $this->load->model('Model_order');
        if ($this->input->post('query')) {
            $query = $this->input->post('query');
        }
        $data = $this->Model_order->fetch_data($query);
        $output .= '<div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">';
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $output .= '

            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                    Siperan BBPOM di Pekanbaru
                    </div>
                    <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-7">
                        <h1 class="lead"><b>Nomor Katalog: ' . $row->no_katalog . '</b></h1>
                        <h1 class="lead"><b>' . $row->nama_barang . '/' . $row->jenis_barang . '</b>
                        <h1 class="lead"><font color=#FF0000><b> Stok:' . $row->current_stock . '/' . $row->satuan . '</b></font></h1>
                        <h1 class="text-muted text-sm"><b>Nomor Gudang: ' . $row->no_gudang . '</b></h1>
                        <h1 class="text-muted text-sm"><b> Expired:' . $row->tgl_kadaluarsa . '</b></h1>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        </ul>
                        </div>
                    <div class="col-5 text-center">
                        <img src="' . base_url('assets/images/foto/' . $row->foto_barang) . '" alt="" class="img-circle img-fluid">
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="' . base_url('order/addToCart/' . $row->kode_barang) . '" class="btn btn-sm btn-success">
                        <i class="fas fa-cart"></i> Add to cart
                        </a>
                    </div>
                </div>
                </div>
            </div>
            ';
            }
        } else {
            $output .= '<p>No Data Found<p>';
        }
        $output .= '</div>
                </div>';
        echo $output;
    }

    function addToCart($proID)
    {

        // Fetch specific product by ID
        $product = $this->Model_order->getRows($proID);



        // Add product to the cart
        $data = array(
            'id'  => $product['kode_barang'],
            'qty' => 1,
            'name'  => $product['nama_barang'],
            'jenis_barang'    => $product["jenis_barang"],
            'no_gudang'    => $product["no_gudang"],
            'no_katalog'    => $product["no_katalog"]

        );

        // print_r($data); die;
        $this->cart->insert($data);

        // Redirect to the cart page
        redirect('cart/');
    }
}