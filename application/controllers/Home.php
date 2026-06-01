<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['NotaConfigModel', 'M_Home']);
	}

	public function index()
	{
		$summary = $this->M_Home->get_summary();

		$data['pages'] = 'pages/v_home';
		$data['orderan_hari_ini'] = $summary['orderan_hari_ini'];
		$data['diambil']         = $summary['diambil'];
		$data['penghasilan']     = $this->M_Home->get_penghasilan();

		$data['debit']     = $this->M_Home->get_debit();
		$data['credit']     = $this->M_Home->get_credit();

		$income  = $this->M_Home->get_income_per_bulan();
		$kredit  = $this->M_Home->get_kredit_per_bulan();
		$layanan = $this->M_Home->get_order_per_layanan();

		$total_semua = array_sum(array_map(fn($r) => (int)$r->total, $layanan));
		$data['total_semua_layanan'] = $total_semua;

		// tambahkan persentase ke setiap item
		foreach ($layanan as $l) {
			$l->persen = $total_semua > 0 ? round(($l->total / $total_semua) * 100, 1) : 0;
		}

		$data['layanan'] = $layanan; // pastikan ini yang dikirim ke view

		$data['chart_income']  = json_encode($income);
		$data['chart_kredit']  = json_encode($kredit);
		$data['chart_layanan_label']  = json_encode(array_column($layanan, 'nama_layanan'));
		$data['chart_layanan_series'] = json_encode(array_column($layanan, 'total'));

		$this->load->view('wrapper', $data);
	}
}
