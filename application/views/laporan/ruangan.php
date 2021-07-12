<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Sesuaikan Laporan&nbsp;<img src="assets/img/excel.png" style="height: 25px; width: 25px;">
				</div>
			</div>
			<div class="card-body">
				<form action="Laporan/ruangan" method="POST">
					<div class="table-responsive">
						<div class="table">
							<table width="100%">
								<thead>
									<tr>
										<td class="center text-center">No.</td>
										<td class="center text-center">Kode Ruangan</td>
										<td class="center text-center">Nama Ruangan</td>
										<td class="center text-center">Lokasi</td>
										<td class="center text-center">Total Unit</td>
										<td class="center text-center">Total Nilai</td>
										<td class="center text-center">Keterangan Ruangan</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cnumb" checked="true" readonly="true" disabled="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="ckoderuangan" checked="true" readonly="true" disabled="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cnama_ruangan" checked="true" readonly="true" disabled="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="clokasi" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cunit" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cnilai" checked="true"></td>
										<td><input type="checkbox" class="form-control" value="TRUE" name="cketerangan" checked="true"></td>
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