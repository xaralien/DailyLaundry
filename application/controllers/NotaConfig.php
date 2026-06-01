<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotaConfig extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('NotaConfigModel', 'notaConfig');
	}

	public function index()
	{
		$data['config'] = $this->notaConfig->getConfigRow();
		$data['pages']  = 'pages/v_nota_config';
		$this->load->view('wrapper', $data);
	}

	public function getConfig()
	{
		$config = $this->notaConfig->getConfigRow();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($config));
	}

	public function update()
	{
		$data = [
			'prefix'     => $this->input->post('prefix'),
			'sep'        => $this->input->post('sep'),
			'use_year'   => $this->input->post('use_year')  ?? 0,
			'use_month'  => $this->input->post('use_month') ?? 0,
			'padding'    => $this->input->post('padding'),
			'counter'    => $this->input->post('counter'),
			'auto_reset' => $this->input->post('auto_reset'),
		];

		$this->notaConfig->updateConfig($data);
		echo json_encode(['status' => 'success', 'message' => 'Konfigurasi berhasil disimpan']);
	}
}
