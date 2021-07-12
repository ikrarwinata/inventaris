<div class="row">
  <div class="col-12">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-info">
          <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Barang</span>
            <span class="info-box-number"><?php echo $total_barang ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              <?php echo $total_barang ?> assets total
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-success">
          <span class="info-box-icon"><i class="fa fa-money-bill"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Nilai</span>
            <span class="info-box-number"><small>Rp.<?php echo $jumlah_nilai ?></small></span>

            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              (Nilai) dari keseluruhan
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-warning">
          <span class="info-box-icon"><i class="fas fa-funnel-dollar"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Barang Kondisi Baik</span>
            <span class="info-box-number"><?php echo $barang_baik ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: <?php echo $p_baik."%" ?>"></div>
            </div>
            <span class="progress-description">
              <small><?php echo $p_baik."%" ?></small> dari keseluruhan
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-danger">
          <span class="info-box-icon"><i class="fas fa-cookie-bite"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Barang Kondisi Rusak</span>
            <span class="info-box-number"><?php echo $barang_rusak ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: <?php echo $p_rusak."%" ?>"></div>
            </div>
            <span class="progress-description">
              <small><?php echo $p_rusak."%" ?></small> dari keseluruhan
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Selamat datang <?php echo $this->session->userdata("Nama") ?></h5>

                <p class="card-text">
                  Anda dapat langsung memilih fitur-fitur yang disediakan di bawah ini atau melalui menu sebelah kiri !
                </p>
                <a href="Asets/all" class="card-link">Lihat Semua Aset</a>
              </div>
            </div><!-- /.card -->
      </div>
    </div>
  </div>
</div>


