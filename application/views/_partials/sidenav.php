  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="Home" class="brand-link">
      <img src="assets/logo.png" alt="#" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Company's Name</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/avatar-admin.png" class="img-circle elevation-2" alt="#">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo str_sentence($this->session->userdata("Nama")) ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="Home" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt text-info"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list text-success"></i>
              <p>
                Inventaris Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Asets/all" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Asets/non_ruangan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Luar Ruangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Asets/ruangan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang Dalam Ruangan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>
                Data Lainnya
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Peminjaman" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Mutasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mutasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Ruangan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Tipe_asets" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipe Aset</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Bahan_asets" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bahan Aset</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="List_kondisi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kondisi Aset</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sync text-info"></i>
              <p>
                Proses Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Users/create" class="nav-link">
                  <i class="fas fa-plus nav-icon text-info"></i>
                  <p>Tambah Akun Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Asets/set_truncate" class="nav-link">
                  <i class="fas fa-minus nav-icon text-danger"></i>
                  <p>Kosongkan Data</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book text-success"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Asets/laporan_all" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Semua Aset</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Asets/laporan_non_ruangan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aset Luar Ruangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Asets/laporan_ruangan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aset Dalam Ruangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Ruangan/laporan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Mutasi/laporan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mutasi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Akun Pengguna</li>
          
          <li class="nav-item">
            <a href="Users/index" class="nav-link">
              <i class="fas fa-users nav-icon text-danger"></i>
              <p>Data Akun</p>
            </a>
          </li>

          <li class="nav-header"><?php echo str_sentence($this->session->userdata("Nama")) ?></li>

          <li class="nav-item">
            <a href="#" data-toggle="modal" data-target="#modal-password" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Ubah Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>