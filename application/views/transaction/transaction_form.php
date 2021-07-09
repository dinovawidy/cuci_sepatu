<section class="content-header">
      <h1>Pembayaran
        <small>Transaksi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Pembayaran</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align: top">
                    <label for="date">Tanggal</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="date" id="date" value="<?=date('Y-m-d')?>" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top; width: 30%">
                    <label for="user">Kasir</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" id="user" value="<?=$this->fungsi->user_login()->name?>" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top">
                    <label for="date">Customer</label>
                  </td>
                  <td>
                    <div>
                      <select id="customer" class="form-control">
                        <option value="">Umum</option>
                        <?php foreach ($customer as $cust => $value) {
                          echo '<option value="'.$value->customer_id.'">'.$value->name.'</option>';
                        } ?>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <table>
                <tr>
                  <td style="vertical-align: top; width: 30%">
                    <label for="barcode">Barcode</label>
                    input
                  </td>
                  <td>
                    <div class="form-group input-group">
                      <input type="hidden" id="paket_id">
                      <input type="hidden" id="price">
                      <input type="text" id="barcode" class="form-control" autofocus>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top">
                    <label for="qty">Jumlah</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" id="qty" value="1" min="1" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <div>
                      <button type="button" id="add_cart" class="btn btn-primary">
                        <i class="fa fa-cart-plus"></i> Tambah
                      </button>
                    </div>
                  </td>
                </tr>
              </table>  
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="box box-widget">
            <div class="box-body">
              <div align="right">
                <h4>Invoice <b><span id="invoice"> <?= $invoice ?></span></b></h4>
                <h1><b><span id="grand_total2" style="font-size: 50pt">0</span></b></h1>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="box box-widget">
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Barcode</th>
                      <th>Produk Item</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th width="10%">Diskon Item</th>
                      <th width="15%">Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="cart_table">
                    <?php $this->view('transaction/cart_data') ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-3">
            <div class="box box-widget">
              <div class="box-body">
                <table width="100%">
                  <tr>
                    <td style="vertical-align:top; width: 30%">
                      <label for="sub_total">Sub Total</label>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" id="sub_total" value="" class="form-control" readonly>
                      </div>
                    </td> 
                  </tr>
                  <tr>
                    <td style="vertical-align:top">
                      <label for="discount">Discount</label>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" id="discount" value="0" min="0" class="form-control">
                      </div>
                    </td> 
                  </tr>
                  <tr>
                    <td style="vertical-align:top">
                      <label for="grand_total">Grand Total</label>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" id="grand_total" class="form-control" readonly>
                      </div>
                    </td> 
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="box box-widget">
              <div class="box-body">
                <table width="100%">
                  <tr>
                    <td style="vertical-align: top; width: 30%">
                      <label for="cash">Cash</label>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" id="cash" value="0" min="0" class="form-control">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top">
                      <label for="change">Change</label>
                    </td>
                    <td>
                      <div>
                        <input type="number" id="change" class="form-control" readonly>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="box box-widget">
              <div class="box-body">
                <table width="100%">
                  <tr>
                    <td style="vertical-align: top">
                      <label for="note">Note</label>
                    </td>
                    <td>
                      <div>
                        <textarea id="note" rows="3" class="form-control"></textarea>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div>
              <button id="cancel_payment" class="btn btn-flat btn-warning">
                <i class="fa fa-refresh"></i> Cancel
              </button><br><br>
              <button id="process_payment" class="btn btn-flat btn-lg btn-success">
                <i class="fa fa-papper-plane-o"></i> Proses Pembayaran
              </button>
            </div>
          </div>
        </div>
    </section>


      <div class="modal fade" id="modal-item">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Pilih Item Produk</h4>
          </div>  
          <div class="modal-body table responsive">
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>Barcode</th>
                  <th>Nama</th>
                  <th>Bahan</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($paket as $p =>$data) { ?>
                <tr>
                  <!-- <td>data</td> -->
                  <td><?=$data->barcode?></td>
                  <td><?=$data->name?></td>
                  <td><?=$data->bahan_name?></td>
                  <td><?=$data->category_name?></td>
                  <td class="text-right"><?=$data->price?></td>
                  <td class="text-right">
                    <button class="btn btn-xs btn-info" id="select" 
                    data-id="<?=$data->paket_id?>"
                    data-barcode="<?=$data->barcode?>"
                    data-price="<?=$data->price?>"
                    >
                      <i class="fa fa-check">Pilih</i>
                    </button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>


     <script>
      $(document).ready(function() {
        $(document).on('click', '#select', function() {
          var paket_id = $(this).data('id');
          var barcode = $(this).data('barcode');
          var price = $(this).data('price');
          $('#paket_id').val(paket_id);
          $('#barcode').val(barcode);
          $('#price').val(price);
          $('#modal-item').modal('hide');
        })
      })
        /*$(document).on('click', '#select', function() {
          $('#paket_id').val($(this).data(id))
          $('#barcode').val($(this).data(barcode))
          $('#price').val($(this).data(price))
          $('#modal-item').modal('hide');
        })*/
      
        $(document).on('click', '#add_cart', function() {
          var paket_id = $('#paket_id').val()
          var price = $('#price').val()
          var qty = $('#qty').val()
          if(paket_id == '') {
            alert('paket belum dipilih')
            $('#barcode').focus()
          } else {
              $.ajax({
                type: 'POST',
                url: '<?=site_url('transaksi/process')?>', 
                data: {'add_cart' : true, 'paket_id' : paket_id, 'price' : price, 'qty' : qty},
                dataType: 'json',
                success: function(result) {
                  if(result.success == true) {
                      alert('berhasil tambah data cart ke db')
                  } else {
                    alert('Gagal tambah data')
                  }
                }
              })
          }
        })
    </script>