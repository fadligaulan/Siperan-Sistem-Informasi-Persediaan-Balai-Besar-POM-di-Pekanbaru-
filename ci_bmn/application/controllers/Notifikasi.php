<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Notifikasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_notifikasi');
    // cek_aktif_login();

  }

  public function approval()
  {
    // cek_ajax();
    if ($this->input->post('jenis') == 'Pengajuan Barang') {

      $data = $this->Model_notifikasi->pengajuan_barang();
      $output = '';
      $output .= '
            <input type="hidden" name="id_notif" value="' . $data["id_notif"] . '" />
            <input type="hidden" name="customer_id" value="' . $data["customer_id"] . '" />
            <input type="hidden" name="client" value="' . $data["client"] . '" />
            <input type="hidden" name="target" value="' . $data["target"] . '" />
                <table class="table table-sm">
                  
                  <tbody>
                    <tr>
                      <th width="30%">Nama Bidang</th>
                      <td>' . $data["nama_bidang"] . '</td>
                      <td><input type="hidden" name="kode_bidang" class="form-control text-center" value="' . $data["kode_bidang"] . '" readonly=""></td>
                      <td><input type="hidden" name="no_order" class="form-control text-center" value="' . $data["no_order"] . '" readonly=""></td>
                    </tr>
                    <tr>
                      <th width="30%">Nama Pegawai</th>
                      <td>' . $data["nama_pegawai"] . '</td>
                    </tr>
                    <tr>
                      <th width="30%">Tanggal</th>
                      <td>' . date('d F Y', strtotime($data["tanggal"])) . '</td>
                    </tr>
                    <tr>
                      <th width="30%">keterangan</th>
                      <td>' . $data["keterangan"] . '</td>
                    </tr>
                  </tbody>
                </table>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nomor Katalog</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>No Gudang</th>
                            <th>Jumlah Order</th>
                        </tr>
                    </thead>';
      $count = 0;
      foreach ($data['items'] as $item) {
        $count++;
        if ($data['target'] != $data['client']) {
          if ($this->session->userdata('status') === 'admin') {
            $output .= '
                        <tbody>
                            <tr>
                                <input type="hidden" name="id[]" class="form-control text-center" value="' . $item["id"] . '">
                                <td><input type="text" name="kode_barang[]" class="form-control text-center" value="' . $item["kode_barang"] . '" readonly=""></td>
                                <td>' . $item["no_katalog"] . '</td>
                                <td><input type="text" name="nama_barang[]" class="form-control text-center" value="' . $item["nama_barang"] . '" readonly=""></td>
                                <td>' . $item["jenis_barang"] . '</td>
                                <td>' . $item["no_gudang"] . '</td>
                                <td><input type="number" name="quantity[]" class="form-control text-center" value="' . $item["quantity"] . '"></td>
                            </tr>
                        </tbody>';
          }
          if ($this->session->userdata('status') === 'super admin') {
            $output .= '
                        <tbody>
                            <tr>
                                <input type="hidden" name="id[]" class="form-control text-center" value="' . $item["id"] . '">
                                <td><input type="text" name="kode_barang[]" class="form-control text-center" value="' . $item["kode_barang"] . '" readonly=""></td>
                                <td>' . $item["no_katalog"] . '</td>
                                <td><input type="text" name="nama_barang[]" class="form-control text-center" value="' . $item["nama_barang"] . '" readonly=""></td>
                                <td>' . $item["jenis_barang"] . '</td>
                                <td>' . $item["no_gudang"] . '</td>
                                <td><input type="number" name="quantity[]" class="form-control text-center" value="' . $item["quantity"] . '" readonly=""></td>
                            </tr>
                        </tbody>';
          }
        } else {
          $output .= '
                      <tbody>
                          <tr>
                              <input type="hidden" name="id[]" class="form-control text-center" value="' . $item["id"] . '">
                              <td><input type="text" name="kode_barang[]" class="form-control text-center" value="' . $item["kode_barang"] . '" readonly=""></td>
                              <td>' . $item["no_katalog"] . '</td>
                              <td><input type="text" name="nama_barang[]" class="form-control text-center" value="' . $item["nama_barang"] . '" readonly=""></td>
                              <td>' . $item["jenis_barang"] . '</td>
                              <td>' . $item["no_gudang"] . '</td>
                              <td><input type="number" name="quantity[]" class="form-control text-center" value="' . $item["quantity"] . '" readonly=""></td>
                          </tr>
                      </tbody>';
        }
      }
      $output .= '
                  </table>';
      if ($data['target'] != $data['client']) {
        if ($this->session->userdata('status') === 'admin') {
          $output .= '
                              <div class="modal-footer">
                                    <button type="submit" name="tolak" value="true" class="btn btn-danger">Tolak</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" value="true" class="btn btn-success">Terima</button>
                              </div>';
        }
        if ($this->session->userdata('status') === 'super admin') {
          $output .= '
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit_atasan" value="true" class="btn btn-success">Terima</button>
                              </div>';
        }
      } else {
        $output .= '
                    <div class="modal-footer justify-content-between">
                      <button type="submit" name="submit" value="true" class="btn btn-outline-dark">Tutup</button>
                    </div>';
      }




      // print_r($data);die;
      // echo json_encode($data);
      // exit();

      // $this->load->view('notif_view', $data);
      // $this->load->view('template/layout', $data);


    }
    echo $output;
  }

  public function list_notifikasi()
  {
    $this->load->view('navbar_notif');
  }

  public function simpan_pengajuan_cuti()
  {
    cek_ajax();
    echo $this->Data_model->simpan_pengajuan_cuti();
  }
}