<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $pageTitle; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <?php if($this->session->userdata('status') === 'admin'): ?>
              <li class="breadcrumb-item"><a href="<?php echo site_url('dashboard'); ?>">Home</a></li>
            <?php endif?>
            <?php if($this->session->userdata('status') === 'user'): ?>
              <li class="breadcrumb-item"><a href="<?php echo site_url('order'); ?>">Home</a></li>
            <?php endif?>
              <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php echo $pageContent; ?>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->