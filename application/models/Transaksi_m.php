<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_m extends CI_Model {


        // start datatables
        var $column_order = array(null, 'invoice', 'date', 'customer_name', 'total_price', 'discount', 'final_price'); //set column field database for datatable orderable
        var $column_search = array('invoice', 'customer.name', 'total_price'); //set column field database for datatable searchable
        var $order = array('transaksi_id' => 'asc'); // default order 
    
        private function _get_datatables_query() {
            $this->db->select('transaksi.*, customer.name as customer_name, user.name as user_name');
            $this->db->from('transaksi');
            $this->db->join('customer', 'transaksi.customer_id = customer.customer_id');
            $this->db->join('user', 'transaksi.user_id = user.user_id');
            $i = 0;
            foreach ($this->column_search as $paket) { // loop column 
                if(@$_POST['search']['value']) { // if datatable send POST for search
                    if($i===0) { // first loop
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($paket, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($paket, $_POST['search']['value']);
                    }
                    if(count($this->column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
            
            if(isset($_POST['order'])) { // here order processing
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
        function get_datatables() {
            $this->_get_datatables_query();
            if(@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }
        function count_filtered() {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
        function count_all() {
            $this->db->from('transaksi');
            return $this->db->count_all_results();
        }

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
                FROM transaksi 
                WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else
        {
            $no = "0001";
        }
        $invoice = "TS".date('ymd').$no;
            return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, paket.name as paket_name, cart.price as cart_price');
        $this->db->from('cart');
        $this->db->join('paket', 'cart.paket_id = paket.paket_id');
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM cart");
        if($query->num_rows() > 0){
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $params = array(
            'cart_id' => $car_no,
            'paket_id' => $post['paket_id'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'total' => ($post['price'] * $post['qty']),
            'user_id' => $this->session->userdata('userid')
            );
        $this->db->insert('cart', $params);
    }

    function update_cart_qty($post) {
        $sql = "UPDATE cart SET price = '$post[price]',
                qty = qty + '$post[qty]',
                total = '$post[price]' * qty
                WHERE paket_id = '$post[paket_id]'";
        $this->db->query($sql);
    }

    public function del_cart($params = null)
    {
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('cart');
    }

    public function edit_cart($post)
    {
        $params = array(
            'price' => $post['price'],
            'qty' => $post['qty'],
            'discount_paket' => $post['discount'],
            'total' => $post['total'],
        );
        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('cart', $params);
    }

    

    public function get_transaksi($id = null)
    {
        $this->db->select('*, customer.name as customer_name, user.username as user_name,
                            transaksi.created as transaksi_created');
        $this->db->from('transaksi');
        $this->db->join('customer', 'transaksi.customer_id = customer.customer_id', 'left');
        $this->db->join('user', 'transaksi.user_id = user.user_id');
        if($id != null) {
            $this->db->where('transaksi_id', $id);
        }
        $this->db->order_by('transaksi_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_transaksi($post)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'] == "" ? null : $post['customer_id'],
            'total_price' => $post['subtotal'],
            'discount' => $post['discount'],
            'final_price' => $post['grandtotal'],
            'cash' => $post['cash'],
            'remaining' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('transaksi', $params);
        return $this->db->insert_id();
    }

    function add_transaksi_detail($params) {
        $this->db->insert_batch('transaksi_detail', $params);
    }

    public function get_transaksi_pagination($limit = null, $start = null)
    {
        $post = $this->session->userdata('search');
        $this->db->select('*, customer.name as customer_name, user.username as user_name,
                            transaksi.created as transaksi_created');
        $this->db->from('transaksi');
        $this->db->join('customer', 'transaksi.customer_id = customer.customer_id', 'left');
        $this->db->join('user', 'transaksi.user_id = user.user_id');
        if(!empty($post['date1']) && !empty($post['date2'])) {
            $this->db->where("transaksi.date BETWEEN '$post[date1]' AND '$post[date2]'");
        }
        if(!empty($post['customer'])) {
            if($post['customer'] == 'null') {
                $this->db->where("transaksi.customer_id IS NULL");
            } else {
                $this->db->where("transaksi.customer_id", $post['customer']);
            }
        }
        if(!empty($post['invoice'])) {
            $this->db->like("invoice", $post['invoice']);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('transaksi_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_transaksi_detail($transaksi_id = null)
    {
        $this->db->from('transaksi_detail');
        $this->db->join('paket', 'transaksi_detail.paket_id = paket.paket_id');
        if($transaksi_id != null) {
            $this->db->where('transaksi_detail.transaksi_id', $transaksi_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del_transaksi($id)
    {
        $this->db->where('transaksi_id', $id);
        $this->db->delete('transaksi');
    }

}
