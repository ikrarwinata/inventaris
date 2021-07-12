<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title"></div>
            </div>
            <div class="card-body">
                <?php echo(form_open_multipart($action, "class='form-horizontal' role='form' ")) ?>
                    <div class="form-group">
                        <label for="varchar">Kode Barang <small class="text-danger">*</small> <?php echo form_error('kodebarang') ?></label>
                        <input type="text" class="form-control" name="kodebarang" maxlength="25" id="kodebarang" placeholder="Kodebarang" value="<?php echo $kodebarang; ?>" />
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="varchar">Tipe Barang <small class="text-danger">*</small> <?php echo form_error('idtipe') ?></label>
                                <select class="form-control select2bs4" name="idtipe" id="idtipe" style="width: 100%;">
                                    <option value="<?php echo $idtipe; ?>" selected="selected"><?php echo $tipe; ?></option>
                                    <?php foreach ($tipe_asets_data as $value): ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->tipe ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="int">Pilih Ruangan <?php echo form_error('idruangan') ?></label>
                                <select class="form-control select2bs4" name="idruangan" id="idruangan" style="width: 100%;">
                                    <option value="<?php echo $idruangan; ?>" selected="selected"><?php echo $ruangan; ?></option>
                                    <?php foreach ($ruangan_data as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->nama_ruangan ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="text-info"><small>Boleh dikosongkan jika barang ini tidak memiliki tempat </small></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Barang <small class="text-danger">*</small> <?php echo form_error('namabarang') ?></label>
                        <input type="text" class="form-control" maxlength="250" name="namabarang" id="namabarang" placeholder="Nama Barang" value="<?php echo $namabarang; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Merk <?php echo form_error('merk') ?></label>
                        <input type="text" class="form-control" maxlength="250" name="merk" id="merk" placeholder="Merk / Model Barang" value="<?php echo $merk; ?>" />
                        <span class="text-info"><small>Boleh dikosongkan jika barang ini tidak memiliki merk </small></span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="varchar">Ukuran <?php echo form_error('ukuran') ?></label>
                                <input type="text" class="form-control" maxlength="100" name="ukuran" id="ukuran" placeholder="Misal: 100 x 100 m3" value="<?php echo $ukuran; ?>" />
                                <span class="text-info"><small>Boleh dikosongkan jika barang ini tidak memiliki ukuran (terlalu kecil) </small></span>
                            </div>                            
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="varchar">Bahan <?php echo form_error('idbahan') ?></label>
                                <select class="form-control select2bs4" name="idbahan" id="idbahan" style="width: 100%;">
                                    <option value="<?php echo $idbahan; ?>" selected="selected"><?php echo $bahan; ?></option>
                                    <?php foreach ($bahan_asets_data as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->bahan ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="text-info"><small>Boleh dikosongkan jika barang ini tidak memiliki bahan </small></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="varchar">Tahun <small class="text-danger">*</small> <?php echo form_error('tahun') ?></label>
                                <input type="number" class="form-control" min="1900" max="<?php echo (date('Y') + 5) ?>" name="tahun" id="tahun" placeholder="Tahun Pengadaan" value="<?php echo $tahun; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="int">Harga Satuan (Rp) <small class="text-danger">*</small><?php echo form_error('harga') ?></label>
                                <input type="number" class="form-control" min="0" max="999999999999999" maxlength="15" name="harga" id="harga" placeholder="Nilai Satuan Barang (hanya angka, dalam rupiah)" value="<?php echo $harga; ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="int">Unit <small class="text-danger">*</small><?php echo form_error('unit') ?></label>
                                <input type="number" class="form-control" min="1" max="99999999999" maxlength="15" name="unit" id="unit" placeholder="Jumlah Unit Barang (hanya angka)" value="<?php echo $unit; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="int">Kondisi <small class="text-danger">*</small> <?php echo form_error('idkondisi') ?></label>
                        <select class="form-control select2bs4" name="idkondisi" id="idkondisi" style="width: 100%;">
                            <option value="<?php echo $idkondisi; ?>" selected="selected"><?php echo $kondisi; ?></option>
                            <?php foreach ($kondisi_data as $value): ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->kondisi ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="int">Foto Barang <?php echo form_error('foto') ?></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <?php if ($foto != NULL): ?>
                                    <label for="int">Foto saat ini</label>
                                    <img src="<?php echo $foto ?>" alt="" style="max-width: 100%; width: auto; height: 210px;" align="center">
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
                        <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                        <span class="text-info"><small>Boleh dikosongkan</small></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <input type="hidden" name="oldfoto" value="<?php echo $foto; ?>" /> 
                    <input type="hidden" name="oldkode" value="<?php echo $kodebarang; ?>" /> 
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                    <button type="button" class="btn btn-default" onclick="window.history.go(-1);">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>