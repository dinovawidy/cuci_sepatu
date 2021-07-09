<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_m');
	}

	public function index()
	{
		$this->load->model(['customer_m', 'paket_m']);
		$customer = $this->customer_m->get()->result();
		$paket = $this->paket_m->get()->result();
		$cart = $this->transaksi_m->get_cart();
		$data = array(
			'customer' => $customer,
			'paket' => $paket,
			'cart' => $cart,
			'invoice' => $this->transaksi_m->invoice_no(),
		);
		$this->template->load('template', 'transaction/transaction_form', $data);
	}

	public function process()
	{
		$data = $this->input->post(null, TRUE);

		if(isset($_POST['add_cart'])) {
			$this->transaksi_m->add_cart($data);		

			if($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}
}