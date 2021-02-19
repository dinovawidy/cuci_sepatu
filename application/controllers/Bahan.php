<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bahan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('bahan_m');
	}

	public function index()
	{
		$data['row'] = $this->bahan_m->get();
		$this->template->load('template', 'list_paket/bahan/bahan_data', $data);
	}

	/*public function add()
	{
		$bahan = new stdClass();
		$bahan->bahan_id = null;
		$bahan->name = null;
		$bahan->phone = null;
		$bahan->address = null;
		$bahan->description = null;
		$data = array(
			'page' => 'add',
			'row' => $bahan
		);
		$this->template->load('template', 'bahan/bahan_form', $data);
	}*/

	public function add()
	{
		$bahan = new stdClass();
		$bahan->bahan_id = null;
		$bahan->name = null;
		$data = array(
			'page' => 'add',
			'row' => $bahan
		);
		$this->template->load('template', 'list_paket/bahan/bahan_form', $data);
	}


	public function edit($id)
	{
		$query = $this->bahan_m->get($id);
		if ($query->num_rows() > 0) {
			$bahan = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $bahan
		);
		$this->template->load('template', 'list_paket/bahan/bahan_form', $data);
		} else {
			echo "<script>alert('Data Tidak Ditemukan');</script>";
			redirect('bahan');
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->bahan_m->add($post);
		} else if (isset($_POST['edit'])) {
			$this->bahan_m->edit($post);
		}
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil disimpan');        
		}
		redirect('bahan');	
	}


	public function del($id)
	{
		$this->bahan_m->del($id);
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('bahan'); //redirect
	}
}
  