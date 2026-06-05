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
		$year    = date('Y'); // default tahun ini

		$data['pages']            = 'pages/v_home';
		$data['orderan_hari_ini'] = $summary['orderan_hari_ini'];
		$data['diambil']          = $summary['diambil'];
		$data['penghasilan']      = $this->M_Home->get_penghasilan();

		$data['debit']  = $this->M_Home->get_debit($year);
		$data['credit'] = $this->M_Home->get_credit($year);

		$income  = $this->M_Home->get_income_per_bulan($year);
		$kredit  = $this->M_Home->get_kredit_per_bulan($year);
		$layanan = $this->M_Home->get_order_per_layanan();

		$total_semua = array_sum(array_map(fn($r) => (int)$r->total, $layanan));
		$data['total_semua_layanan'] = $total_semua;

		$layanan_labels = [];
		$layanan_series = [];
		foreach ($layanan as $l) {
			$l->persen       = $total_semua > 0 ? round(($l->total / $total_semua) * 100, 1) : 0;
			$layanan_labels[] = $l->nama_layanan;
			$layanan_series[] = (int)$l->total;
		}

		$data['layanan']              = $layanan;
		$data['chart_income']         = json_encode($income);
		$data['chart_kredit']         = json_encode($kredit);
		$data['chart_layanan_label']  = json_encode($layanan_labels);
		$data['chart_layanan_series'] = json_encode($layanan_series);
		$data['selected_year']        = $year;
		$data['available_years']      = $this->M_Home->get_available_years();

		$this->load->view('wrapper', $data);
	}

	// Endpoint AJAX untuk ganti tahun
	public function get_chart_by_year()
	{
		$year  = $this->input->get('year') ?: date('Y');
		$year  = (int)$year; // sanitasi

		$income = $this->M_Home->get_income_per_bulan($year);
		$kredit = $this->M_Home->get_kredit_per_bulan($year);
		$debit  = $this->M_Home->get_debit($year);
		$credit = $this->M_Home->get_credit($year);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'income' => $income,
				'kredit' => $kredit,
				'debit'  => $debit,
				'credit' => $credit,
			]));
	}
}
