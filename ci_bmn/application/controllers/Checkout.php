<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{

	function  __construct()
	{
		parent::__construct();
		$this->cekLogin();

		// Load form library & helper
		$this->load->helper('tgl_indonesia_helper');
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->load->model('Model_bidang');
		$this->load->model('Model_pegawai');

		// Load cart library
		$this->load->library('cart');

		// Load product model
		$this->load->model('model_checkout');

		$this->load->model('Model_notifikasi');

		$this->controller = 'checkout';
	}


	function index()
	{

		$custData = $data = array();

		// If order request is submitted
		$submit = $this->input->post('placeOrder');
		if (isset($submit)) {

			$this->db->trans_start();

			$kode_bidang = $this->input->post('kode_bidang', TRUE);

			$this->db->select('no_order');
			$this->db->from('customers');
			$this->db->where('kode_bidang', $kode_bidang);
			// $this->db->where('Y');
			$this->db->order_by('no_order', 'DESC');
			$this->db->limit('1');

			$cekNo = $this->db->get()->row();

			if ($cekNo) {
				$no_order = $cekNo->no_order + 1;
			} else {
				$no_order = 1;
			}

			$custID = $this->db->insert_id();
			// Prepare customer data
			$custData = array(
				'id'			=> $custID,
				'kode_bidang'	 => $kode_bidang,
				'id_pegawai'	 => $this->session->id_pegawai,
				'no_order'	 => $no_order,
				'date'	 => date('Y-m-d'),
				'bulan' => date('m'),
				'tahun' => date('Y')
			);


			$insert = $this->model_checkout->insertCustomer($custData);


			$ordData = array(
				'customer_id' => $insert
			);
			$insertOrder = $this->model_checkout->insertOrder($ordData);

			$cartItems = $this->cart->contents();

			// Cart items
			$ordItemData = array();
			$i = 0;

			foreach ($cartItems as $item) {
				$this->db->select('current_stock');
				$this->db->from('stock');
				$this->db->where('kode_barang', $item['id']);
				$this->db->limit('1');

				$result = $this->db->get()->row();

				$stock_skrg = $result ? $result->current_stock : 0;
				if ($stock_skrg >= $item['qty']) {
					$ordItemData[$i]['order_id'] 	= $insertOrder;
					$ordItemData[$i]['kode_barang'] 	= $item['id'];
					$ordItemData[$i]['quantity'] 	= $item['qty'];
					$ordItemData[$i]['date_time']  = date('Y-m-d H:i:s');
					$i++;
				} else {
					// echo "Maaf Stock ".$item['name']." tidak cukup";
					$this->session->set_flashdata("message", "Mohon maaf stok " . $item['name'] . " tidak cukup");
					redirect('order');
					// $message = array('status' => true, 'message' => 'Barang gagal ditambahkan');
					// redirect('order');
					// echo "<script>alert('Mohon maaf stok tidak cukup'); </script>";
					// echo "<script>window.location='".site_url('order')."'; </script>";
				}
			}

			$insertOrderItems = $this->model_checkout->insertOrderItems($ordItemData);

			require APPPATH . 'views/vendor/autoload.php';

			$options = array(
				'cluster' => 'ap1',
				'useTLS' => true
			);
			$pusher = new Pusher\Pusher(
				'82baa001eba53108403c',
				'487b8c0385db9e99fecb',
				'1014226',
				$options
			);
			$data['message'] = 'hello world';
			$pusher->trigger('my-channel', 'my-event', $data);
			$custID = $this->db->insert_id();
			$this->db->insert('notif', [
				'id_notif' => $this->input->post('id_notif', TRUE), 'customer_id' => $insert, 'target' => '199511272019032004', 'client' => $this->session->nip,
				'tanggal' => date('Y-m-d H:i:s'), 'keterangan' => 'Menunggu persetujuan BMN', 'jenis' => 'Pengajuan Barang'
			]);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();
				$message = array('status' => true, 'message' => 'Terimakasih, permintaan anda akan di proses.');
			} else {
				$this->db->trans_rollback();
				$message = array('status' => true, 'message' => 'Mohon maaf permintaan anda tidak dapat di proses.');
			}
			// simpan message sebagai session
			$this->session->set_flashdata('message', $message);
			// refresh page
			redirect('daftar_order');
		}
		$data['pageTitle'] = 'Checkout';
		// Customer data
		$data['custData'] = $custData;
		// Retrieve cart data from the session
		$data['cartItems'] = $this->cart->contents();
		$data['bidang'] = $this->Model_bidang->get_bidang()->result();
		$data['pegawai'] = $this->Model_pegawai->get_pegawai()->result();
		// Pass products data to the view
		// 
		$data['pageContent'] = $this->load->view('checkout', $data, TRUE);
		$this->load->view('template/layout', $data);
	}
	public function update($id = null)
	{
		$this->db->trans_start();
		$submit = $this->input->post('submit');
		if (isset($submit)) {
			$data = $this->input->post();
			if ($data['target'] == $data['client']) {
				$hapus = $this->db->where('id_notif', $this->input->post('id_notif'))->update('notif', ['read' => 'Y']);
				$this->db->trans_complete();
				redirect('dashboard');
			}
			// var_dump($data);
			// exit;
			$id = $this->input->post('id_notif');
			$id_customer = $this->input->post('customer_id');
			$this->db->delete('order_items', array('order_id' => $id_customer));
			for ($i = 0; $i < count($data["id"]); $i++) {
				$batch[] = array(
					'id' => $data['id'][$i],
					'order_id' => $this->input->post('customer_id'),
					'kode_barang' => $data['kode_barang'][$i],
					'quantity' => $data['quantity'][$i],
					'date_time' => date('Y-m-d H:i:s'),
				);
			}
			// print_r($batch); die;
			$this->db->insert_batch('order_items', $batch);
			// $this->db->update_batch('order_items', $data, $id);
			// print_r($result); die;

			$custData = array(
				'pengajuan' => 'N'
			);

			$this->db->where('id', $id_customer);
			// print_r($id); die;
			$this->db->update('customers', $custData);


			$ok = array(
				'read' => 'Y'
			);

			$this->db->where('id_notif', $id);
			// print_r($id); die;
			$this->db->update('notif', $ok);


			for ($i = 0; $i < count($data["id"]); $i++) {
				$this->db->select('stock_barang');
				$this->db->from('stock_barang');
				$this->db->where('kode_barang', $data['kode_barang'][$i]);
				$this->db->order_by('date_time', 'DESC');
				$this->db->limit('1');

				$result = $this->db->get()->row();

				// print_r($result); die;
				// echo '<pre>',print_r($result).'</pre>'; 

				$current_stock = $result ? $result->stock_barang : 0;
				$next_stock = $current_stock - $data['quantity'][$i];

				// echo $item['id']."<br>".$current_stock; echo "<br>".$next_stock;
				if ($current_stock > 0 && $next_stock >= 0) {

					$stock_record[] = array(
						'no_registrasi' => $data['no_order'] . '/SPB/' . $data['kode_bidang'] . '/' . date('m') . '/' . date('Y'),
						'id_barang_masuk' => $id_customer,
						'kode_barang' => $data['kode_barang'][$i],
						'asal_distribusi' => $data['kode_bidang'],
						'stock_barang' => $next_stock,
						'stock_out' => $data['quantity'][$i],
						'date_time' => date('Y-m-d H:i:s'),
						'tanggal' => date('Y-m-d H:i:s'),
					);
				} else {

					// echo '<pre>',print_r($current_stock).'</pre>';
					//                echo '<pre>',print_r($next_stock).'</pre>'; die;
					// echo "Maaf Stock ".$item['name']." tidak cukup";die;
					$this->session->set_flashdata('message', 'Mohon maaf stok tidak cukup');
					redirect('order');
					// echo "<script>alert('Mohon maaf stok tidak cukup'); </script>";
					// echo "<script>window.location='".site_url('order')."'; </script>";
				}
			}
			// echo '<pre>',print_r($stock_record).'</pre>'; die;
			$this->db->insert_batch('stock_barang', $stock_record);

			require APPPATH . 'views/vendor/autoload.php';

			$options = array(
				'cluster' => 'ap1',
				'useTLS' => true
			);
			$pusher = new Pusher\Pusher(
				'82baa001eba53108403c',
				'487b8c0385db9e99fecb',
				'1014226',
				$options
			);
			$data['message'] = 'hello world';
			$pusher->trigger('my-channel', 'my-event', $data);
			$notif_atasan = $this->db->insert('notif', ['customer_id' => $this->input->post('customer_id', TRUE), 'target' => '198507292012122002', 'client' => $this->input->post('client', TRUE), 'tanggal' => date('Y-m-d H:i:s'), 'keterangan' => 'Menunggu persetujuan atasan', 'jenis' => 'Pengajuan Barang']);
			$this->db->trans_complete();
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();
				$message = array('status' => true, 'message' => 'Permintaan telah proses di proses.');
			} else {
				$this->db->trans_rollback();
				$message = array('status' => true, 'message' => 'Mohon maaf permintaan tidak dapat di proses.');
			}

			// simpan message sebagai session
			$this->session->set_flashdata('message', $message);

			redirect('dashboard', 'refresh');
		}
		if ($this->input->post('tolak')) {
			$id = $this->input->post('id_notif');
			$id_customer = $this->input->post('customer_id');
			$custData = array(
				'pengajuan' => 'T'
			);
			$this->db->where('id', $id_customer);
			// print_r($id); die;
			$this->db->update('customers', $custData);
			$ok = array(
				'read' => 'Y'
			);
			$this->db->where('id_notif', $id);
			// print_r($id); die;
			$this->db->update('notif', $ok);
			require APPPATH . 'views/vendor/autoload.php';
			$options = array(
				'cluster' => 'ap1',
				'useTLS' => true
			);
			$pusher = new Pusher\Pusher(
				'82baa001eba53108403c',
				'487b8c0385db9e99fecb',
				'1014226',
				$options
			);
			$data['message'] = 'hello world';
			$pusher->trigger('my-channel', 'my-event', $data);
			$notif_pemohon = $this->db->insert('notif', ['customer_id' => $this->input->post('customer_id', TRUE), 'target' => $this->input->post('client', TRUE), 'client' => $this->input->post('client', TRUE), 'tanggal' => date('Y-m-d H:i:s'), 'keterangan' => 'Permintaan anda di Tolak', 'jenis' => 'Pengajuan Barang']);
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();
				$message = array('status' => true, 'message' => 'Permintaan telah di tolak');
			} else {
				$this->db->trans_rollback();
				$message = array('status' => true, 'message' => 'Permintaan gagal di tolak');
			}
			// simpan message sebagai session
			$this->session->set_flashdata('message', $message);

			redirect('dashboard', 'refresh');
		}
		if ($this->input->post('submit_atasan')) {
			$id = $this->input->post('id_notif');
			$id_customer = $this->input->post('customer_id');
			$custData = array(
				'pengajuan' => 'Y'
			);
			$this->db->where('id', $id_customer);
			// print_r($id); die;
			$this->db->update('customers', $custData);
			$ok = array(
				'read' => 'Y'
			);
			$this->db->where('id_notif', $id);
			// print_r($id); die;
			$this->db->update('notif', $ok);
			require APPPATH . 'views/vendor/autoload.php';
			$options = array(
				'cluster' => 'ap1',
				'useTLS' => true
			);
			$pusher = new Pusher\Pusher(
				'82baa001eba53108403c',
				'487b8c0385db9e99fecb',
				'1014226',
				$options
			);
			$data['message'] = 'hello world';
			$pusher->trigger('my-channel', 'my-event', $data);
			$notif_pemohon = $this->db->insert('notif', ['customer_id' => $this->input->post('customer_id', TRUE), 'target' => $this->input->post('client', TRUE), 'client' => $this->input->post('client', TRUE), 'tanggal' => date('Y-m-d H:i:s'), 'keterangan' => 'Sudah di Proses', 'jenis' => 'Pengajuan Barang']);
			if ($this->db->trans_status() === true) {
				$this->db->trans_commit();
				$message = array('status' => true, 'message' => 'Permintaan telah di proses');
			} else {
				$this->db->trans_rollback();
				$message = array('status' => true, 'message' => 'Permintaan gagal di porses');
			}
			// simpan message sebagai session
			$this->session->set_flashdata('message', $message);

			redirect('dashboard', 'refresh');
		}
	}

	public function delete($id = null)
	{
		$notif = $this->Model_notifikasi->get_notif_byId($id);
		$data = array(
			'pengajuan' => 'T'
		);
		$this->db->where('id', $id);
		// print_r($data); die;
		$this->db->update('customers', $data);
		if (!$notif) show_404();
		$query = $this->Model_notifikasi->delete($id);
		// cek jika query berhasil
		if ($this->db->trans_status() === true) {
			$this->db->trans_commit();
			$message = array('status' => true, 'message' => 'Permintaan telah di tolak');
		} else {
			$this->db->trans_rollback();
			$message = array('status' => true, 'message' => 'Permintaan gagal di tolak');
		}
		// simpan message sebagai session
		$this->session->set_flashdata('message', $message);
		redirect('dashboard', 'refresh');
	}
}