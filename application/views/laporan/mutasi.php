<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Sesuaikan Laporan&nbsp;<img src="assets/img/excel.png" style="height: 25px; width: 25px;">
				</div>
			</div>
			<div class="card-body">
				<form action="Laporan/mutasi" method="POST">
					<div class="table-responsive">
						<div class="table">
							<table width="100%">
								<thead>
									<tr>
										<td class="center text-center border" rowspan="2">No.</td>
										<td class="center text-center border" colspan="3">Sebelum Mutasi</td>
										<td class="center text-center border" colspan="3">Sesudah Mutasi</td>
										<td class="center text-center border" rowspan="2">Tanggal</td>
										<td class="center text-center border" rowspan="2">Akun Posting</td>
										<td class="center text-center border" rowspan="2">Keterangan</td>
										<td class="center text-center border" rowspan="2">Detail Barang</td>
									</tr>
									<tr>

										<td class="center text-center border">Kode Barang</td>
										<td class="center text-center border">Kode Ruangan</td>
										<td class="center text-center border">Nama Ruangan</td>
										<td class="center text-center border">Kode Barang</td>
										<td class="center text-center border">Kode Ruangan</td>
										<td class="center text-center border">Nama Ruangan</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="center text-center border"><input type="checkbox" class="form-control" value="TRUE" name="cnumb" checked="true" readonly="true" disabled="true"></td>
										<td class="center text-center border" colspan="3"><input type="checkbox" class="form-control" value="TRUE" name="csebelum" checked="true" readonly="true" disabled="true"></td>
										<td class="center text-center border" colspan="3"><input type="checkbox" class="form-control" value="TRUE" name="csesudah" checked="true" readonly="true" disabled="true"></td>
										<td class="center text-center border"><input type="checkbox" class="form-control" value="TRUE" name="ctanggal" checked="true"></td>
										<td class="center text-center border"><input type="checkbox" class="form-control" value="TRUE" name="cakun" checked="true"></td>
										<td class="center text-center border"><input type="checkbox" class="form-control" value="TRUE" name="cketerangan" checked="true"></td>
										<td class="center text-center border"><input type="checkbox" class="form-control" value="TRUE" name="cdetail"></td>
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