<section class="content-header">
      <h1>items
        <small>Satuan Barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">item</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('message') ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Generate</h3>
                <div class="pull-right">
                    <a href="<?=site_url('item')?>" class="btn btn-warning btn-flat">
                        <i class="fa fa-undo"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="box-body">
                <?php   
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '"style="width: 200px">';
                 ?>
                 <br>
                     <?=$row->barcode?>
                 <br><br>
                 <a href="<?=site_url('item/barcode_print/'.$row->item_id)?>" target="_blank" class="btn btn-default btn-sm">
                    <i class="fa fa-print"></i>Print
                 </a>   
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Qr-Code Generate</h3>
            </div>
            <div class="box-body">
                <?php   
                    $qrCode = new Endroid\QrCode\QrCode($row->barcode);
                    $qrCode->writeFile('uploads/qr-code/item-'.$row->barcode.'.png');
                 ?>

                 <img src="<?=base_url('uploads/qr-code/item-'.$row->barcode.'.png')?>" style="width: 200px">
                 <br>
                     <?=$row->barcode?>
                 </br>
                 <a href="<?=site_url('item/qrcode_print/'.$row->item_id)?>" target="_blank" class="btn btn-default btn-sm">
                    <i class="fa fa-print"></i>Print
                 </a>    
            </div>
        </div>
     
    </section>