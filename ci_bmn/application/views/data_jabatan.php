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
    <div class="card-body">
        <div class="card-title">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-success">
                <i class="fas fa-plus">Tambah</i></button>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($jabatan as $row) : ?>
                <tr>
                    <td><?php echo ++$no; ?></td>
                    <td><?php echo $row->jabatan; ?></td>
                    <td><a href="javascript:;" data-id="<?php echo $row->id_jabatan; ?>"
                            data-jabatan="<?php echo $row->jabatan; ?>" data-toggle="modal"
                            data-target="#update_jabatan">
                            <button class="btn btn-warning btn-sm" data-target="#ubah" data-toggle="modal"
                                data-placement="top" title="update"><i class="fa fa-edit">Hapus</i></button></a>
                        <a href="<?php echo site_url('jabatan/delete/' . $row->id_jabatan); ?>"
                            class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Edit</i></a>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
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
    <form action="<?php echo base_url() . 'index.php/jabatan/insert' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Add data jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group <?= form_error('jabatan') ? 'has-error' : null ?>">
                                <label>Jabatan*:</label>
                                <input type="text" name="jabatan" value="<?= set_value('jabatan') ?>"
                                    class="form-control" placeholder="Jabatan">
                                <?= form_error('jabatan') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="true" class="btn btn-outline-light">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<!-- /.modal -->


<!-- modal update -->
<div class="modal fade" id="update_jabatan">
    <form action="<?php echo base_url() . 'index.php/jabatan/update' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h4 class="modal-title">Update data jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group <?= form_error('jabatan') ? 'has-error' : null ?>">
                                <input type="hidden" name="id" id="id">
                                <label>Jabatan*:</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                    placeholder="Jabatan">
                                <?= form_error('jabatan') ?>
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