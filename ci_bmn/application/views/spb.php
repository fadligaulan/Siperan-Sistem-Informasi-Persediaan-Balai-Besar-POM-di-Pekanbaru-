<div class="invoice p-3 mb-3">
    <div class="row">
        <div class="col-12">
            <h5>
                <div class="float-left"><strong>BADAN PENGAWAS OBAT DAN MAKANAN R.I<br>BALAI BESAR POM DI
                        PEKANBARU</strong></div>
            </h5>
        </div>
    </div>
    <div class="col-md-12">
        <center><strong><u>SURAT PERMINTAAN BARANG
                    (SPB)</u></strong><br>Nomor:<?php echo str_pad($order['no_order'], 2, '0', STR_PAD_LEFT); ?>/SPB/<?php echo $order['kode_bidang']; ?>/<?php echo $order['bulan']; ?>/<?php echo $order['tahun']; ?>
        </center>
    </div>
    <div class="row invoice-info">
        <div class="col-md-6 offset-5">
            <address>
                Bidang: <?php echo $order['nama_bidang']; ?><br>
                Tgl. SPB: <?php echo tgl_indo($order['date']); ?><br>
            </address>
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>No Gudang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
          foreach ($order['items'] as $item) : ?>
                    <tr>
                        <td><?php echo ++$no; ?></td>
                        <td><?php echo $item["nama_barang"]; ?></td>
                        <td><?php echo $item["jenis_barang"]; ?></td>
                        <td><?php echo $item["satuan"]; ?></td>
                        <td><?php echo $item["quantity"]; ?></td>
                        <td><?php echo $item["no_gudang"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <table border=0 cellspacing=0 cellpadding=0 width="100%">
        <tr height=25>
            <td width="30" valign="top" width="20%" align=left bgcolor=#ffffff>
                <font style=font-size:12pt face="bookman" color=#000000>
                    <center>Diserahkan Oleh<br>Pengurus Gudang<br></center>
                </font>
            </td>
            <td width="30" valign="top" width="20%" align=left bgcolor=#ffffff>
                <font style=font-size:12pt face="bookman" color=#000000>
                    <center>Menyetujui</center>
                </font>
            </td>
            <td width="30" valign="top" width="20%" align=left bgcolor=#ffffff>
                <font style=font-size:12pt face="bookman" color=#000000>
                    <center>Yang Meminta</center>
                </font>
            </td>
        </tr>
        <tr height=25>
            <td>
                <center><img src="<?php echo base_url('assets/images/ttd/' . $order['ttd_atasan1']) ?>" width="100px">
                </center>
            </td>
            <td>
                <center><img src="<?php echo base_url('assets/images/ttd/' . $order['ttd_atasan2']) ?>" width="100px">
                </center>
            </td>
            <td>
                <center><img src="<?php echo base_url('assets/images/ttd/' . $order['ttd_user']) ?>" width="100px">
                </center>
            </td>
        </tr>
        <tr height=25>
            <td width="30" valign="top" width="20%" align=left bgcolor=#ffffff>
                <font style=font-size:12pt face="bookman" color=#000000>
                    <center>Putri Harmidola Elga, A.Md<br>NIP.19951127 201903 2 004</center>
                </font>
            </td>
            <td width="30" valign="top" width="20%" align=left bgcolor=#ffffff>
                <font style=font-size:12pt face="bookman" color=#000000>
                    <center>Ratna Nuraini, S.Farm, Apt<br>NIP.19850729 201212 2002</center>
                </font>
            </td>
            <td width="30" valign="top" width="20%" align=left bgcolor=#ffffff>
                <font style=font-size:12pt face="bookman" color=#000000>
                    <center><?php echo $order['nama_pegawai']; ?><br><?php echo $order['nip']; ?></center>
                </font>
            </td>
        </tr>
    </table>