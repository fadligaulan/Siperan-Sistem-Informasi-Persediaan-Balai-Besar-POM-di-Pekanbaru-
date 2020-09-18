<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

    
    public function index(){
        $cek = $this->session->userdata("status");

        if(empty($cek)){
            $this->load->view('login');
        }else{
            $status = $this->session->userdata("status");
            if($status == "admin"){
                header("location: ".base_url()."Dashboard");
            }else{
                header("location: ".base_url()."Order");
            }
        }
        // $this->load->view('login');
    }

    public function login(){

        $this->load->model('Model_users');
        if(isset($_POST['masuk'])){
            $u = $this->input->post("nip");
            $p = $this->input->post("password");  
           
            //$this->load->model('m_login');
            $this->Model_users->getLogin($u, $p);
        }
          $this->load->view('login');
    }

    public function logout()
    {
        //Hapus semua data pada session 
        $this->session->sess_destroy(); 

        //redirect ke halaman login 
        redirect('auth','refresh');
    }

    
}