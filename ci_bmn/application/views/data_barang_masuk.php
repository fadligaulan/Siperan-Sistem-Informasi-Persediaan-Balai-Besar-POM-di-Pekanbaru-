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
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-barang_masuk">
                <i class="fas fa-plus">Tambah</i></button>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Bukti</th>
                    <th>Nama Barang</th>
                    <th>No Gudang</th>
                    <th>Nama Supplier</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($barang_masuk as $row) : ?>
                <tr>
                    <td width="3%"><?php echo ++$no; ?></td>
                    <td width="10%"><?php echo $row->no_bukti; ?></td>
                    <td width="10%"><?php echo $row->nama_barang; ?></td>
                    <td width="5%"><?php echo $row->no_gudang; ?></td>
                    <td width="10%"><?php echo $row->nama_supplier; ?></td>
                    <td width="5%"><?php echo $row->jumlah_barang_masuk; ?></td>
                    <td width="10%"><?php echo tgl_indo($row->tgl_masuk); ?></td>
                    <td width="10%"><?php echo tgl_indo($row->tgl_kadaluarsa); ?></td>
                    <td width="10%"><?php echo $row->satuan; ?></td>
                    <td width="10%"><?php echo $row->keterangan ?></td>
                    <td width="15%"><a href="javascript:;" data-id="<?php echo $row->id_barang_masuk; ?>"
                            data-no_bukti="<?php echo $row->no_bukti; ?>"
                            data-kode_barang="<?php echo $row->kode_barang; ?>"
                            data-nama_supplier="<?php echo $row->nama_supplier; ?>"
                            data-jumlah_barang_masuk="<?php echo $row->jumlah_barang_masuk; ?>"
                            data-jumlah_barang_lama="<?php echo $row->jumlah_barang_masuk; ?>"
                            data-tgl_masuk="<?php echo $row->tgl_masuk; ?>"
                            data-tgl_kadaluarsa="<?php echo $row->tgl_kadaluarsa; ?>"
                            data-satuan="<?php echo $row->satuan; ?>" data-keterangan="<?php echo $row->keterangan; ?>"
                            data-toggle="modal" data-target="#update_barang_masuk">
                            <button class="btn btn-warning btn-sm" data-target="#ubah" data-toggle="modal"
                                data-placement="top" title="update"><i class="fa fa-edit">Edit</i></button></a>
                        <a href="<?php echo site_url('barang_masuk/delete/' . $row->id_barang_masuk); ?>"
                            class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Hapus</i></a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- modal insert -->
<div class="modal fade modal-action" id="modal-barang_masuk">
    <form action="<?php echo base_url() . 'index.php/barang_masuk/insert' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah barang masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nomor Bukti*:</label>
                                <input type="text" name="no_bukti" class="form-control" placeholder="Nomor Bukti"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Nama barang*:</label>
                                <select class="form-control select2" name="kode_barang" style="width: 100%;"
                                    required="">
                                    <option value="">--Pilih barang--</option>
                                    <?php foreach ($barang as $row) : ?>
                                    <option value="<?php echo $row->kode_barang; ?>"><?php echo $row->nama_barang; ?> |
                                        <?php echo $row->no_katalog; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Asal Distribusi*:</label>
                                <input type="text" name="nama_supplier" class="form-control"
                                    placeholder="Asal Distribusi" required="">
                            </div>
                            <div class="form-group">
                                <label>Jumlah barang*:</label>
                                <input type="text" name="jumlah_barang_masuk" class="form-control"
                                    placeholder="Jumlah barang" required="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal masuk*:</label>
                                <input type="date" name="tgl_masuk" class="form-control" placeholder="Tanggal masuk"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kadaluarsa*</label>
                                <input type="date" name="tgl_kadaluarsa" class="form-control"
                                    placeholder="Tanggal kadaluarsa">
                            </div>
                            <div class="form-group">
                                <label>Satuan*:</label>
                                <input type="text" name="satuan" class="form-control" placeholder="Satuan" required="">
                            </div>
                            <div class="form-group">
                                <label>Keterangan*:</label>
                                <input type="text" name="keterangan" class="form-control" placeholder="Keterangan"
                                    required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="true" class="btn btn-outline-light"><i
                            class="fas fa-plus">Tambah barang</i></button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.modal -->


<!-- modal update -->
<div class="modal fade" id="update_barang_masuk">
    <form action="<?php echo base_url() . 'index.php/barang_masuk/update' ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h4 class="modal-title">Update data barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" class="form-control">
                                <label>Nomor Bukti*:</label>
                                <input type="text" name="no_bukti" id="no_bukti" class="form-control"
                                    placeholder="Nomor Bukti">
                            </div>
                            <div class="form-group">
                                <label>Nama barang*:</label>
                                <select class="form-control select2" id="barang" name="kode_barang"
                                    style="width: 100%;">
                                    <?php foreach ($barang as $row) : ?>
                                    <option value="<?php echo $row->kode_barang; ?>"><?php echo $row->nama_barang; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama supplier*:</label>
                                <input type="text" name="nama_supplier" id="supplier" class="form-control"
                                    placeholder="Asal Distribusi">
                            </div>
                            <div class="form-group">
                                <label>Jumlah barang*:</label>
                                <input type="text" name="jumlah_barang_masuk" id="jumlah_barang_masuk"
                                    class="form-control" placeholder="Jumlah barang">
                                <input type="hidden" name="jumlah_barang_lama" id="jumlah_barang_lama"
                                    class="form-control" placeholder="Jumlah barang" readonly="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal masuk*:</label>
                                <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control"
                                    placeholder="Tanggal Masuk">
                            </div>
                            <div class="form-group">
                                <label>Tanggal kadaluarsa*</label>
                                <input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control"
                                    placeholder="Tanggal Masuk">
                            </div>
                            <div class="form-group">
                                <label>Satuan*:</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan">
                            </div>
                            <div class="form-group">
                                <label>Keterangan*:</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control"
                                    placeholder="Keterangan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="true" class="btn btn-outline-dark">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>