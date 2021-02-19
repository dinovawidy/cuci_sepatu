<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pemesanan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('pemesanan_m');
	}

	public function index()
	{
		$data['row'] = $this->pemesanan_m->get();
		$this->template->load('template', 'status/pemesanan/pemesanan_data', $data);
	}

	/*public function add()
	{
		$pemesanan = new stdClass();
		$pemesanan->pemesanan_id = null;
		$pemesanan->name = null;
		$pemesanan->phone = null;
		$pemesanan->address = null;
		$pemesanan->description = null;
		$data = array(
			'page' => 'add',
			'row' => $pemesanan
		);
		$this->template->load('template', 'pemesanan/pemesanan_form', $data);
	}*/

	public function add()
	{
		$pemesanan = new stdClass();
		$pemesanan->pemesanan_id = null;
		$pemesanan->name = null;
		$data = array(
			'page' => 'add',
			'row' => $pemesanan
		);
		$this->template->load('template', 'status/pemesanan/pemesanan_form', $data);
	}


	public function edit($id)
	{
		$query = $this->pemesanan_m->get($id);
		if ($query->num_rows() > 0) {
			$pemesanan = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $pemesanan
		);
		$this->template->load('template', 'status/pemesanan/pemesanan_form', $data);
		} else {
			echo "<script>alert('Data Tidak Ditemukan');</script>";
			redirect('pemesanan');
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->pemesanan_m->add($post);
		} else if (isset($_POST['edit'])) {
			$this->pemesanan_m->edit($post);
		}
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil disimpan');        
		}
		redirect('pemesanan');	
	}


	public function del($id)
	{
		$this->pemesanan_m->del($id);
		if ($this->db->affected_rows() > 0 ) {
				$this->session->set_flashdata('success', 'Data Berhasil dihapus');
        }
        redirect('pemesanan'); //redirect
	}
}
  