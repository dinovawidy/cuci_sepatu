<section class="content-header">
      <h1>pakets
        <small>Data Barang</small>
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
                <h3 class="box-title">Data paket</h3>
                <div class="pull-right">
                    <a href="<?=site_url('paket/add')?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-plus"></i>Tambah
                    </a>
                </div>
            </div>
            <div class="box-body table responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>bahan</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach($row->result() as $key => $data) {?>
                    <tr>
                            <td style="width:5%;"><?=$no++?></td>
                            <td>
                                <?=$data->barcode?><br>
                                <a href="<?=site_url('paket/barcode_qrcode/'.$data->paket_id)?>" class="btn btn-default btn-xs">
                                   <i class="fa fa-default"></i>Generate
                                </a>
                            </br>
                            </td>
                            <td><?=$data->name?></td>
                            <td><?=$data->category_name?></td>
                            <td><?=$data->bahan_name?></td>
                            <td><?=$data->price?></td>
                            <td>
                                <?php if ($data->image != null) { ?>
                                    <img src="<?=base_url('uploads/paket/'.$data->image)?>" style="width:50px">
                                <?php } ?>
                                
                                    
                                </td>
                            <td class="text-center" width="160px"> 
                                <a href="<?=site_url('paket/edit/'.$data->paket_id)?>" class="btn btn-primary btn-xs">
                                   <i class="fa fa-pencil"></i>Edit
                                </a>
                                <a href="<?=site_url('paket/del/'.$data->paket_id)?>" onclick="return confirm('apakah anda yakin ?')" class="btn btn-danger btn-xs">
                                   <i class="fa fa-trash"></i>Hapus
                                </a>

                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <script>
    $(document).ready(function() {
        $('#table1').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?=site_url('paket/get_ajax')?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [5],
                    "className": 'text-right'
                },
                {
                    "targets": [6, -1],
                    "className": 'text-center'
                },
                {
                    "targets": [0, 6, -1],
                    "orderable": false
                }
            ],
            "order": []
        })
    })
</script>