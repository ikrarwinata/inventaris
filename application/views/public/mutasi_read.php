<div class="row">
		<div class="col-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						Info Mutasi
					</div>
				</div>
				<div class="card-body center text-center" style="min-height: 425px">
					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Kode Barang
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<small><strong><?php echo $kodebarang_lama ?></strong></small>
						</div>
					</div>
					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Ruangan Lama
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<small><strong><?php echo $ruangan_lama ?></strong></small>
						</div>
					</div>
					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Keterangan
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<small><strong><?php echo $keterangan_mutasi ?></strong></small>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						Detail Data
					</div>
				</div>
				<div class="card-body">
					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Kode Barang
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<small><strong><?php echo $kodebarang ?></strong></small>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Ruangan Saat Ini
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $ruangan ?>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Nama Barang
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $namabarang ?>&nbsp;<small><strong>(<?php echo $tipe ?>)</strong></small>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Merk / Model
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $merk ?>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Bahan
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<strong><?php echo $bahan ?></strong>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Ukuran
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<small><strong><?php echo $ukuran ?></strong></small>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Harga Satuan
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							Rp.<?php echo format_number($harga) ?>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Unit
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $unit ?>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Kondisi
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<strong><?php echo $kondisi ?></strong>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Tahun Pengadaan
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $tahun ?>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Tanggal Entri
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $tanggal ?>
						</div>
					</div>

					<div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 8px">
						<div class="col-4">
							Keterangan
						</div>
						<div class="col-1">
							:
						</div>
						<div class="col-7">
							<?php echo $keterangan ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						Gambar
					</div>
				</div>
				<div class="card-body center text-center" style="min-height: 425px">
					<img src="<?php echo $foto ?>" alt="" style="max-width: 100%; width: auto; height: 300px">
				</div>
			</div>
		</div>
</div>