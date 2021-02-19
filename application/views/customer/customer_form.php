<section class="content-header">
      <h1>Customer
        <small>Pelanggan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?=ucfirst($page)?> customer</h3>
                <div class="pull-right">
                    <a href="<?=site_url('customer')?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-undo"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4" >
                        <?php //echo validation_errors(); ?>
                        <form action="<?=site_url('customer/process')?>" method="post">
                            <div class="form-group">
                                <label>Nama customer</label>
                                <input type="hidden" name="id" value="<?=$row->customer_id?>">
                                <input type="text" name="customer_name" value="<?=$row->name?>" class="form-control" required>
                                
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="<?=$row->email?>" class="form-control" required>
                                
                            </div>

                             <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <!-- <input type="text" name="desc" value="<?=$row->description?>" class="form-control" required> -->
                                <select name="gender" class="form-control" required>
                                    <option value="">=Pilihan=</option>
                                    <option value="L" <?=$row->gender == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="P" <?=$row->gender == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <label>No. Telephon</label>
                                <input type="text" name="phone" value="<?=$row->phone?>" class="form-control" required>
                                
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <!-- <input type="text" name="addr" value="<?=$row->address?>" class="form-control" required> -->
                                <textarea name="addr" class="form-control" required><?php $row->address?></textarea>
                                
                            </div>
                            <div class="form-group">
                                <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
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