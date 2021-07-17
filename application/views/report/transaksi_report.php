<section class="content-header">
      <h1>Report
        <small>Laporan Penjualan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Filter Data</h3>
        </div>
        <div class="box-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date1" value="<?=@$post['date1']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">s/d</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date2" value="<?=@$post['date2']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Customer</label>
                                <div class="col-sm-9">
                                    <select name="customer" class="form-control">
                                        <option value="">- All -</option>
                                        <option value="null">Umum</option>
                                        <?php foreach($customer as $cst => $data) { ?>
                                            <option value="<?=$data->customer_id?>" <?=@$post['customer'] == $data->customer_id ? 'selected' : ''?>><?=$data->name?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" name="invoice" value="<?=@$post['invoice']?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" name="reset" class="btn btn-flat">Reset</button>
                            <button type="submit" name="filter" class="btn btn-info btn-flat">
                                <i class="fa fa-search"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body table responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Grand Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1;
                        foreach($row->result() as $key => $data) {?>
                    <tr>
                            <td style="width:5%;"><?=$no++?></td>
                            <td><?=$data->invoice?></td>
                            <td><?=$data->date?></td>
                            <td><?=$data->customer_id == null ? "umum" : $data->customer_name?></td>
                            <td><?=$data->total_price?></td>
                            <td><?=$data->discount?></td>
                            <td><?=$data->final_price?></td>
                            <td class="text-center" width="200px">
                                <button id="detail" data-target="#modal-detail" data-toggle="modal" class="btn btn-default btn-xs"
                                    data-invoice="<?=$data->invoice?>"
                                    data-date="<?=$data->date?>"
                                    data-time="<?=substr($data->transaksi_created, 11, 5)?>"
                                    data-customer="<?=$data->customer_id == null ? "Umum" : $data->customer_name?>"
                                    data-total="<?=$data->total_price?>"
                                    data-discount="<?=$data->discount?>"
                                    data-grandtotal="<?=$data->final_price?>"
                                    data-cash="<?=$data->cash?>"
                                    data-remaining="<?=$data->remaining?>"
                                    data-note="<?=$data->note?>"
                                    data-cashier="<?=ucfirst($data->user_name)?>"
                                    data-transaksiid="<?=$data->transaksi_id?>">Detail</button> 
                                <a href="<?=site_url('transaksi/cetak/'.$data->transaksi_id)?>" target="_blank" class="btn btn-primary btn-xs">
                                   <i class="fa fa-print"></i>Cetak
                                </a>
                                <a href="<?=site_url('transaksi/del/'.$data->transaksi_id)?>" onclick="return confirm('apakah anda yakin ?')" class="btn btn-danger btn-xs">
                                   <i class="fa fa-trash"></i>Hapus
                                </a>

                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?=$pagination?>
                </ul>
            </div>
        </div>

    </section>


    <div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Detail Laporan Penjualan</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width:20%">Invoice</th>
                            <td style="width:30%"><span id="invoice"></span></td>
                            <th style="width:20%">Customer</th>
                            <td style="width:30%"><span id="cust"></span></td>
                        </tr>
                        <tr>
                            <th>Date Time</th>
                            <td><span id="datetime"></span></td>
                            <th>Cashier</th>
                            <td><span id="cashier"></span></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td><span id="total"></alspan></td>
                            <th>Cash</th>
                            <td><span id="cash"></span></td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td><span id="discount"></span></td>
                            <th>Change</th>
                            <td><span id="change"></span></td>
                        </tr>
                        <tr>
                            <th>Grand Total</th>
                            <td><span id="grandtotal"></span></td>
                            <th>Note</th>
                            <td><span id="note"></span></td>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <td colspan="3"><span id="paket"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 
<script>
$(document).on('click', '#detail', function() {
    $('#invoice').text($(this).data('invoice'))
    $('#cust').text($(this).data('customer'))
    $('#datetime').text($(this).data('date') + ' ' + $(this).data('time'))
    $('#total').text($(this).data('total'))
    $('#discount').text($(this).data('discount'))
    $('#cash').text($(this).data('cash'))
    $('#change').text($(this).data('remaining'))
    $('#grandtotal').text($(this).data('grandtotal'))
    $('#note').text($(this).data('note'))
    $('#cashier').text($(this).data('cashier'))
 
    var paket = '<table class="table no-margin">'
    paket += '<tr><th>Paket</th><th>Price</th><th>Qty</th><th>Disc</th><th>Total</th></tr>'
    $.getJSON('<?=site_url('report/transaksi_paket/')?>'+$(this).data('transaksiid'), function(data) {
        $.each(data, function(key, val) {
            paket += '<tr><td>'+val.name+'</td><td>'+val.price+'</td><td>'+val.qty+'</td><td>'+val.discount_paket+'</td><td>'+val.total+'</td></tr>'
        })
        paket += '</table>'
        $('#paket').html(paket)
    })
})
</script>