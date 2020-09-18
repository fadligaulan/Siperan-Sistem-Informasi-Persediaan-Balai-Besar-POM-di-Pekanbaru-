
<table width="100%">
  <tr>
    <td width=100 align="left"><strong>BADAN PENGAWAS OBAT DAN MAKANAN R.I<br>BALAI BESAR POM DI PEKANBARU</strong></td>             
  </tr>
</table>
<table width="100%">
  <tr>
    <td width=100 align="center"><strong><u><font style=font-size:14pt face="bookman" color=#000000>Kartu Kendali</font></u></strong></td>             
  </tr>
</table>
<table width="100%">
  <tr>
    <td width=100 align="left"> Nama Barang&nbsp;&nbsp;: <?php echo $laporan['nama_barang']; ?><br>Kode Barang&nbsp;&nbsp;&nbsp;: <?php echo $laporan['no_katalog']; ?><br>Satuan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $laporan['satuan']; ?> <br>Lokasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Gudang BBPOM di Pekanbaru <br></td>
      <td width=100 align="right"> Nomor Gudang : <?php echo $laporan['no_gudang']; ?> <br></td>             
    </tr>
  </table>  
  <table blaporan=0 cellspacing=0 cellpadding=0 width="100%" >
    <tr height=25 >
      <!-- <td valign="top" width="21%" align=left  bgcolor=#ffffff ><b><font style=font-size:10pt face="bookman" color=#000000>Kepada:</font></b></td> -->
      <td>
        <table width="100%" class="table1" border=1 cellspacing=1 cellpadding=1>
          <thead>
            <tr>
              <th rowspan="2" align="center">No</th>
              <th rowspan="2" align="center">Nomor Bukti</th>
              <th rowspan="2" align="center">Tanggal</th>
              <th rowspan="2" align="center">Asal/<br>Distribusi</th>
              <th colspan="2">Mutasi</th>
              <th rowspan="2" align="center">Saldo</th>
            </tr>
            <tr>
              <th>Masuk</th>
              <th>Keluar</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 0; foreach($laporan['items'] as $item): ?>
            <tr>
              <td><?php echo ++$no; ?></td>
              <td><?php echo $item["no_registrasi"]; ?></td>
              <td><?php echo tgl_indo($item["tanggal"]); ?></td>
              <td><?php echo $item["asal_distribusi"]; ?></td>
              <td><center><?php echo $item["stock_in"]; ?></center></td>
              <td><center><?php echo $item["stock_out"]; ?></center></td>
              <td><center><?php echo $item["stock_barang"]; ?></center></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </td>
  </tr>
</table>
<br>


