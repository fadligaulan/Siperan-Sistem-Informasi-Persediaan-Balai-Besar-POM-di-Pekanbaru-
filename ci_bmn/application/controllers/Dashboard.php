<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->cekLogin();     
        $this->load->model('Model_dashboard');
    }

	
	public function index()
	{
		$data['pageTitle'] = 'DASHBOARD'; 
		// $data['pegawai'] = $this->Model_dashboard->count_pegawai();
		$data['pageContent'] = $this->load->view('dashboard', $data, TRUE);
		$this->load->view('template/layout', $data);
	}
}
