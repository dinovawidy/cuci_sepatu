<section class="content-header">
      <h1>Users
        <small>Pengguna</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tambah Users</h3>
                <div class="pull-right">
                    <a href="<?=site_url('user')?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-undo"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4" >
                        <?php //echo validation_errors(); ?>
                        <form action="" method="post">
                            <div class="form-group <?=form_error('fullname') ? 'has-error' : null?>" >
                                <label>Nama</label>
                                <input type="text" name="fullname" value="<?=set_value('fullname')?>" class="form-control">
                                <?=form_error('fullname')?>
                            </div>
                            <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                                <label>Username</label>
                                <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                                <?=form_error('username')?>
                            </div>
                            <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                                <label>Password</label>
                                <input type="password" name="password" value="<?=set_value('password')?>" class="form-control">
                                <?=form_error('password')?>
                            </div>
                            <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                                <?=form_error('passconf')?>
                            </div>
                            <div class="form-group <?=form_error('address') ? 'has-error' : null?>">
                                <label>Alamat</label>
                                <textarea name="address" value="" class="form-control"><?=set_value('address')?></textarea>
                                <?=form_error('address')?>
                            </div>
                            <div class="form-group <?=form_error('level') ? 'has-error' : null?>">
                                <label>Level</label>
                                <select name="level" value="" class="form-control">
                                    <option value="">==Pilih==</option>
                                    <option value="1" <?=set_value('level') == 1 ? "selected" : null?>>Admin</option>
                                    <option value="2" <?=set_value('level') == 2 ? "selected" : null?>>Kasir</option>
                                </select>
                                <?=form_error('level')?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">
                                    <i class="fa fa-paper-plane"></i>Simpan
                                </button>
                                <button type="reset" class="btn btn-flat" >Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <!-- <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-th"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Item</span>
                <span class="info-box-number">90</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Suplier</span>
                <span class="info-box-number">4</span>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Customer</span>
                <span class="info-box-number">60</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">3</span>
            </div>
          </div>
        </div> -->

    </section>