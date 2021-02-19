<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class paket extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model(['paket_m', 'category_m', 'bahan_m']);
	}

	function get_ajax() {
        $list = $this->paket_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $paket) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $paket->barcode.'<br><a href="'.site_url('paket/barcode_qrcode/'.$paket->paket_id).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $paket->name;
            $row[] = $paket->category_name;
            $row[] = $paket->bahan_name;
            $row[] = indo_currency($paket->price);
            //add html for action
            $row[] = '<a href="'.site_url('paket/edit/'.$paket->paket_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('paket/del/'.$paket->paket_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->paket_m->count_all(),
                    "recordsFiltered" => $this->paket_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{
		$data['row'] = $this->paket_m->get();
		$this->template->load('template', 'list_paket/paket/paket_data', $data);
	}

	/*public function add()
	{
		$paket = new stdClass();
		$paket->paket_id = null;
		$paket->name = null;
		$paket->phone = null;
		$paket->address = null;
		$paket->description = null;
		$data = array(
			'page' => 'add',
			'row' => $paket
		);
		$this->template->load('template', 'paket/paket_form', $data);
	}*/

	public function add()
	{
		$paket = new stdClass();
		$paket->paket_id = null;
		$paket->barcode = null;
		$paket->name = null;
		$paket->price = null;
		$paket->category_id = null;

		$query_category = $this->category_m->get();

		$query_bahan = $this->bahan_m->get();
		$bahan[null] = '== Pilih ==';
		foreach ($query_bahan->result() as $unt) {
			$bahan[$unt->bahan_id] = $unt->name;
		}
		$data = array(
			'page' => 'add',
			'row' => $paket,
			'category' => $query_category,
			'bahan' => $bahan, 'selectedbahan' => null,
		);
		$this->template->load('template', 'list_paket/paket/paket_form', $data);
	}


	public function edit($id)
	{
		$query = $this->paket_m->get($id);
		if ($query->num_rows() > 0) {
			$paket = $query->row();
			$query_category = $this->category_m->get();

			$query_bahan = $this->bahan_m->get();
			$bahan[null] = '== Pilih ==';
		foreach ($query_bahan->result() as $unt) {
			$bahan[$unt->bahan_id] = $unt->name;
		}
		$data = array(
			'page' => 'edit',
			'row' => $paket,
			'category' => $query_category,
			'bahan' => $bahan, 'selectedbahan' => $paket->bahan_id,
		);
		$this->template->load('template', 'list_product/paket/paket_form', $data);
		} else {
			echo "<script>alert('Data Tidak Dpaketukan');</script>";
			redirect('paket');
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			if($this->paket_m->check_barcode($post['barcode'])->num_rows() > 0 ) {
				$this->session->set_flashdata('error', "Barcode $post[barcode] sudah digunakan paket lain");
			redirect('paket/add');	
			} else {
				//helper file code igniter
				$config['upload_path']          = './uploads/product';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['file_name']			= 'paket-'.date('ymd').'-'.substr(md5(rand()),0,10);

                $this->load->library('upload', $config);

				if(@$_FILES['image']['name'] != null) {
					if ($this->upload->do_upload('image')) {
						$post['image'] = $this->upload->data('file_name');
						$this->paket_m->add($post);
						if ($this->db->affected_rows() > 0 ) {
							 $this->session->set_flashdata('success', 'Data Berhasil disimpan');        
						}
						redirect('paket');
				
							
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('paket/add');
				}
			}else {
				$post['image'] = $this->upload->data('file_name');
					$this->paket_m->add($post);
					if ($this->db->affected_rows() > 0 ) {
							 $this->session->set_flashdata('success', 'Data Berhasil disimpan');        
					}
					redirect('paket');
			}
		}
	}	else if (isset($_POST['edit'])) {
			if($this->paket_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0 ) {
				$this->session->set_flashdata('error', "Barcode $post[barcode] sudah digunakan barang lain");
			redirect('paket/edit/' .$post['id']);	
			} else {
								//helper file code igniter
				$config['upload_path']          = './uploads/product';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['file_name']			= 'paket-'.date('ymd').'-'.substr(md5(rand()),0,10);

                $this->load->library('upload', $config);

				/*if(@$_FILES['image']['name'] != null) {
					if ($this->upload->do_upload('image')) {

						$paket = $this->paket_m->get($post['id'])->row();
                        if($paket->image != null) {
                            $target_file = './uploads/product/'.$paket->image;
                            unlink($target_file);
                        }

						$post['image'] = $this->upload->data('file_name');
						$this->paket_m->edit($post);
						if ($this->db->affected_rows() > 0 ) {
							 $this->session->set_flashdata('success', 'Data Berhasil disimpan');        
						}
						redirect('paket');
				
							
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect('paket/add');
				}
			}*/ /*else {
				$post['image'] = $this->upload->data('file_name');
					$this->paket_m->edit($post);
					if ($this->db->affected_rows() > 0 ) {
							 $this->session->set_flashdata('success', 'Data Berhasil disimpan');        
					}
					redirect('paket');
			}*/
			//$this->paket_m->edit($post);
			}
		}
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil disimpan');        
		}
		redirect('paket');	
	}


	public function del($id)
	{
		/*$paket = $this->paket_m->get($id)->row();*/
		/*if($paket->image != null) {
		$target_file = './uploads/product/'.$paket->image;
		unlink($target_file);
		}*/
		$this->paket_m->del($id);
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('paket'); //redirect

	}

	function barcode_qrcode($id)
	{
		$data['row'] = $this->paket_m->get($id)->row();
		$this->template->load('template', 'product/paket/barcode_qrcode', $data);
	}

	function barcode_print($id)
	{
		$data['row'] = $this->paket_m->get($id)->row();
		$html = $this->load->view('product/paket/barcode_print', $data, true);
		$this->fungsi->PdfGenerator($html, 'barcode-'.$data['row']->barcode, 'A4', 'landscape');
	}

	function qrcode_print($id)
	{
		$data['row'] = $this->paket_m->get($id)->row();
		$html = $this->load->view('product/paket/qrcode_print',$data, true);
		$this->fungsi->PdfGenerator($html, 'qrcode-'.$data['row']->barcode, 'A4', 'landscape');
	}
}
  