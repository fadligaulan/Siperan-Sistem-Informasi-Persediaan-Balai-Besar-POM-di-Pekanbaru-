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
                  <input type="hidden" name="kode_barang" class="form-control" required="">
                  <input type="text" name="no_katalog" class="form-control" placeholder="Nomor katalog">
                </div>
                <div class="form-group">
                  <label>Nama barang*:</label>
                  <input type="text" name="nama_barang" class="form-control" placeholder="Nama barang" required="">
                </div>
                <div class="form-group">
                  <label>Jenis barang*:</label>
                  <select name="jenis_barang" class="form-control select2" data-placeholder="Jenis Barang" style="width: 100%;" required="">
                    <option value="">--Jenis barang--</option>
                    <option value="Reagen">Reagen</option>
                    <option value="Penunjang">Penunjang</option>
                    <option value="Suku cadang">Suku cadang</option>
                    <option value="Glassware">Glassware</option>
                    <option value="Media">Media</option>
                    <option value="ATK">ATK</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Nomor gudang*:</label>
                  <input type="text" name="no_gudang" class="form-control" placeholder="Nomor gudang" required="">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Foto barang</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="foto_barang" class="custom-file-input" required="">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Upload</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" value="true" class="btn btn-info">Tambah Barang</button>
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