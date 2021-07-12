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
            				Tipe Asets
            			</div>
            			<div class="col-8">
            				<input type="text" name="tipe" id="tipe" maxlength="150" class="form-control" required="true">
            			</div>
            		</div>
            		<div class="form-group row">
            			<div class="col-4">
            				Keterangan
            			</div>
            			<div class="col-8">
            				<input type="text" class="form-control" name="keterangan" id="keterangan">
            			</div>
            		</div>
	            </div>
	            <div class="modal-footer justify-content-between">
	            	<input type="hidden" name="id" id="idtipe" value="">
	            	<button type="button" class="btn btn-default" data-dismiss="modal" id="modal-dismiss">Batal</button>
	            	<button type="submit" class="btn btn-primary">Simpan</button>
	            </div>
            </form>
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
	                  Tambah Tipe Asets
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
	              <h3 class="card-title">Daftar Tipe Asets</h3>
	            </div>

	            <div class="card-body">
	              <div class="table-responsive">
	              	<div class="table">
		              	<table id="datatab1" class="table table-bordered table-striped">
			                <thead>
			                <tr>
			                  <th class="center" width="50">Id</th>
			                  <th>Nama Tipe Asets</th>
			                  <th>Keterangan</th>
			                  <th width="140" class="center text-center" style="min-width: 110px"></th>
			                </tr>
			                </thead>
			                <tbody>
			                <?php foreach ($tipe_data as $value): ?>
			                	<tr>
				                  <td class="center text-center id-placeholder"><?php echo $value->id ?></td>
				                  <td><span class="tipe-placeholder"><?php echo $value->tipe ?></span></td>
				                  <td class="keterangan-placeholder"><?php echo $value->keterangan ?></td>
				                  <td>
				                  	<button type="button" class="btn-update" title="Ubah data" data-toggle="modal" data-target="#modal-overlay" style="border-radius: 25px">
					                  <i class="fa fa-edit"></i>
					                </button>
				                  	|
				                  	<a href="Tipe_asets/delete/<?php echo $value->id ?>" title="Hapus data" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash text-danger"></i></a>
				                  </td>
				                </tr>
			                <?php endforeach ?>
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th class="center" width="50">Id</th>
			                  <th>Nama Tipe Asets</th>
			                  <th>Keterangan</th>
			                  <th width="140" class="center text-center" style="min-width: 110px"></th>
			                </tr>
			                </tfoot>
			              </table>
		            </div>
	              </div>
	            </div>
			</div>
		</div>
	</div>