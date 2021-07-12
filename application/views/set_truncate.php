<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="card card-danger card-outline">
            <div class="card-body">
              <h5 class="card-title">Peringatan</h5>

              <p class="card-text">
                Setelah anda mengosongkan data anda tidak dapat membatalkan tindakan !
              </p>
            </div>
         </div><!-- /.card -->

        <?php if ($this->session->userdata("truncated") != NULL): ?>
        <div class="col-12 center text-center">
          <div class="well well-lg well-danger text-danger">
            <?php echo $this->session->userdata("truncated") ?>
          </div>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="card card-primary card-outline">
            <div class="card-body">
              <ul class="text-danger" style="list-style: none;">
                <li style="margin-top: 15px"><a href="Asets/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Semua Assets</a>
                </li>
                <li style="margin-top: 15px"><a href="Asets/truncate_asets_ruangan" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Assets Ruangan</a>
                </li>
                <li style="margin-top: 15px"><a href="Asets/truncate_asets" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Assets Non Ruangan</a>
                </li>
                <li style="margin-top: 15px"><a href="Ruangan/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Data Ruangan</a>
                </li>
                <li style="margin-top: 15px"><a href="Peminjaman/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Data Peminjaman</a>
                </li>
                <li style="margin-top: 15px"><a href="Mutasi/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Data Mutasi</a>
                </li>
                <li style="margin-top: 15px"><a href="Tipe_asets/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Tipe Assets</a>
                </li>
                <li style="margin-top: 15px"><a href="Bahan_asets/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Bahan Assets</a>
                </li>
                <li style="margin-top: 15px"><a href="List_kondisi/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Kondisi Assets</a>
                </li>
                <li style="margin-top: 15px"><a href="Users/truncate_all" class="text-danger" onclick="return confirm('Anda yakin ingin mengosongkan data ini ?')">
                  <i class="fa fa-trash"></i>&nbsp;Kosongkan Akun Pengguna (Terkecuali Akun Saat Ini)</a>
                </li>
              </ul>
            </div>
         </div><!-- /.card -->
      </div>
    </div>
  </div>
</div>


