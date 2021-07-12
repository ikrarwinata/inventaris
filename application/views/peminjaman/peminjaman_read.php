<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Peminjaman Read</h2>
        <table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Tanggalpinjam</td><td><?php echo $tanggalpinjam; ?></td></tr>
	    <tr><td>Tanggalkembali</td><td><?php echo $tanggalkembali; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('peminjaman') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>