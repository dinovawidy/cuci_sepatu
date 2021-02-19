<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembayaran_m extends CI_Model {


        public function get($id = null)
        {
                $this->db->from('pembayaran');
                if($id != null) {
                        $this->db->where('pembayaran_id', $id);
                }
                $query = $this->db->get();
                return $query;
        }

        /*public function add($post)
        {
            $params = [
                'name' => $post['pembayaran_name'],
                'phone' => $post['phone'],
                'address' => $post['addr'],
                'description' => empty($post['desc']) ? null : $post['desc'],
            ];
            $this->db->insert('pembayaran', $params);
        }*/

        public function add($post)
        {
            $params = [
                'name' => $post['pembayaran_name'],
            ];
            $this->db->insert('pembayaran', $params);

                /*$params['name'] = $post['pembayaran_name'];
                $params['phone'] = $post['phone'];
                $params['address'] = ($post['addr']);
                $params['description'] = $post['desc'] != "" ? $post['desc'] : null;
                $this->db->insert('pembayaran', $params); */
        }

        public function edit($post)
        {
            $params = [
                'name' => $post['pembayaran_name'],
                'updated' => date('Y-m-d H:i:s')
            ];
            $this->db->where('pembayaran_id', $post['id']);
            $this->db->update('pembayaran', $params);

        }

        public function del($id)
        {

                $this->db->where('pembayaran_id', $id);
                $this->db->delete('pembayaran');
        }
}
