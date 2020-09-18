<div class="card">
    <div class="card-header">
        <?php if ($message = $this->session->flashdata('message')) : ?>
        <div class="alert alert-dismissible alert-<?php echo ($message['status']) ? 'success' : 'danger'; ?>">
            <?php echo $message['message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
    </div>
    <!-- /.card-header -->
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
                    <th>Pangkat</th>
                    <th>Golongan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pangkat as $row) : ?>
                <tr>
                    <td><?php echo ++$no; ?></td>
                    <td><?php echo $row->pangkat; ?></td>
                    <td><?php echo $row->golongan; ?></td>
                    <td><a href="javascript:;" data-id="<?php echo $row->id_pangkat; ?>"
                            data-pangkat="<?php echo $row->pangkat; ?>" data-golongan="<?php echo $row->golongan; ?>"
                            data-toggle="modal" data-target="#update_pangkat">
                            <button class="btn btn-warning btn-sm" data-target="#ubah" data-toggle="modal"
                                data-placement="top" title="update"><i class="fa fa-edit">Edit</i></button></a>
                        <a href="<?php echo site_url('pangkat/delete/' . $row->id_pangkat); ?>"
                            class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Hapus</i></a>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<!-- modal insert -->
<div class="modal fade" id="modal-success">
    <form action="<?php echo base_url() . 'index.php/pangkat/insert' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah data pangkat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Pangkat*:</label>
                                <input type="text" name="pangkat" class="form-control" placeholder="Pangkat"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Golongan*:</label>
                                <input type="text" name="golongan" class="form-control" placeholder="Pangkat"
                                    required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="submit" value="true" class="btn btn-outline-light">OK</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.modal -->


<!-- modal update -->
<div class="modal fade" id="update_pangkat">
    <form action="<?php echo base_url() . 'index.php/pangkat/update' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h4 class="modal-title">Update data pangkat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group <?= form_error('pangkat') ? 'has-error' : null ?>">
                                <input type="hidden" name="id" id="id">
                                <label>Pangkat*:</label>
                                <input type="text" name="pangkat" id="pangkat" class="form-control"
                                    placeholder="Pangkat" required="">
                                <?= form_error('pangkat') ?>
                            </div>
                            <div class="form-group <?= form_error('golongan') ? 'has-error' : null ?>">
                                <label>Golongan*:</label>
                                <input type="text" name="golongan" id="golongan" class="form-control"
                                    placeholder="Golongan" required="">
                                <?= form_error('golongan') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="submit" value="true" class="btn btn-outline-dark">Simpan
                        perubahan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>