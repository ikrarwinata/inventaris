<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Aplikasi Inventaris :: <?php echo str_sentence($judul) ?></title>
	<base href="<?php echo base_url() ?>">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<?php if (isset($bootstrap)): ?>
		<?php if ($bootstrap != NULL): ?>
			<?php foreach ($bootstrap as $value): ?>
				<link rel="stylesheet" href="<?php echo $value ?>">
			<?php endforeach ?>
		<?php endif ?>
	<?php endif ?>
</head>
<body class="">
<div>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $judul ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<?php foreach ($breadcrumb as $value): ?>
            		<li class="breadcrumb-item"><?php echo $value ?></li>
            	<?php endforeach ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	      <?php if (isset($konten)): ?>
	      	<?php $this->load->view($konten); ?>
	      	<?php else: ?>
	      		<div class="row">
	      			<div class="col-12">
	      				<div class="card">
			      			<div class="card-header">
			      				<div class="card-title">Uppss! Terjadi kesalahan.</div>
			      			</div>
			      			<div class="card-body text-center">
			      				<p>Maaf data yang anda cari tidak ditemukan.</p>
			      				<p>Kami akan mengatasi masalah ini secepatnya.</p>
			      			</div>
			      		</div>
	      			</div>
	      		</div>
	      <?php endif ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  	<?php $this->load->view("_partials/footer") ?>
</div>
<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->
	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/js/adminlte.js"></script>


	<!-- PAGE PLUGINS -->
	<!-- jQuery Mapael -->
	<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
	<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

	<!-- PAGE SCRIPTS -->
	<script src="assets/js/pages/dashboard2.js"></script>

	<?php if (isset($script)): ?>
		<?php if ($script !== FALSE): ?>
			<?php $this->load->view($konten."_script") ?>
		<?php endif ?>
	<?php endif ?>
	<!-- OPTIONAL SCRIPTS -->
	<script src="assets/js/demo.js"></script>
</body>
</html>