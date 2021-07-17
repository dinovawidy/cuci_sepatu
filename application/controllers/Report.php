<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('transaksi_m');
	}

	public function transaksi()
	{
		$this->load->model('customer_m');
		$this->load->library('pagination');

		if(isset($_POST['reset'])) {
			$this->session->unset_userdata('search');
		}
		if(isset($_POST['filter'])) {
			$post = $this->input->post(null, TRUE);
			$this->session->set_userdata('search', $post);
		} else {
			$post = $this->session->userdata('search');
		}

		
		$config['base_url'] = site_url('report/transaksi');
		$config['total_rows'] = $this->transaksi_m->get_transaksi_pagination()->num_rows();
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '<li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['customer'] = $this->customer_m->get()->result();
		$data['row'] = $this->transaksi_m->get_transaksi_pagination($config['per_page'], $this->uri->segment(3));
		$data['post'] = $post;
		$this->template->load('template', 'report/transaksi_report', $data);
	}

	public function transaksi_paket($transaksi_id = null)
	{
		$detail = $this->transaksi_m->get_transaksi_detail($transaksi_id)->result();
		echo json_encode($detail); 
	}

	
}
  