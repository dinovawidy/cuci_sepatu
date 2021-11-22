<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_m extends CI_Model {

            // start datatables
        var $column_order = array(null, 'barcode', 'paket.name', 'category_name', 'bahan_name', 'price'); //set column field database for datatable orderable
        var $column_search = array('barcode', 'paket.name', 'price'); //set column field database for datatable searchable
        var $order = array('paket_id' => 'asc'); // default order 
    
        private function _get_datatables_query() {
            $this->db->select('paket.*, category.name as category_name, bahan.name as bahan_name');
            $this->db->from('paket');
            $this->db->join('category', 'paket.category_id = category.category_id');
            $this->db->join('bahan', 'paket.bahan_id = bahan.bahan_id');
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
            $this->db->from('paket');
            return $this->db->count_all_results();
        }
        // end datatables

        public function get($id = null)
        {
                $this->db->select('paket.*, category.name as category_name, bahan.name as bahan_name');
                $this->db->from('paket');
                $this->db->join('category', 'category.category_id = paket.category_id');
                $this->db->join('bahan', 'bahan.bahan_id = paket.bahan_id');
                if($id != null) {
                        $this->db->where('paket_id', $id);
                }
                $this->db->order_by('barcode', 'asc');
                $query = $this->db->get();
                return $query;
        }

        /*public function add($post)
        {
            $params = [
                'name' => $post['paket_name'],
                'phone' => $post['phone'],
                'address' => $post['addr'],
                'description' => empty($post['desc']) ? null : $post['desc'],
            ];
            $this->db->insert('paket', $params);
        }*/

        public function add($post)
        {
            $params = [
                'barcode' => $post['barcode'],
                'name' => $post['paket_name'],
                'category_id' => $post['category'],
                'bahan_id' => $post['bahan'],
                'price' => $post['price'],
                'image' => $post['image'],

            ];
            $this->db->insert('paket', $params);

                /*$params['name'] = $post['paket_name'];
                $params['phone'] = $post['phone'];
                $params['address'] = ($post['addr']);
                $params['description'] = $post['desc'] != "" ? $post['desc'] : null;
                $this->db->insert('paket', $params); */
        }

        public function edit($post)
        {
            $params = [
                'barcode' => $post['barcode'],
                'name' => $post['paket_name'],
                'category_id' => $post['category'],
                'bahan_id' => $post['bahan'],
                'price' => $post['price'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if ($post['image'] != null) {
                $params['image'] = $post['image'];
            }
            $this->db->where('paket_id', $post['id']);
            $this->db->update('paket', $params);

        }

        function check_barcode($code, $id = null){
            $this->db->from('paket');
            $this->db->where('barcode', $code);
            if($id != null) {
                $this->db->where('paket_id !=', $id);
            }
            $query = $this->db->get();
            return $query;
        }

        public function del($id)
        {

                $this->db->where('paket_id', $id);
                $this->db->delete('paket');
        }

        /*function update_stock_in($data)
        {
            $qty = $data['qty'];
            $id = $data['paket_id'];
            $sql = "UPDATE paket SET stock = stock + '$qty' WHERE paket_id = '$id'";
            $this->db->query($sql);
        }

         function update_stock_out($data)
        {
            $qty = $data['qty'];
            $id = $data['paket_id'];
            $sql = "UPDATE paket SET stock = stock - '$qty' WHERE paket_id = '$id'";
            $this->db->query($sql);
        }*/
}


  /*$paket = $this->paket_m->get($post['id'])->row();
                        if($paket->image != null) {
                            $target_file = './uploads/product/'.$paket->image;
                            unlink($target_file);
                        }
*/