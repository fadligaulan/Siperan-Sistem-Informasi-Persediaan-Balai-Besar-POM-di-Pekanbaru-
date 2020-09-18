<div class="card">
  <div class="card-header">
    <?php if($message = $this->session->flashdata('message')): ?>
      <div class="alert alert-dismissible alert-<?php echo ($message['status']) ? 'success' : 'danger'; ?>"><?php echo $message['message']; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>    
  <?php endif; ?>
</div>
<!-- /.card-header -->
<div class="card-body">
  <div class="card-title">
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-supplier">
      <i class="fas fa-plus">Tambah</i>
    </button>
  </div>
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama supplier</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
     <?php $no = 0; foreach($supplier as $row): ?>
     <tr>
      <td width="5%"><?php echo ++$no; ?></td>
      <td><?php echo $row->nama_supplier; ?></td>
      <td><a 
        href = "javascript:;"
        data-id = "<?php echo $row->id_supplier; ?>"
        data-nama_supplier = "<?php echo $row->nama_supplier; ?>"
        data-toggle ="modal" data-target="#update_supplier">
        <button class="btn btn-warning btn-sm" data-target="#ubah" data-toggle="modal" data-placement="top" title="update"><i class="fa fa-edit">Edit</i></button></a>
        <a href="<?php echo site_url('supplier/delete/'. $row->id_supplier); ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Hapus</i></a></td>
      <?php endforeach; ?>
    </tr>
  </tbody>
  <tfoot>
    <tr>
     <th>No</th>
     <th>Nama supplier</th>
     <th>Aksi</th>
   </tr>
 </tfoot>
</table>
</div>
<!-- /.card-body -->
</div>

<!-- modal insert -->
<div class="modal fade" id="modal-supplier">
  <form action="<?php echo base_url().'index.php/supplier/insert'?>" method="post">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <div class="modal-header">
          <h4 class="modal-title">Tambah data supplier</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label>Nama supplier*:</label>
                  <input type="text" name="nama_supplier" class="form-control" placeholder="Nama supplier" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" value="true" class="btn btn-outline-light">Save changes</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.modal -->


  <!-- modal update -->
  <div class="modal fade" id="update_supplier">
    <form action="<?php echo base_url().'index.php/supplier/update'?>" method="post">
      <div class="modal-dialog">
        <div class="modal-content bg-warning">
          <div class="modal-header">
            <h4 class="modal-title">Ubah data supplier</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                   <input type="hidden" name="id" id="id">
                   <label>Nama supplier*:</label>
                   <input type="text" name="nama_supplier" id="supplier" class="form-control" placeholder="Nama supplier" required="">
                 </div>
               </div>
             </div>
           </div>
           <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" value="true" class="btn btn-outline-dark">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
  </div>

