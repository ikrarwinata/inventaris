
        <div class="row">
            <div class="col-12">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="varchar">Username <span><small style="color: red"><?php echo $this->session->userdata("errU") ?></small></span></label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>"  required="true"/>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Password <span><small style="color: red"><?php echo $this->session->userdata("errP") ?></small></span></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value=""/>
                        <?php if ($password!=NULL): ?>
                            <span><small class="text-info">Tinggalkan kosong jika tidak ingin dirubah</small></span>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Email <?php echo form_error('email') ?></label>
                        <input type="mail" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required="true" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Telepon <?php echo form_error('telepon') ?></label>
                        <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo $telepon; ?>"  required="true"/>
                    </div>
                    <input type="hidden" name="oldusername" value="<?php echo $username; ?>" /> 
                    <button type="submit" class="btn btn-primary">Simpan</button> 
                    <a href="Users/index" class="btn btn-default" onclick="">Cancel</a>
                </form>
            </div>
        </div>
        <hr>