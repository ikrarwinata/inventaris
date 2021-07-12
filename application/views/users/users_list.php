
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <a href="Users/create" class="btn btn-primary">Tambah Akun</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('users/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('users'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
			<table class="table" style="width: 100%; border-collapse: collapse;table-layout: auto;">
				<thead>
				<tr>
					<th>No</th>
		<th>Username</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Telepon</th>
		<th>Action</th>
				</tr>
				</thead>
				<tbody><?php
				foreach ($users_data as $users)
				{
					?>
					<tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $users->username ?></td>
			<td><?php echo $users->nama ?></td>
			<td><?php echo $users->email ?></td>
			<td><?php echo $users->telepon ?></td>
			<td style="text-align:center" width="200px">
                <a href="Users/read/<?php echo $users->username ?>" class="btn" title="Lihat detail"><i class="fa fa-eye text-success"></i></a>
                |
                <a href="Users/update/<?php echo $users->username ?>" class="btn" title="Ubah data"><i class="fa fa-edit text-info"></i></a>
                <?php if ($users->username != $this->session->userdata("Username")): ?>
                |
                <a href="Users/delete/<?php echo $users->username ?>" class="btn" title="Hapus"><i class="fa fa-trash text-danger" onclick="return confirm('Anda yakin ingin menghapus akun ini ?')"></i></a>
                <?php endif ?>
			</td>
		</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		</div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>