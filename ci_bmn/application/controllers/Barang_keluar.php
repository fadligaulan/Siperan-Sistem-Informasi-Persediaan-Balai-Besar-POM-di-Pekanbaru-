<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends MY_Controller {

	public function __construct()
    {
         parent::__construct();
         $this->cekLogin();
         $this->load->library('form_validation');
         $this->load->helper('tgl_indonesia_helper');
         $this->load->model('Model_barang_keluar');
         $this->load->model('Model_barang');
         $this->load->model('Model_supplier');
           // $this->load->model('Model_stock_barang');
    }  


    public function index()
    {
        $data['pageTitle'] = 'Data Barang Keluar';  
        $data['barang_keluar'] = $this->Model_barang_keluar->getBarangKeluar()->result();
        $data['pageContent'] = $this->load->view('data_barang_keluar', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

    function getRecord($ordID){
        // Fetch order data from the database
        $data['pageTitle'] = 'Order Success';
        $data['order'] = $this->Model_barang_keluar->getOrder($ordID);
        
        // Load order details view
        // $this->load->view($this->controller.'/order-success', $data);
        $data['pageContent'] = $this->load->view('sbbk', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

    public function cetak_sbbk($ordID)
    {        
    

        $data['pageTitle'] = 'Order Success';
        $data['order'] = $this->Model_barang_keluar->getOrder($ordID);
        
        // Load order details view
        // $this->load->view($this->controller.'/order-success', $data);
        $html = $this->load->view('cetak_sbbk', $data, TRUE);

        $this->load->view('template/layout', $data);
        $html = $this->load->view('cetak_sbbk', $data, TRUE);

        
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4-P',
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 20,
            'margin_header' => 20,
            'margin_footer' => 20,
        ]);
        $mpdf->SetWatermarkText('SBBK');
        $mpdf->showWatermarkText = true;
        // $mpdf =new mPDF('utf-8', array(210,330));

        // $mpdf->defaultheaderline = 0;
        // $mpdf->SetHeader('
        //   <div style="text-align: left; font-weight: bold; font-size: 12pt;">
        //   BALAI BESAR PENGAWAS OBAT DAN MAKANAN<br> DI PEKANBARU
        //   </div>');

              // Write some HTML code:
        $mpdf->WriteHTML($html);

              // Output a PDF file directly to the browser
        $mpdf->Output();


    }

}