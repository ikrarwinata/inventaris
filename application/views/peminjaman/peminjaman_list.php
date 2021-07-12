	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-lg-4">
					<a href="Peminjaman/create" class="btn btn-block bg-gradient-info btn-flat col-sm-9" style="border-radius: 8px"><i class="fa fa-plus"></i>&nbsp;Peminjaman Barang</a>
				</div>
				<div class="col-lg-4">
					<?php echo $this->session->userdata("message") ?>
				</div>
				<div class="col-lg-4">
					
				</div>
			</div>
			<hr>
			<div class="card">
				<div class="card-header">
	              <h3 class="card-title">Data Barang</h3>
	            </div>

	            <div class="card-body">
	              <div class="table-responsive">
	              	<div class="table">
		              	<table id="datatab1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th class="center" width="50">No.</th>
			                  <th>Kode Peminjaman</th>
			                  <th>Username</th>
			                  <th>Kode Barang / Nama Barang</th>
			                  <th>Tanggal Pinjman</th>
			                  <th>Tanggal Kembali</th>
			                  <th>Status</th>
			                  <th width="140" class="center text-center" style="min-width: 100px"></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php $counter = 1; ?>
			                <?php foreach ($peminjaman_data as $value): ?>
			                	<tr>
				                  <td class="center text-center"><?php echo $counter++ ?></td>
				                  <td><?php echo $value->idpeminjaman ?></td>
				                  <td><?php echo $value->username ?></td>
				                  <td><?php echo $value->kodeasets." | ".$value->namabarang ?></td>
				                  <td><?php echo date("d-m-Y", $value->tanggalpinjam) ?></td>
				                  <td><?php echo date("d-m-Y", $value->tanggalkembali) ?></td>
				                  <td>
				                  	<a href="Mutasi/read/<?php echo $value->idpeminjaman ?>" title="Batalkan Peminjaman"><i class="fa fa-search text-success"></i></a>
				                  	|
				                  	<a href="Mutasi/delete/<?php echo $value->idpeminjaman ?>" title="Tandai Telah Kembali" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
				                  	<a href="Mutasi/delete/<?php echo $value->idpeminjaman ?>" title="Hapus data" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
				                  </td>
				                </tr>
			                <?php endforeach ?>
			                <?php foreach ($peminjaman_ruangan_data as $value): ?>
			                	<tr>
				                  <td class="center text-center"><?php echo $counter++ ?></td>
				                  <td><?php echo $value->idpeminjaman ?></td>
				                  <td><?php echo $value->username ?></td>
				                  <td><a href="Asets/read/<?php echo $value->kodeasets ?>"><?php echo $value->kodeasets." | ".$value->namabarang ?></a></td>
				                  <td><?php echo date("d-m-Y", $value->tanggalpinjam) ?></td>
				                  <td><?php echo date("d-m-Y", $value->tanggalkembali) ?></td>
				                  <td><?php echo $value->status ?></td>
				                  <td>
				                  	<?php if ($value->status!="Dibatalkan"): ?>
				                  		<a href="Peminjaman/cancel_item/<?php echo ($value->kodeasets) ?>" title="Batalkan Peminjaman"><i class="fa fa-reply text-warning"></i></a>
					                  	|
				                  	<?php endif ?>
				                  	<?php if ($value->status!="Sudah Kembali"): ?>
					                  	<a href="Peminjaman/return_item/<?php echo ($value->kodeasets) ?>" title="Tandai Telah Kembali"><i class="fa fa-check text-success"></i></a>
				                  		|
				                  	<?php endif ?>
				                  	<a href="Peminjaman/delete/<?php echo ($value->kodeasets) ?>" title="Hapus data" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
				                  </td>
				                </tr>
			                <?php endforeach ?>
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th class="center" width="50">No.</th>
			                  <th>Kode Peminjaman</th>
			                  <th>Username</th>
			                  <th>Kode Barang / Nama Barang</th>
			                  <th>Tanggal Pinjman</th>
			                  <th>Tanggal Kembali</th>
			                  <th>Status</th>
			                  <th width="140" class="center text-center" style="min-width: 100px"></th>
			                </tr>
			                </tfoot>
			              </table>
		            </div>
	              </div>
	            </div>
			</div>
		</div>
	</div>