<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action=""  id="form-data" method="post" enctype="multipart/form-data">
             <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Nomor Katalog*:</label>
                  <input type="hidden" name="kode_barang" value="<?php echo $barang->kode_barang; ?>" class="form-control" placeholder="Kode Barang" readonly="">
                  <input type="text" name="no_katalog" value="<?php echo $barang->no_katalog; ?>" class="form-control" placeholder="Nomor Katalog">
                </div>
                <div class="form-group">
                  <label>Nama barang*:</label>
                  <input type="text" name="nama_barang" value="<?php echo $barang->nama_barang; ?>" class="form-control" placeholder="Nama barang" required="">
                </div>
                <div class="form-group">
                  <label>Jenis barang*:</label>
                  <select name="jenis_barang" class="form-control select2" style="width: 100%;" required="">
                    <option value="<?php echo $barang->jenis_barang; ?>"><?php echo $barang->jenis_barang; ?></option>
                    <option value="Penunjang">Penunjang</option>
                    <option value="Suku cadang">Suku cadang</option>
                    <option value="Glassware">Glassware</option>
                    <option value="Media">Media</option>
                    <option value="ATK">ATK</option>
                    <option value="Reagen">Reagen</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Nomor gudang*:</label>
                  <input type="text" name="no_gudang" value="<?php echo $barang->no_gudang; ?>" class="form-control" placeholder="Nomor gudang" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="hidden" name="foto_lama" value="<?php echo $barang->foto_barang; ?>" class="form-control" placeholder="Nomor gudang" readonly="">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="foto_barang" class="custom-file-input">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" value="true" class="btn btn-info">Simpan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
  </div>