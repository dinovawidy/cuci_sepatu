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


      <!-- modal edit -->
      <div class="modal fade" id="modal-item-edit">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Update Item Produk</h4>
          </div>  
          <div class="modal-body">
            <input type="hidden" id="cartid_paket">
            <div class="form-group">
              <label for="paket_item">Item Paket</label>
              <div class="row">
                <div class="col-md-5">
                  <input type="text" id="barcode_paket" class="form-control" readonly>
                </div>
                <div class="col-md-7">
                  <input type="text" id="product_paket" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="price_paket">Price</label>
              <input type="number" id="price_paket" min="0" class="form-control">
            </div>
            <div class="form-group">
              <label for="qty_paket">Qty</label>
              <input type="number" id="qty_paket" min="1" class="form-control">
            </div>
            <div class="form-group">
              <label for="total_before">Total sebelum Discount</label>
              <input type="number" id="total_before" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="discount_paket">Discount per Paket</label>
              <input type="number" id="discount_paket" min="0" class="form-control">
            </div>
            <div class="form-group">
              <label for="total_paket">total setelah Discount</label>
              <input type="number" id="total_paket" class="form-control" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <div class="pull-right">
              <button type="button" id="edit_cart" class="btn btn-flat btn-success">
                <i class="fa fa-paper-plane"></i> Save
              </button>
            </div>
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
              /*Add cart*/
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
                      $('#cart_table').load('<?=site_url('transaksi/cart_data')?>', function(){
                          calculate()
                      })
                  } else {
                    alert('Gagal tambah data')
                  }
                }
              })
          }
        })

    $(document).on('click', '#del_cart', function() {
      if(confirm('Apakah anda yakin ?')) {
        var cart_id = $(this).data('cartid')
        $.ajax({
          type: 'POST',
          url: '<?=site_url('transaksi/cart_del')?>',
          dataType: 'json',
          data: {'cart_id': cart_id},
          success: function(result) {
            if(result.success == true) {
                      $('#cart_table').load('<?=site_url('transaksi/cart_data')?>', function(){
                          calculate()
                      })
                  } else {
                    alert('Gagal Hapus Data ');
                  }
          }
      })
      }
    })

   
    $(document).on('click', '#update_cart', function() {
      $('#cartid_paket').val($(this).data('cartid'))
      $('#barcode_paket').val($(this).data('barcode'))
      $('#product_paket').val($(this).data('paket'))
      $('#price_paket').val($(this).data('price'))
      $('#qty_paket').val($(this).data('qty'))
      $('#total_before').val($(this).data('price') * $(this).data('qty'))
      $('#discount_paket').val($(this).data('discount'))
      $('#total_paket').val($(this).data('total'))

    })
         
    function count_edit_modal() {    
      var price = $('#price_paket').val()
      var qty = $('#qty_paket').val()
      var discount = $('#discount_paket').val()

      total_before = price * qty
      $('#total_before').val(total_before)

      total = (price - discount) * qty
      $('#total_paket').val(total)

      if(discount == '') {
              $('#discount_paket').val(0)
          }
    }
    $(document).on('keyup mouseup', '#price_paket, #qty_paket, #discount_paket', function() {
        count_edit_modal()

    })

          $(document).on('click', '#edit_cart', function() {
          var cart_id = $('#cartid_paket').val()
          var price = $('#price_paket').val()
          var qty = $('#qty_paket').val()
          var discount = $('#discount_paket').val()
          var total = $('#total_paket').val()
          if(price == '' || price < 1) {
            alert('harga tidak bisa kosong')
            $('#price_paket').focus()
          } else if(qty == '' || qty < 1) {
              alert('Jumlah tidak boleh kosong')
              $('#qty_paket').focus('')
          } else {
              $.ajax({
                type: 'POST',
                url: '<?=site_url('transaksi/process')?>', 
                data: {'edit_cart' : true, 'cart_id' : cart_id, 'price' : price,
                         'qty' : qty, 'discount' : discount, 'total' : total},
                dataType: 'json',
                success: function(result) {
                  if(result.success == true) {
                      $('#cart_table').load('<?=site_url('transaksi/cart_data')?>', function(){
                          calculate()
                      })
                      alert('Data cart berhasil ter-udate')
                      $('#modal-item-edit').modal('hide');
                  } else {
                    alert('Data cart tidak ter-udate')
                  }
                }
              })
          }
        })

    function calculate() {
      var subtotal = 0;
      $('#cart_table tr').each(function() {
        subtotal += parseInt($(this).find('#total').text())
      })
      isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

      var discount = $('#discount').val()
      var grand_total = subtotal - discount
      if(isNaN(grand_total)) {
        $('#grand_total').val(0)
        $('#grand_total2').text(0)
      } else {
        $('#grand_total').val(grand_total)
        $('#grand_total2').text(grand_total)
      }

      var cash = $('#cash').val()
      cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)

      if(discount == '') {
              $('#discount').val(0)
          }
    }


    $(document).on('keyup mouseup', '#discount, #cash', function() {
        calculate()

    })

    $(document).ready(function() {
      calculate()
    })

    //process payment
    $(document).on('click', '#process_payment', function() {
      var customer_id = $('#customer').val()
      var subtotal = $('#sub_total').val()
      var discount = $('#discount').val()
      var grandtotal = $('#grand_total').val()
      var cash = $('#cash').val()
      var change = $('#change').val()
      var note = $('#note').val()
      var date = $('#date').val()
      if(subtotal < 1) {
        alert('Belum ada paket yang dipilih')
        $('#barcode').focus()
      } else if(cash < 1) {
        alert('Jumlah uang cash belum dimasukan')
        $('#cash').focus()
      } else {
        if(confirm('Yakin proses transaksi ini ?')) {
          $.ajax({
            type: 'POST',
            url: '<?=site_url('transaksi/process')?>',
            data: {'process_payment' : true, 'customer_id' : customer_id, 'subtotal' : subtotal,
                  'discount' : discount, 'grandtotal' : grandtotal, 'cash' : cash, 'change' : change,
                  'note' : note, 'date' : date},
            dataType: 'json',
            success: function(result) {
              if(result.success) {
                alert('transaksi berhasil');
              }
              else {
                alert('transaksi gagal');
              }
              location.href='<?=site_url('transaksi')?>'
            }
          })
        }
      }
    })
    </script>