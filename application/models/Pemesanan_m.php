<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pemesanan_m extends CI_Model {


        public function get($id = null)
        {
                $this->db->from('pemesanan');
                if($id != null) {
                        $this->db->where('pemesanan_id', $id);
                }
                $query = $this->db->get();
                return $query;
        }

        /*public function add($post)
        {
            $params = [
                'name' => $post['pemesanan_name'],
                'phone' => $post['phone'],
                'address' => $post['addr'],
                'description' => empty($post['desc']) ? null : $post['desc'],
            ];
            $this->db->insert('pemesanan', $params);
        }*/

        public function add($post)
        {
            $params = [
                'name' => $post['pemesanan_name'],
            ];
            $this->db->insert('pemesanan', $params);

                /*$params['name'] = $post['pemesanan_name'];
                $params['phone'] = $post['phone'];
                $params['address'] = ($post['addr']);
                $params['description'] = $post['desc'] != "" ? $post['desc'] : null;
                $this->db->insert('pemesanan', $params); */
        }

        public function edit($post)
        {
            $params = [
                'name' => $post['pemesanan_name'],
                'updated' => date('Y-m-d H:i:s')
            ];
            $this->db->where('pemesanan_id', $post['id']);
            $this->db->update('pemesanan', $params);

        }

        public function del($id)
        {

                $this->db->where('pemesanan_id', $id);
                $this->db->delete('pemesanan');
        }
}
