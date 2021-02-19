<section class="content-header">
      <h1>pakets
        <small>Satuan Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">paket</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('message') ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?=ucfirst($page)?> paket</h3>
                <div class="pull-right">
                    <a href="<?=site_url('paket')?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-undo"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4" >
                        <?php echo form_open_multipart('paket/process') ?>
                            <div class="form-group">
                                <label>Barcode</label>
                                <input type="hidden" name="id" value="<?=$row->paket_id?>">
                                <input type="text" name="barcode" value="<?=$row->barcode?>" class="form-control" required>
                                
                            </div>

                            <div class="form-group">
                                <label for="paket_name">Nama Paket</label>
                                <input type="text" name="paket_name" id="paket_name" value="<?=$row->name?>" class="form-control" required>
                                
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                    <select name="category" class="form-control" required>
                                        <option value=""> == Pilih == </option>
                                        <?php foreach($category->result() as $key => $data) { ?>
                                            <option value="<?=$data->category_id?>" <?=$data->category_id == $row->category_id ? "selected" : null?>><?=$data->name?></option>}
                                        <?php } ?>
                                    </select>
                                
                            </div>

                            <div class="form-group">
                                <label>Bahan</label>
                                <?php echo form_dropdown('bahan', $bahan, $selectedbahan,
                                    ['class' => 'form-control' , 'required' => 'required']) ?>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="price" value="<?=$row->price?>" class="form-control" required>
                                
                            </div>

                            <!-- <div class="form-group">
                                <label>Gambar</label>
                                <?php if ($page == 'edit') {
                                    if ($row->image != null) { ?>
                                        <div style="margin-buttom:5px">
                                            <img src="<?=base_url('uploads/product/'.$row->image)?>" style="width:80%">
                                        </div>
                                        <?php
                                    }
                                } ?>
                                <input type="file" name="image" class="form-control">
                                <small>(Biarkan kosong jika tidak <?=$page == 'edit' ? 'ganti' : 'ada'?>)</small>
                            </div> -->
                           
                            <div class="form-group">
                                <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
                                    <i class="fa fa-paper-plane"></i>Simpan
                                </button>
                                <button type="reset" class="btn btn-flat" >Reset</button>
                            </div>
                        <?php echo form_close() ?>

                    </div>
                </div>
            </div>
        </div>
      <!-- <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-th"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">paket</span>
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