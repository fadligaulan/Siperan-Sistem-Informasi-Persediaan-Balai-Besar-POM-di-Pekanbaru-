<?php if ($this->session->userdata('status') === 'user') : ?>
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah Barang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                    foreach ($daftar_order as $row) : ?>
                <?php
                        if ($row->pengajuan == 'Y') {
                            $ketwarna = 'Diterima';
                            $warna = 'btn btn-success btn-sm';
                            $print = '<a href="daftar_order/cetak_spb/' . $row->order_id . '" class="btn btn-success btn-sm"><i class="fas fa-download">Download file</i></a>';
                        } else if ($row->pengajuan == 'T') {
                            $ketwarna = 'Tolak';
                            $warna = 'btn btn-danger btn-sm';
                            $print = '<button class="btn btn-success btn-sm" hidden="hidden">';
                        } else {
                            $ketwarna = 'Proses';
                            $warna = 'btn btn-warning btn-sm';
                            $print = '<button class="btn btn-success btn-sm" hidden="hidden">';
                        }
                        ?>
                <tr>
                    <td><?php echo ++$no; ?></td>
                    <td><?php echo $row->nama_bidang; ?></td>
                    <td><?php echo $row->nama_pegawai; ?></td>
                    <td><?php echo $row->quantity; ?></td>
                    <td style="text-align: center;"><span class="<?php echo $warna; ?>"><?php echo $ketwarna ?></span>
                    </td>
                    <td><a href="<?php echo site_url('daftar_order/getRecord/' . $row->order_id); ?>"
                            class="btn btn-primary btn-sm"><i class="fas fa-folder">View</i></a>
                        <a><?php echo $print ?></a>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?php endif; ?>

<?php if ($this->session->userdata('status') === 'admin' || $this->session->userdata('status') === 'super admin') : ?>
<div class="card">
    <div class="card-header table-responsive">
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah Barang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                    foreach ($daftar_order_admin as $row) : ?>
                <?php
                        if ($row->pengajuan == 'Y') {
                            $ketwarna = 'Diterima';
                            $warna = 'btn btn-success btn-sm';
                            $print = '<a href="daftar_order/cetak_spb/' . $row->order_id . '" class="btn btn-success btn-sm"><i class="fas fa-download">Download file</i></a>';
                        } else if ($row->pengajuan == 'T') {
                            $ketwarna = 'Tolak';
                            $warna = 'btn btn-danger btn-sm';
                            $print = '<a href="daftar_order/delete/' . $row->order_id . '" class="btn btn-danger btn-sm"><i class="fas fa-trash">delete</i></a>';
                        } else {
                            $ketwarna = 'Proses';
                            $warna = 'btn btn-warning btn-sm';
                            $print = '<button class="btn btn-success btn-sm" hidden="hidden">';
                        }
                        ?>
                <tr>
                    <td><?php echo ++$no; ?></td>
                    <td><?php echo $row->nama_bidang; ?></td>
                    <td><?php echo $row->nama_pegawai; ?></td>
                    <td><?php echo $row->quantity; ?></td>
                    <td style="text-align: center;"><span class="<?php echo $warna; ?>"><?php echo $ketwarna ?></span>
                    </td>
                    <td><a href="<?php echo site_url('daftar_order/getRecord/' . $row->order_id); ?>"
                            class="btn btn-primary btn-sm"><i class="fas fa-folder">View</i></a>
                        <a><?php echo $print ?></a>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?php endif; ?>