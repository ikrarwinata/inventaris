<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					Laporan @ Ruangan&nbsp;<img src="assets/img/excel.png" style="height: 25px; width: 25px;">
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div class="table">
						<table width="100%">
							<thead>
								<tr>
									<td>No.</td>
									<td>Nama Ruangan</td>
									<td>Lokasi</td>
									<td>Keterangan</td>
									<td>Unit Assets</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<?php $number = 1; ?>
								<?php foreach ($ruangan_data as $value): ?>
									<tr>
										<td><?php echo $number++ ?></td>
										<td><?php echo $value->nama_ruangan ?></td>
										<td><?php echo $value->lokasi ?></td>
										<td><?php echo $value->keterangan ?></td>
										<td><?php echo $value->total_barang ?></td>
										<td>
											<?php if ($value->total_barang != NULL && $value->total_barang >= 1): ?>
												<a href="Laporan/asets_ruangan/<?php echo $value->id ?>" class="btn btn-block bg-gradient-info btn-flat"><i class="fa fa-forward"></i>&nbsp;Buat Laporan</a>
											<?php endif ?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						
					</div>
					<div class="col-4">
						
					</div>
					<div class="col-4">
						<a href="Laporan/asets_ruangan_all" type="submit" class="btn btn-block bg-gradient-info btn-flat" style="border-radius: 25px"><i class="fa fa-download"></i>&nbsp;Buat Laporan Semua Ruangan</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>