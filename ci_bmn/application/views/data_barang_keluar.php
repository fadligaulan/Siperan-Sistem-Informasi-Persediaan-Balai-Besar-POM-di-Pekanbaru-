<div class="card">
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Nama Pemesan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Permintaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($barang_keluar as $row) : ?>
                <tr>
                    <td><?php echo ++$no; ?></td>
                    <td><?php echo $row->nama_bidang; ?></td>
                    <td><?php echo $row->nama_pegawai; ?></td>
                    <td><?php echo $row->nama_barang; ?></td>
                    <td><?php echo $row->quantity; ?></td>
                    <td><?php echo tgl_indo($row->date); ?></td>
                    <td><a href="<?php echo site_url('barang_keluar/getRecord/' . $row->order_id); ?>"
                            class="btn btn-primary btn-sm"><i class="fas fa-folder">View</i></a>
                        <a href="<?php echo site_url('barang_keluar/cetak_sbbk/' . $row->order_id); ?>"
                            class="btn btn-success btn-sm"><i class="fas fa-download">Generat PDF</i></a>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>