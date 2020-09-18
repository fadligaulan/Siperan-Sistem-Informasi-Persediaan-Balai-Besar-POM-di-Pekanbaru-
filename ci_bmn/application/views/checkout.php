<div class="row">
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Pesanan anda</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nomor Katalog</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($cartItems as $item) : ?>
                        <tr>
                            <td><?php echo $item["id"]; ?></td>
                            <td><?php echo $item["no_katalog"]; ?></td>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo $item["jenis_barang"]; ?></td>
                            <td><?php echo $item["qty"]; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info table-responsive">
            <div class="card-header">
                <h3 class="card-title">Silahkan isi biodata anda..!!</h3>
            </div>
            <div class="card-body">
                <form action="" id="form-data" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputStatus">Nama Pegawai*</label>
                        <?php echo $this->session->userdata('nama_pegawai'); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus">Nama Bidang*</label>
                        <select class="form-control custom-select" name="kode_bidang" required="">
                            <option value="">Pilih Bidang</option>
                            <?php foreach ($bidang as $row) : ?>
                            <option value="<?php echo $row->kode_bidang; ?>"><?php echo $row->nama_bidang; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="placeOrder" class="btn btn-info">Order barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>