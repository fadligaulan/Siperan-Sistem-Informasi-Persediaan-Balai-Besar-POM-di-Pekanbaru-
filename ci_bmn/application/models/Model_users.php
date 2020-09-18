<?php
class Model_users extends CI_Model {

    public function getlogin($user, $password){
        $u = $user;
        $p = $password;
        $cek_login = $this->db->get_where('pegawai', array('nip' => $u, 'password' => $p, 'aktif' => 'Y'));
        
    //   echo"<pre>", print_r($cek_login->num_rows()). "</pre>"; die;
        if ($cek_login->num_rows() > 0) {
            $qad = $cek_login->row();
            if ($u == $qad->nip && $p == $qad->password){
                $sess = array(
                    'id_pegawai'    => $qad->id_pegawai,
                    'nip'           => $qad->nip,
                    'nama_pegawai'  => $qad->nama_pegawai,
                    'password'      => $qad->password,
                    'status'        => $qad->status,
                    'aktif'         => $qad->aktif
                );
                
                $this->session->set_userdata($sess);
                

                if($qad->status == 'admin') {
                    // print_r($qad->status); die;
                    header('location:'.base_url().'Dashboard');
                }else{
                    header('location:'.base_url().'Order');
                }
            }
        }else{
            
            // echo "<script>alert('username/password salah !');";
            // echo "windows.location.href = '".base_url()."'; ";
            // echo "</script>";
            // $this->form_validation->set_message('cekAkun', 'Nama Pengguna atau Kata Sandi yang Anda masukan salah!');
            $this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">
                Username atau password salah bro..
            </div>');
            return "Gagal Login";
            redirect(base_url());

        }
    }

}