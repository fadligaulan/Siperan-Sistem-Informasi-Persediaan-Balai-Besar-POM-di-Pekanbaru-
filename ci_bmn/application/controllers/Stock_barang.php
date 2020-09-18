<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_barang extends MY_Controller {

    public function __construct()
    {
       parent::__construct();
       $this->cekLogin();
       $this->load->library('form_validation');
       $this->load->helper('tgl_indonesia_helper');
       $this->load->model('Model_stock_barang');
    }


    public function index()
    {
        $data['pageTitle'] = 'Data Stock Barang';   
        $data['stock_barang'] = $this->Model_stock_barang->get_stock_barang()->result();
        $data['pageContent'] = $this->load->view('data_stock_barang', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

}