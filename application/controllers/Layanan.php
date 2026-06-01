<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Layanan');
	}

	public function index()
	{
		$data['pages'] = 'pages/v_layanan';
		$this->load->view('wrapper', $data);
	}

	public function getData()
	{
		$results = $this->M_Layanan->get_datatables();
		$data    = [];

		foreach ($results as $i => $r) {
			$badgeActive = $r->is_active
				? "<span class='badge text-success-emphasis bg-success-subtle'>Aktif</span>"
				: "<span class='badge text-secondary-emphasis bg-secondary-subtle'>Nonaktif</span>";

			$data[] = [
				$i + 1,
				$r->nama_layanan,
				'Rp ' . number_format($r->harga_per_kg, 0, ',', '.'),
				$badgeActive,
				date('d M Y H:i', strtotime($r->created_at)),
				"<a href='#' class='btn btn-sm btn-outline-warning' onclick='editLayanan(" . $r->id . ")'>
                    <i class='ti ti-pencil'></i>
                 </a>
                 <a href='#' class='btn btn-sm btn-outline-danger' onclick='deleteLayanan(" . $r->id . ")'>
                    <i class='ti ti-trash'></i>
                 </a>",
			];
		}

		$output = [
			'draw'            => intval($_POST['draw'] ?? 0),
			'recordsTotal'    => $this->M_Layanan->count_all(),
			'recordsFiltered' => $this->M_Layanan->count_filtered(),
			'data'            => $data,
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}

	public function getLayanan()
	{
		$id      = $this->input->post('id');
		$layanan = $this->M_Layanan->get_by_id($id);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($layanan));
	}

	public function simpan()
	{
		$data = [
			'nama_layanan' => $this->input->post('nama_layanan'),
			'harga_per_kg' => $this->input->post('harga_per_kg') ?: 0,
			'is_active'    => $this->input->post('is_active') ?? 1,
		];

		if ($this->M_Layanan->insert($data)) {
			echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil ditambahkan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan layanan']);
		}
	}

	public function update()
	{
		$id   = $this->input->post('id');
		$data = [
			'nama_layanan' => $this->input->post('nama_layanan'),
			'harga_per_kg' => $this->input->post('harga_per_kg') ?: 0,
			'is_active'    => $this->input->post('is_active') ?? 1,
		];

		if ($this->M_Layanan->update($id, $data)) {
			echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil diperbarui']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui layanan']);
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');

		if ($this->M_Layanan->delete($id)) {
			echo json_encode(['status' => 'success', 'message' => 'Layanan berhasil dihapus']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus layanan']);
		}
	}
}
