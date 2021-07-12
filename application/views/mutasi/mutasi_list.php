	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-lg-4">
					<a href="Mutasi/create" class="btn btn-block bg-gradient-info btn-flat col-sm-9" style="border-radius: 8px"><i class="fa fa-plus"></i>&nbsp;Mutasi Barang</a>
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
			                  <th>Tanggal</th>
			                  <th>Kode Barang Lama</th>
			                  <th>Kode Barang Baru</th>
			                  <th>Nama Barang</th>
			                  <th>Ruangan Lama</th>
			                  <th>Ruangan Baru</th>
			                  <th width="140" class="center text-center" style="min-width: 100px"></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php $counter = 1; ?>
			                <?php foreach ($mutasi_view_data as $value): ?>
			                	<tr>
				                  <td class="center text-center"><?php echo $counter++ ?></td>
				                  <td><?php echo $value->tanggal ?></td>
				                  <td><?php echo $value->kodebarang_lama ?></td>
				                  <td><?php echo $value->kodebarang_baru ?></td>
				                  <td><?php echo $value->namabarang ?></td>
				                  <td><?php echo $value->ruangan_lama ?></td>
				                  <td><?php echo $value->ruangan_baru ?></td>
				                  <td>
				                  	<a href="Mutasi/read/<?php echo $value->id ?>" title="Lihat detail"><i class="fa fa-search text-success"></i></a>
				                  	|
				                  	<a href="Mutasi/delete/<?php echo $value->id ?>" title="Hapus data" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
				                  </td>
				                </tr>
			                <?php endforeach ?>
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th class="center">No.</th>
			                  <th>Tanggal</th>
			                  <th>Kode Barang Lama</th>
			                  <th>Kode Barang Baru</th>
			                  <th>Nama Barang</th>
			                  <th>Ruangan Lama</th>
			                  <th>Ruangan Baru</th>
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