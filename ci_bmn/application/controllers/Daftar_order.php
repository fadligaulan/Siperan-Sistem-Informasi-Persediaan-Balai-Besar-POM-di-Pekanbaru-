<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_order extends MY_Controller {

	public function __construct()
    {

         parent::__construct();
         $this->cekLogin();
         $this->load->library('form_validation');
         $this->load->helper('tgl_indonesia_helper');
         $this->load->model('Model_daftar_order');
    }


    public function index()
    {
        $data['pageTitle'] = 'Data Permintaan Barang';   
        $data['daftar_order'] = $this->Model_daftar_order->getDaftarOrder()->result();
        $data['daftar_order_admin'] = $this->Model_daftar_order->getDaftarOrderAdmin()->result();
        $data['pageContent'] = $this->load->view('daftar_order', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

    function getRecord($ordID){
        // Fetch order data from the database
        $data['pageTitle'] = 'Order Success';
        $data['order'] = $this->Model_daftar_order->getOrder($ordID);
        
        // Load order details view
        // $this->load->view($this->controller.'/order-success', $data);
        $data['pageContent'] = $this->load->view('spb', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

     public function cetak_spb($ordID)
    {        
    

        $data['pageTitle'] = 'Order Success';
        $data['order'] = $this->Model_daftar_order->getOrder($ordID);
        
        // Load order details view
        // $this->load->view($this->controller.'/order-success', $data);
        $html = $this->load->view('cetak_spb', $data, TRUE);

        $this->load->view('template/layout', $data);
        $html = $this->load->view('cetak_spb', $data, TRUE);

        
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4-P',
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 20,
            'margin_header' => 20,
            'margin_footer' => 20,
        ]);
        
        $mpdf->SetWatermarkText('SPB');
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
    
    public function delete($id = null)
    {
        $daftar_order = $this->Model_daftar_order->getDaftarOrderById($id);

        if(!$daftar_order) show_404();

        $query = $this->Model_daftar_order->delete($id);

         if ($this->db->trans_status() === true)  {
            $this->db->trans_commit();
            $message = array('status' => true, 'message' => 'Order Telah di hapus');
          }
          else {
            $this->db->trans_rollback();
            $message = array('status' => true, 'message' => 'Order gagal di hapus');
          }
          
                // simpan message sebagai session
          $this->session->set_flashdata('message', $message);

          redirect('dashboard', 'refresh');
    }

}