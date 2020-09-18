<div class="card">
  <!-- /.card-header -->
  <div class="card-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor Katalog</th>
          <th>Nama Barang</th>
          <th>Nomor Gudang</th>
          <th>Stock barang</th>
          <th>Satuan</th>
          <th>Tanggal Kadaluarsa</th>
        </tr>
      </thead>
      <tbody>
       <?php $no = 0; foreach($stock_barang as $row): ?>
       <tr>
        <td><?php echo ++$no; ?></td>
        <td><?php echo $row->no_katalog; ?></td>
        <td><?php echo $row->nama_barang; ?></td>
        <td><?php echo $row->no_gudang; ?></td>
        <td><?php echo $row->current_stock; ?></td>
        <td><?php echo $row->satuan ?></td>
        <td><?php echo tgl_indo($row->tgl_kadaluarsa); ?></td>
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>
</div>
</div>





