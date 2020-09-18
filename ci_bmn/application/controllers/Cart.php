<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{
	
	function  __construct(){
		parent::__construct();
		
		// Load cart library
		$this->load->library('cart');
		
		// Load product model
		$this->load->model('Model_order');
	}
	
	function index(){
		
        $data['pageTitle'] = 'Cart';
        $data['cartItems'] = $this->cart->contents();  
      //    echo "<pre>";
      // print_r($data); die;
        $data['pageContent'] = $this->load->view('cart', $data, TRUE);
        $this->load->view('template/layout', $data);
	}
	
	function updateItemQty(){
		$update = 0;
		
		// Get cart item info
		$rowid = $this->input->get('rowid');
		$qty = $this->input->get('qty');
		
		// Update item in the cart
		if(!empty($rowid) && !empty($qty)){
			$data = array(
				'rowid' => $rowid,
				'qty'   => $qty
			);
			$update = $this->cart->update($data);
		}
		
		// Return response
        echo $update?'ok':'err';
	}
	
	function removeItem($rowid){
		// Remove item from cart
		$remove = $this->cart->remove($rowid);
		
		// Redirect to the cart page
		redirect('cart/');
	}
	
}