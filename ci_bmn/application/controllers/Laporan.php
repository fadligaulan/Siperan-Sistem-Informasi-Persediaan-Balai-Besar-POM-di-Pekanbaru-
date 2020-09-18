<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public function __construct()
    {
         parent::__construct();
         $this->cekLogin();
         $this->load->library('form_validation');
         $this->load->helper('tgl_indonesia_helper');
         $this->load->model('Model_laporan');
    }


    public function index()
    {
        $data['pageTitle'] = 'Laporan';   
        $data['laporan'] = $this->Model_laporan->get_laporan()->result();
        $data['pageContent'] = $this->load->view('laporan', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

    public function print_periode()
    {
        if(isset($_POST['submit']))
        {
            $tanggal1=  $this->input->post('tanggal1');
            $tanggal2=  $this->input->post('tanggal2');
            $nama_barang=  $this->input->post('nama_barang');
            $data['pageTitle'] = 'Laporan';
            $data['laporan']=  $this->Model_laporan->laporan_periode($tanggal1,$tanggal2,$nama_barang);
            // echo "<pre>", print_r($data). "</pre>"; die;
            $data['pageContent'] = $this->load->view('laporan', $data, TRUE);

            $html = $this->load->view('laporan2', $data, TRUE);


                  // Create an instance of the class:
            $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4-P',
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 20,
            'margin_header' => 20,
            'margin_footer' => 20,
            ]);

            $mpdf->SetWatermarkText('Kartu Kendali');
            $mpdf->showWatermarkText = true;
            
                  // Write some HTML code:
            $mpdf->WriteHTML($html);

                  // Output a PDF file directly to the browser
            $mpdf->Output();

        }
        else
        {
            
            $data['pageTitle'] = 'Laporan';   
            $data['laporan'] = $this->Model_laporan->get_Laporan()->result();
            $data['pageContent'] = $this->load->view('laporan', $data, TRUE);

            $this->load->view('template/layout', $data);
        }
    }



}