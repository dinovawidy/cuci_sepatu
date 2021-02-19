<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembayaran extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('pembayaran_m');
	}

	public function index()
	{
		$data['row'] = $this->pembayaran_m->get();
		$this->template->load('template', 'status/pembayaran/pembayaran_data', $data);
	}

	/*public function add()
	{
		$pembayaran = new stdClass();
		$pembayaran->pembayaran_id = null;
		$pembayaran->name = null;
		$pembayaran->phone = null;
		$pembayaran->address = null;
		$pembayaran->description = null;
		$data = array(
			'page' => 'add',
			'row' => $pembayaran
		);
		$this->template->load('template', 'pembayaran/pembayaran_form', $data);
	}*/

	public function add()
	{
		$pembayaran = new stdClass();
		$pembayaran->pembayaran_id = null;
		$pembayaran->name = null;
		$data = array(
			'page' => 'add',
			'row' => $pembayaran
		);
		$this->template->load('template', 'status/pembayaran/pembayaran_form', $data);
	}


	public function edit($id)
	{
		$query = $this->pembayaran_m->get($id);
		if ($query->num_rows() > 0) {
			$pembayaran = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $pembayaran
		);
		$this->template->load('template', 'status/pembayaran/pembayaran_form', $data);
		} else {
			echo "<script>alert('Data Tidak Ditemukan');</script>";
			redirect('pembayaran');
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->pembayaran_m->add($post);
		} else if (isset($_POST['edit'])) {
			$this->pembayaran_m->edit($post);
		}
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil disimpan');        
		}
		redirect('pembayaran');	
	}


	public function del($id)
	{
		$this->pembayaran_m->del($id);
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('pembayaran'); //redirect
	}
}
  