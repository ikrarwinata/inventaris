    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body">
                    <form action="<?php echo $action; ?>" method="post">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="varchar">Pilih Barang <?php echo form_error('kodebarang_lama') ?></label>
                                    <select class="form-control select2bs4" name="kodebarang_lama" id="kodebarang_lama" style="width: 100%;">
                                        <option value="<?php echo $kodebarang_lama; ?>" selected="selected"><?php echo $barang_lama; ?></option>
                                        <?php foreach ($asets_data as $value): ?>
                                            <option value="<?php echo $value->kodebarang ?>"><?php echo $value->namabarang.($value->merk!=NULL?" - ".$value->merk:NULL); ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-7">
                                 <label>Deskripsi Barang</label>
                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                        Kode Barang
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="kodebarang">
                                        ...
                                    </div>
                                </div>

                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                        Nama Barang
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="namabarang">
                                        ...
                                    </div>
                                </div>

                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                        Ukuran
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="ukuran">
                                        ...
                                    </div>
                                </div>

                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                       Ruangan Saat Ini
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="ruangan_lama">
                                        ...
                                    </div>
                                </div>

                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                        Kondisi
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="kondisi">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row" style="margin-top: 35px">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="int">Mutasi Ke Ruangan <?php echo form_error('idruangan_baru') ?></label>
                                    <select class="form-control select2bs4" name="idruangan_baru" id="idruangan_baru" style="width: 100%;">
                                        <option value="<?php echo $idruangan_baru; ?>" selected="selected"><?php echo $ruangan_baru; ?></option>
                                        <?php foreach ($ruangan_data as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->nama_ruangan ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-7" style="vertical-align: middle;">
                                <label>Deskripsi Ruangan</label>
                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                        Lokasi
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="lokasi">
                                        ...
                                    </div>
                                </div>

                                <div class="row" style="background-color: rgb(212, 210, 210); border-radius: 15px; margin-top: 3px">
                                    <div class="col-3">
                                        Keterangan
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-8" id="keterangan_ruangan">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan_baru">Keterangan <?php echo form_error('keterangan_baru') ?></label>
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan Baru"><?php echo $keterangan; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                        <button type="submit" class="btn btn-primary">Simpan</button> 
                        <button type="button" onclick="window.history.go(-1)" class="btn btn-default">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>