	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-lg-4">
					<a href="Asets/create" class="btn btn-block bg-gradient-success btn-flat col-sm-9" style="border-radius: 8px">Tambah Barang</a>
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
			                  <th>Ruangan</th>
			                  <th>Kode Barang</th>
			                  <th>Nama Barang</th>
			                  <th>Merk</th>
			                  <th>Jenis</th>
			                  <th>Ukuran</th>
			                  <th width="40">Unit</th>
			                  <th width="140" class="center text-center" style="min-width: 139px"></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php $counter = 1; ?>
			                <?php foreach ($asets_data as $value): ?>
			                	<tr>
				                  <td class="center text-center"><?php echo $counter++ ?></td>
				                  <td class="ruangan-block" style="vertical-align: middle;"><?php echo $value->nama_ruangan ?></td>
				                  <td><?php echo $value->kodebarang ?></td>
				                  <td><?php echo $value->namabarang ?></td>
				                  <td><?php echo $value->merk ?></td>
				                  <td><?php echo $value->tipe ?></td>
				                  <td><?php echo $value->ukuran ?></td>
				                  <td class="center text-center"><?php echo $value->unit ?></td>
				                  <td>
				                  	<a href="Asets/read/<?php echo $value->kodebarang ?>" title="Lihat detail"><i class="fa fa-search text-success"></i></a>
				                  	|
				                  	<a href="Asets/update/<?php echo $value->kodebarang ?>" title="Ubah data"><i class="fa fa-edit"></i></a>
				                  	|
				                  	<a href="Asets/delete/<?php echo $value->kodebarang ?>" title="Hapus data" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
				                  	|
				                  	<a href="Mutasi/asets/<?php echo $value->kodebarang ?>" title="Mutasi"><i class="fa fa-flag text-warning"></i></a>
				                  </td>
				                </tr>
			                <?php endforeach ?>
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th class="center">No.</th>
			                  <th>Ruangan</th>
			                  <th>Kode Barang</th>
			                  <th>Nama Barang</th>
			                  <th>Merk</th>
			                  <th>Jenis</th>
			                  <th>Ukuran</th>
			                  <th width="40">Unit</th>
			                  <th width="140" class="center text-center" style="min-width: 139px"></th>
			                </tr>
			                </tfoot>
			              </table>
		            </div>
	              </div>
	            </div>
			</div>
		</div>
	</div>