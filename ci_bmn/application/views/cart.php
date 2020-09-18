<div class="invoice p-3 mb-3">
	<div class="row">
		<div class="col-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="30%">Nama Barang</th>
						<th width="20%">Nomor Katalog</th>
						<th width="20%">Jenis Barang</th>
						<th width="20%">Nomor Gudang</th>
						<th width="20%">Jumlah Barang</th>
						<th width="12%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($cartItems as $item){	?>
					<tr>
						<td><?php echo $item["name"]; ?></td>
						<td><?php echo $item["no_katalog"]; ?></td>
						<td><?php echo $item["jenis_barang"]; ?></td>
						<td><?php echo $item["no_gudang"]; ?></td>
						<td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
						<td>
							<a href="<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash">Hapus</i></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<!-- /.col -->
	</div>
	<!-- this row will not appear when printing -->
	<div class="row no-print">
		<div class="col-12">
			<a href="<?php echo base_url('order/'); ?>" class="btn btn-success"><i class="fas fa-cart-plus"></i> Lanjut Pilih barang</a>
			<!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
			<a href="<?php echo base_url('checkout/'); ?>" class="btn btn-primary float-right">Checkout <i class="far fa-credit-card"></i></a>
			<!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
				<i class="fas fa-download"></i> Generate PDF
			</button> -->
		</div>
	</div>
</div>
