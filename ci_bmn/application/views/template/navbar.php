<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <?php if ($this->session->userdata('status') === 'admin') : ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo site_url('dashboard'); ?>" class="nav-link">Home</a>
        </li>
        <?php endif ?>
        <?php if ($this->session->userdata('status') === 'user') : ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo site_url('order'); ?>" class="nav-link">Home</a>
        </li>
        <?php endif ?>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown list-notifikasi">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?php echo base_url('assets/dist/img/user1-128x128.jpg'); ?>" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Logout User
                            </h3>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"><?= sizeof(list_notifikasi()) ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <?php
                if (sizeof(list_notifikasi()) == 0) {
                ?>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="media-body">

                            <h3 class="dropdown-item-title">
                                Tidak ada Notifikasi
                            </h3>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <?php
                }
                foreach (list_notifikasi() as $ln) : ?>
                <a href="#" class="dropdown-item notifikasi" data-id="<?= $ln['id_notif'] ?>"
                    data-jenis="<?= $ln['jenis'] ?>">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?= $ln['jenis'] ?>
                                <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                            </h3>
                            <h3 class="dropdown-item-title">
                                <span class="text-sm"><i class="fas fa-user"></i></span> <?= $ln['nama_pegawai'] ?>
                            </h3>
                            <p class="text-sm"><?= $ln['keterangan'] ?></p>
                            <p class="float-right text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                <?= convert_date_to_id($ln['tanggal']) ?></p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <?php endforeach ?>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->