<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index()
	{
		check_not_login();

		$query = $this->db->query("SELECT transaksi_detail.paket_id, paket.name, (SELECT SUM(transaksi_detail.qty)) AS sold 
			FROM transaksi_detail
				INNER JOIN transaksi ON transaksi_detail.transaksi_id = transaksi.transaksi_id
				INNER JOIN paket ON transaksi_detail.paket_id = paket.paket_id
			GROUP BY transaksi_detail.paket_id
			ORDER BY sold DESC
			LIMIT 10");

		$data['row'] = $query->result();
		$this->template->load('template', 'dashboard', $data);
	}
} 
