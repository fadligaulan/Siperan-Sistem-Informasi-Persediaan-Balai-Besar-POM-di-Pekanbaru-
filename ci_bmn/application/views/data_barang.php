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
            <a href="<?php echo site_url('barang/insert/'); ?>" class="btn btn-info btn-sm"><i
                    class="fa fa-plus">Tambah</i></a>
        </div>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <center>No</center>
                    </th>
                    <th>
                        <center>Nomor Katalog</center>
                    </th>
                    <th>
                        <center>Nama Barang</center>
                    </th>
                    <th>
                        <center>Jenis Barang</center>
                    </th>
                    <th>
                        <center>Nomor Gudang</center>
                    </th>
                    <th>
                        <center>Foto</center>
                    </th>
                    <th>
                        <center>Aksi</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($barang as $row) : ?>
                <tr>
                    <td width="3%"><?php echo ++$no; ?></td>
                    <td width="10%"><?php echo $row->no_katalog; ?></td>
                    <td width="20%"><?php echo $row->nama_barang; ?></td>
                    <td width="10%"><?php echo $row->jenis_barang; ?></td>
                    <td width="10%"><?php echo $row->no_gudang; ?></td>
                    <td width="20%">
                        <center><img src="<?php echo base_url('assets/images/foto/' . $row->foto_barang) ?>"
                                width="100px"></center>
                    </td>
                    <td>
                        <center>
                            <a href="<?php echo site_url('barang/update/' . $row->kode_barang); ?>"
                                class="btn btn-warning btn-sm"><i class="fa fa-edit">Edit</i></a>
                            <a href="<?php echo site_url('barang/delete/' . $row->kode_barang); ?>"
                                class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash">Delete</i></a>
                        </center>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>