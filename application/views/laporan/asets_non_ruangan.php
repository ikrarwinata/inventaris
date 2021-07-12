<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Sesuaikan Laporan&nbsp;<img src="assets/img/excel.png" style="height: 25px; width: 25px;">
				</div>
			</div>
			<div class="card-body">
				<form action="Laporan/asets_non_ruangan" method="POST">
					<div class="table-responsive">
						<div class="table">
							<table>
								<thead>
									<tr>
										<td>No.</td>
										<td>Kode Barang</td>
										<td>Nama Barang</td>
										<td>Merk / Model</td>
										<td>Tipe Assets</td>
										<td>Ukuran</td>
										<td>Bahan</td>
										<td>Tahun Pengadaan</td>
										<td>Jumlah Barang</td>
										<td>Harga Satuan</td>
										<td>Kondisi Barang</td>
										<td>Keterangan</td>
										<td>Foto Barang</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cnumb" checked="true" readonly="true" disabled="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="ckodebarang" checked="true" readonly="true" disabled="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cnamabarang" checked="true" readonly="true" disabled="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cmerk" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="ctipe" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cukuran" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cbahan" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="ctahun" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cunit" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="charga" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="ckondisi" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cketerangan" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cfoto"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<span class="btn btn-block bg-gradient-info btn-flat"><strong>Total Data : <?php echo ($total_rows==NULL)?"0":$total_rows ?></strong></span>
						</div>
						<div class="col-4">
							
						</div>
						<div class="col-4">
							<button type="submit" class="btn btn-block bg-gradient-info btn-flat" style="border-radius: 25px"><i class="fa fa-download"></i>&nbsp;Buat Laporan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>