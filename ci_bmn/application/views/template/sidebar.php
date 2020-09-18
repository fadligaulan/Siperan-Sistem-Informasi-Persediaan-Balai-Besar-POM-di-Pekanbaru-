 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Aplikasi SIPERAN</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $this->session->userdata('nama_pegawai'); ?></a>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <?php if($this->session->userdata('status') === 'admin' || $this->session->userdata('status') === 'super admin'): ?>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('dashboard'); ?>" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                MASTER PEGAWAI
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('pegawai'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('bidang'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Bidang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('pangkat'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pangkat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('jabatan'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Jabatan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                MASTER BARANG
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('barang'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('barang_masuk'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('barang_keluar'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Keluar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('stock_barang'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('barang_kadaluarsa'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Kadaluarsa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('order'); ?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Order Barang
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('daftar_order'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Daftar Permintaan Barang
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('laporan'); ?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Laporan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                LogOut
              </p>
            </a>
          </li>
          <?php endif?>
          <?php if($this->session->userdata('status') === 'user'): ?>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('order'); ?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Order Barang
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('daftar_order'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Data Permintaan Barang
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                LogOut
              </p>
            </a>
          </li>
          <?php endif?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>