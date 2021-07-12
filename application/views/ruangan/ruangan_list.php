	<div class="modal fade" id="modal-overlay">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="overlay d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="List_kondisi/create_action" method="post">
            	<div class="modal-body">
            		<div class="form-group row">
            			<div class="col-4">
            				Nama Ruangan
            			</div>
            			<div class="col-8">
            				<input type="text" name="nama_ruangan" id="nama_ruangan" maxlength="250" class="form-control" required="true">
            			</div>
            		</div>
            		<div class="form-group row">
            			<div class="col-4">
            				Lokasi
            			</div>
            			<div class="col-8">
            				<input type="text" name="lokasi" id="lokasi" class="form-control" required="true">
            			</div>
            		</div>
            		<div class="form-group row">
            			<div class="col-4">
            				Keterangan
            			</div>
            			<div class="col-8">
            				<textarea class="form-control" name="keterangan" id="keterangan"></textarea>
            			</div>
            		</div>
	            </div>
	            <div class="modal-footer justify-content-between">
	            	<input type="hidden" name="id" id="idruangan" value="">
	            	<button type="button" class="btn btn-default modal-dismiss" data-dismiss="modal">Batal</button>
	            	<button type="submit" class="btn btn-primary">Simpan</button>
	            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	<div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="overlay d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi Hapus</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
        		Apakah anda ingin menghapus semua Asets di dalam ruangan ini juga ?
            </div>
            <div class="modal-footer justify-content-between">
            	<input type="hidden" name="id" id="idruangan" value="">
            	<button type="button" class="btn btn-default modal-dismiss" data-dismiss="modal">Batal</button>
            	<a href="" type="button" class="btn btn-primary" id="ref-delete">Tidak, Hapus Ruangan Saja</a>
            	<a href="" type="button" class="btn btn-danger" id="ref-delete-all">Ya, Hapus Asets Juga</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="col-lg-4">
					<button type="button" id="add-new" class="btn btn-block bg-gradient-info btn-flat col-sm-9" data-toggle="modal" data-target="#modal-overlay" style="border-radius: 25px">
	                  Tambah Ruangan
	                </button>
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
	              <h3 class="card-title">Daftar Ruangan</h3>
	            </div>

	            <div class="card-body">
	              <div class="table-responsive">
	              	<div class="table">
		              	<table id="datatab1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th class="center" width="50">Id</th>
			                  <th>Nama Ruangan</th>
			                  <th>Lokasi</th>
			                  <th>Keterangan</th>
			                  <th class="center text-center" style="max-width: 100px">Asets</th>
			                  <th width="160" class="center text-center" style="min-width: 150px"></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php foreach ($ruangan_data as $value): ?>
			                	<tr>
				                  <td class="center text-center id-placeholder"><?php echo $value->id ?></td>
				                  <td><?php echo $value->nama_ruangan ?></td>
				                  <td><?php echo $value->lokasi ?></td>
				                  <td><?php echo str_shortened($value->keterangan) ?></td>
				                  <td class="center text-center"><?php echo $value->total_barang ?></td>
				                  <td>
				                  	<button type="button" class="btn-update" title="Ubah data" data-toggle="modal" data-target="#modal-overlay" style="border-radius: 25px">
					                  <i class="fa fa-edit"></i>
					                </button>
				                  	|
				                  	<button type="button" class="btn-delete" title="Hapus data" data-toggle="modal" data-target="#modal-delete" style="border-radius: 25px">
					                  <i class="fa fa-trash text-danger"></i>
					                </button>
					                |
					                <a href="Asets/create_ruangan/<?php echo $value->id ?>" title="Tambah asets ruangan"><i class="fa fa-plus text-info"></i></a>
					                |
					                <a href="Ruangan/truncate/<?php echo $value->id ?>" title="Kosongkan ruangan" onclick="return confirm('Anda yakin ingin mengosongkan ruangan ini ?')"><i class="fa fa-minus text-warning"></i></a>
				                  </td>
				                </tr>
			                <?php endforeach ?>
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th class="center" width="50">Id</th>
			                  <th>Nama Ruangan</th>
			                  <th>Lokasi</th>
			                  <th>Keterangan</th>
			                  <th class="center text-center" style="max-width: 100px">Asets</th>
			                  <th width="160" class="center text-center" style="min-width: 150px"></th>
			                </tr>
			                </tfoot>
			              </table>
		            </div>
	              </div>
	            </div>
			</div>
		</div>
	</div>