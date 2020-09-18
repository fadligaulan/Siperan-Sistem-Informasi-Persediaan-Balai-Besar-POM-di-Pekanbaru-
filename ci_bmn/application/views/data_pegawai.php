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
  <div class="card-body table-responsive">
    <div class="card-title">
      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-success">
        <i class="fas fa-plus">Tambah</i>
      </button>
    </div>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>NIP</th>
          <th>Nama Pegawai</th>
          <th>Pangkat</th>
          <th>Jabatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
       <?php $no = 0; foreach($pegawai as $row): ?>
       <tr>
        <td width="5%"><?php echo ++$no; ?></td>
        <td wdith="15%"><?php echo $row->nip; ?></td>
        <td width="20%"><?php echo $row->nama_pegawai; ?></td>
        <td width="20%"><?php echo $row->pangkat; ?> |<?php echo $row->golongan; ?></td>
        <td width="20%"><?php echo $row->jabatan; ?></td>
        <td width="20%"><a 
          href = "javascript:;"
          data-id = "<?php echo $row->id_pegawai; ?>"
          data-nip = "<?php echo $row->nip; ?>"
          data-nama_pegawai = "<?php echo $row->nama_pegawai; ?>"
          data-id_pangkat = "<?php echo $row->id_pangkat; ?>"
          data-id_jabatan = "<?php echo $row->id_jabatan; ?>"
          data-toggle ="modal" data-target="#update_pegawai">
          <button class="btn btn-success btn-sm" data-target="#ubah" data-toggle="modal" data-placement="top" title="update"><i class="fa fa-edit">Edit</i></button></a>
          <a href="<?php echo site_url('pegawai/delete/'. $row->id_pegawai); ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Hapus</i></a></td>
        <?php endforeach; ?>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama Pegawai</th>
        <th>Pangkat</th>
        <th>Jabatan</th>
        <th>Aksi</th>
      </tr>
    </tfoot>
  </table>
</div>
<!-- /.card-body -->
</div>

<!-- modal insert -->
<div class="modal fade" id="modal-success">
  <form action="<?php echo base_url().'index.php/pegawai/insert'?>" method="post">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <div class="modal-header">
          <h4 class="modal-title">Tamabah data pegawai</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label>NIP*:</label>
                  <input type="text" name="nip" class="form-control" placeholder="NIP" required="">
                </div>
                <div class="form-group">
                  <label>Nama Pegawai*:</label>
                  <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" required="">
                </div>
                <div class="form-group">
                  <label>Pangkat*:</label>
                  <select class="form-control select2" name="id_pangkat" style="width: 100%;" required="">
                    <option value="">--Pilih Pangkat--</option>
                    <?php $no = 0; foreach ($pangkat as $row): ?>
                    <option value="<?php echo $row->id_pangkat; ?>"><?php echo $row->pangkat; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Pangkat*:</label>
                <select class="form-control select2" name="id_jabatan" style="width: 100%;" required="">
                  <option value="">--Pilih Jabatan--</option>
                  <?php $no = 0; foreach ($jabatan as $row): ?>
                  <option value="<?php echo $row->id_jabatan; ?>"><?php echo $row->jabatan; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
        <button type="submit" name="submit" value="true" class="btn btn-outline-light toastsDefaultSuccess">OK</button>
      </div>
    </div>
  </div>
</form>
</div>
<!-- /.modal -->


<!-- modal update -->
<div class="modal fade" id="update_pegawai">
  <form action="<?php echo base_url().'index.php/pegawai/update'?>" method="post">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <div class="modal-header">
          <h4 class="modal-title">Edit data pegawai</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <input type="hidden" name="id" id="id">
                  <label>NIP*:</label>
                  <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP" required="">
                  <?=form_error('nip')?>
                </div>
                <div class="form-group">
                  <label>Nama Pegawai*:</label>
                  <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama Pegawai" required="">
                  <?=form_error('nama_pegawai')?>
                </div>
                <div class="form-group">
                  <label>Pangkat*:</label>
                  <select class="form-control select2" id="pangkat" name="id_pangkat" style="width: 100%;" required="">
                    <?php foreach ($pangkat as $row): ?>
                      <option value="<?php echo $row->id_pangkat; ?>"><?php echo $row->pangkat; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jabatan*:</label>
                  <select class="form-control select2" id="jabatan" name="id_jabatan" style="width: 100%;" required="">
                    <?php foreach ($jabatan as $row): ?>
                      <option value="<?php echo $row->id_jabatan; ?>"><?php echo $row->jabatan; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
            <button type="submit" name="submit" value="true" class="btn btn-outline-dark">Simpan perubahan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </form>
  </div>