<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bahan_m extends CI_Model {


        public function get($id = null)
        {
                $this->db->from('bahan');
                if($id != null) {
                        $this->db->where('bahan_id', $id);
                }
                $query = $this->db->get();
                return $query;
        }

        /*public function add($post)
        {
            $params = [
                'name' => $post['bahan_name'],
                'phone' => $post['phone'],
                'address' => $post['addr'],
                'description' => empty($post['desc']) ? null : $post['desc'],
            ];
            $this->db->insert('bahan', $params);
        }*/

        public function add($post)
        {
            $params = [
                'name' => $post['bahan_name'],
            ];
            $this->db->insert('bahan', $params);

                /*$params['name'] = $post['bahan_name'];
                $params['phone'] = $post['phone'];
                $params['address'] = ($post['addr']);
                $params['description'] = $post['desc'] != "" ? $post['desc'] : null;
                $this->db->insert('bahan', $params); */
        }

        public function edit($post)
        {
            $params = [
                'name' => $post['bahan_name'],
                'updated' => date('Y-m-d H:i:s')
            ];
            $this->db->where('bahan_id', $post['id']);
            $this->db->update('bahan', $params);

        }

        public function del($id)
        {

                $this->db->where('bahan_id', $id);
                $this->db->delete('bahan');
        }
}
