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
    <div class="card-body table-responsive">
        <div class="card-title">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-success">
                <i class="fas fa-plus">Tambah</i>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Bidang</th>
                    <th>Nama Bidang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($bidang as $row) : ?>
                <tr>
                    <td><?php echo ++$no; ?></td>
                    <td><?php echo $row->kode_bidang; ?></td>
                    <td><?php echo $row->nama_bidang; ?></td>
                    <td><a href="javascript:;" data-id="<?php echo $row->id_bidang; ?>"
                            data-kode_bidang="<?php echo $row->kode_bidang; ?>"
                            data-nama_bidang="<?php echo $row->nama_bidang; ?>" data-toggle="modal"
                            data-target="#update_bidang">
                            <button class="btn btn-warning btn-sm" data-target="#ubah" data-toggle="modal"
                                data-placement="top" title="update"><i class="fa fa-edit">Edit</i></button></a>
                        <a href="<?php echo site_url('bidang/delete/' . $row->id_bidang); ?>"
                            class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Hapus</i></a>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-success">
    <form action="<?php echo base_url() . 'index.php/bidang/insert' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah data bidang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Kode bidang*:</label>
                                <input type="text" name="kode_bidang" class="form-control" placeholder="Kode Bidang"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Nama bidang*:</label>
                                <input type="text" name="nama_bidang" class="form-control" placeholder="Nama Bidang"
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
<div class="modal fade" id="update_bidang">
    <form action="<?php echo base_url() . 'index.php/bidang/update' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h4 class="modal-title">Edit data bidang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label>Kode bidang*:</label>
                                <input type="text" name="kode_bidang" id="kode" class="form-control"
                                    placeholder="Kode Bidang" required="">
                            </div>
                            <div class="form-group">
                                <label>Nama bidang*:</label>
                                <input type="text" name="nama_bidang" id="nama" class="form-control"
                                    placeholder="Nama bidang" required="">
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
        </div>
    </form>
</div>