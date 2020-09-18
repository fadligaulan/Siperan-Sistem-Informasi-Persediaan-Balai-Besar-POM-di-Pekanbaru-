  <div class="row">
    <div class="col-md-3 col-sm-6 col-12">
      <form action="<?php echo base_url().'index.php/laporan/print_periode'?>" method="post">
        <div class="form-group">
          <label>Start Date*:</label>
          <input type="date" name="tanggal1"  class="form-control" placeholder="Start Date" required="">
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="form-group">
          <label>End Date*:</label>
          <input type="date" name="tanggal2"  class="form-control" placeholder="Start Date" required="">
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="form-group">
          <label>Nama Barang*:</label>
          <input type="text" name="nama_barang"  class="form-control" placeholder="Nama Barang" required="">
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Seacrh:</label><br>
              <button type="submit" class="btn btn-sm btn-primary" name="submit"><span class="fa fa-print">Print Out</span></button>
            </div>
          </div>
        </form> 
        <div class="col-md-4">
          <div class="form-group right">
            <label>Refresh:</label><br>
            <a href="<?php echo base_url().'index.php/laporan'?>"><button  class="btn btn-sm btn-success">Refresh</button></a>
          </div>
        </div>
        <div class="col-md-4">
          <!--<div class="form-group right">-->
          <!--  <label>Print:</label><br>-->
          <!--  <button class="btn btn-sm btn-info" onclick="btnPrint()"><span class="fa fa-print">Print Out</span></button>-->
          <!--</div>-->
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Tanggal</th>
            <th>Nomor Gudang</th>
            <th>Nomor Bukti</th>
            <th>Asal/Distribusi</th>
            <th>Barang Masuk</th>
            <th>Barang Keluar</th>
            <th>Stock</th>
            
          </tr>
        </thead>
        <tbody>
         <?php $no = 0; foreach($laporan as $row): ?>
         <tr>
          <td><?php echo ++$no; ?></td>
          <td><?php echo $row->nama_barang; ?></td>
          <td><?php echo $row->date_time; ?></td>
          <td><?php echo $row->no_gudang; ?></td>
          <td><?php echo $row->no_registrasi; ?></td>
          <td><?php echo $row->asal_distribusi; ?></td>
          <td><?php echo $row->stock_in; ?></td>
          <td><?php echo $row->stock_out; ?></td>
          <td><?php echo $row->stock_barang; ?></td>
        <?php endforeach; ?>
      </tr>
    </tbody>
  </table>
</div>
<!-- /.card-body -->
</div>
<script>
  function btnPrint(){
    var divToPrint  = document.getElementById('example2');
    var popupWin    = window.open('', '_blank', 'width=700, height=500');
    popupWin.document.open();
    popupWin.document.write('<html>\n\
      <head>\n\
      </head>\n\n\
      <body onload="window.print()">\n\
      <h2 align="center">Kartu Kendali</h2>\n\
      <table align="center" border="1" style="border-collapse: collapse;">\n\
      '+ divToPrint.innerHTML +'\n\
      </table>\n\
      </body>\n\
      </html>');
    popupWin.document.close();

  }
</script>





