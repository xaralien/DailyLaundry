<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laundry extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['NotaConfigModel', 'M_Laundry']);
	}

	public function index()
	{
		$summary = $this->M_Laundry->get_summary();

		$data['nextNota']        = $this->NotaConfigModel->getNextNota();
		$data['layanan']         = $this->M_Laundry->get_layanan();
		$data['orderan_hari_ini'] = $summary['orderan_hari_ini'];
		$data['belum_diproses']  = $summary['belum_diproses'];
		$data['cnt_cuci']        = $summary['cuci'];
		$data['cnt_kering']      = $summary['kering'];
		$data['belum_diambil']   = $summary['belum_diambil'];
		$data['diambil']         = $summary['diambil'];
		$data['pages']           = 'pages/v_laundry';
		$this->load->view('wrapper', $data);
	}

	public function getData()
	{
		$results = $this->M_Laundry->get_datatables();
		$data    = [];

		foreach ($results as $r) {
			$statusClass = match ($r->status) {
				'proses'       => 'text-info-emphasis bg-info-subtle',
				'cuci'         => 'text-primary-emphasis bg-primary-subtle',
				'kering'       => 'text-warning-emphasis bg-warning-subtle',
				'belum diambil' => 'text-danger-emphasis bg-danger-subtle',
				'diambil'      => 'text-success-emphasis bg-success-subtle',
				'batal'        => 'text-secondary-emphasis bg-secondary-subtle',
				default        => 'text-secondary-emphasis bg-secondary-subtle',
			};

			$delivery = $r->is_delivery
				? "<span class='badge text-primary-emphasis bg-primary-subtle'>
            <i class='ti ti-truck me-1'></i>Delivery
       </span> <small class='text-muted'>Rp " . number_format($r->biaya_delivery, 0, ',', '.') . "</small>"
				: "<span class='badge text-secondary-emphasis bg-secondary-subtle'>Ambil Sendiri</span>";

			if ($r->status == 'proses') {
				$btn_prosses = "<a href='#' class='btn btn-sm btn-outline-primary' onclick='processOrder(" . $r->id . ", \"cuci\")'>Proses</a> ";
			} elseif ($r->status == 'cuci') {
				$btn_prosses = "<a href='#' class='btn btn-sm btn-outline-primary' onclick='processOrder(" . $r->id . ", \"kering\")'>Proses</a> ";
			} elseif ($r->status == 'kering') {
				$btn_prosses = "<a href='#' class='btn btn-sm btn-outline-primary' onclick='processOrder(" . $r->id . ", \"belum_diambil\")'>Proses</a> ";
			} elseif ($r->status == 'belum_diambil') {
				$btn_prosses = "<a href='#' class='btn btn-sm btn-outline-primary' onclick='processOrder(" . $r->id . ", \"diambil\")'>Proses</a> ";
			} else {
				$btn_prosses = "";
			}
			$data[] = [
				'#' . str_pad($r->id, 3, '0', STR_PAD_LEFT),
				date('d M Y', strtotime($r->tgl_masuk)),
				$r->tgl_selesai ? date('d M Y', strtotime($r->tgl_selesai)) : '-',
				$r->no_nota,
				$r->nama_customer,
				$r->layanan_summary ?? '-',   // ganti dari nama_layanan
				$r->total_qty ?? '-',          // ganti dari berat_kg
				$r->detail_item ?? '-',
				'<span title="Rp ' . number_format($r->harga, 0, ',', '.') . '">' . 'Rp ' . round($r->harga / 1000) . 'k</span>',
				'<span title="Rp ' . number_format($r->debit, 0, ',', '.') . '">' . 'Rp ' . round($r->debit / 1000) . 'k</span>',
				'<span title="Rp ' . number_format($r->kredit, 0, ',', '.') . '">' . 'Rp ' . round($r->kredit / 1000) . 'k</span>',
				$delivery,
				"<span class='badge {$statusClass}'>" . ucwords(str_replace('_', ' ', $r->status)) . "</span>",
				$btn_prosses . "<a href='#' class='btn btn-sm btn-outline-warning' onclick='editOrder(" . $r->id . ")'>Edit</a> <a href='#' class='btn btn-sm btn-outline-danger' onclick='deleteOrder(" . $r->id . ")'>Delete</a>",
			];
		}

		$output = [
			'draw'            => intval($_POST['draw'] ?? 0),
			'recordsTotal'    => $this->M_Laundry->count_all(),
			'recordsFiltered' => $this->M_Laundry->count_filtered(),
			'data'            => $data,
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}

	// public function simpan()
	// {
	// 	$data = [
	// 		'no_nota'       => $this->input->post('no_nota'),
	// 		'nama_customer' => $this->input->post('nama_customer'),
	// 		'layanan_id'    => $this->input->post('layanan_id'),
	// 		'is_delivery'    => $this->input->post('is_delivery')    ?? 0,
	// 		'biaya_delivery' => $this->input->post('biaya_delivery') ?? 0,
	// 		'tgl_masuk'     => $this->input->post('tgl_masuk'),
	// 		'tgl_selesai'   => $this->input->post('tgl_selesai') ?: null,
	// 		'berat_kg'      => $this->input->post('berat_kg'),
	// 		'detail_item'   => $this->input->post('detail_item'),
	// 		'harga'         => $this->input->post('harga') ?: 0,
	// 		'debit'         => $this->input->post('debit') ?: 0,
	// 		'kredit'        => $this->input->post('kredit') ?: 0,
	// 		'catatan'       => $this->input->post('catatan'),
	// 		'status'        => $this->input->post('status'),
	// 	];

	// 	if ($this->M_Laundry->insert_order($data)) {
	// 		$this->NotaConfigModel->incrementCounter();
	// 		echo json_encode(['status' => 'success', 'message' => 'Order berhasil disimpan']);
	// 	} else {
	// 		echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan order']);
	// 	}
	// }

	public function simpan()
	{
		$data = [
			'no_nota'        => $this->input->post('no_nota'),
			'nama_customer'  => $this->input->post('nama_customer'),
			'tgl_masuk'      => $this->input->post('tgl_masuk'),
			'tgl_selesai'    => $this->input->post('tgl_selesai') ?: null,
			'detail_item'    => $this->input->post('detail_item'),
			'harga'          => $this->input->post('harga')  ?: 0,
			'debit'          => $this->input->post('debit')  ?: 0,
			'kredit'         => $this->input->post('kredit') ?: 0,
			'catatan'        => $this->input->post('catatan'),
			'status'         => $this->input->post('status'),
			'is_delivery'    => $this->input->post('is_delivery')    ?? 0,
			'biaya_delivery' => $this->input->post('biaya_delivery') ?? 0,
		];

		if ($this->M_Laundry->insert_order($data)) {
			$orderId       = $this->db->insert_id();
			$detailLayanan = json_decode($this->input->post('detail_layanan'), true);

			if (!empty($detailLayanan)) {
				foreach ($detailLayanan as $d) {
					$this->db->insert('order_detail', [
						'order_id'    => $orderId,
						'layanan_id'  => $d['layanan_id'],
						'qty'         => $d['qty'],
						'harga_satuan' => $d['harga_satuan'],
						'subtotal'    => $d['subtotal'],
						'catatan'     => $d['catatan'] ?? null,  // tambah
					]);
				}
			}

			$this->NotaConfigModel->incrementCounter();
			echo json_encode(['status' => 'success', 'message' => 'Order berhasil disimpan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan order']);
		}
	}
	public function getNextNota()
	{
		$nota = $this->NotaConfigModel->getNextNota();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['nota' => $nota]));
	}

	public function getHargaLayanan()
	{
		$id     = $this->input->post('id');
		$layanan = $this->db->where('id', $id)->get('layanan')->row();

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode([
				'harga_per_kg' => $layanan ? $layanan->harga_per_kg : 0
			]));
	}

	public function getOrder()
	{
		$id    = $this->input->post('id');
		$order = $this->M_Laundry->get_order_by_id($id);

		if (!$order) {
			echo json_encode(null);
			return;
		}

		// Ambil detail layanan
		$details = $this->M_Laundry->get_order_details($id);
		$order->details = $details;

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($order));
	}

	public function update()
	{
		$id   = $this->input->post('id');
		$data = [
			'no_nota'        => $this->input->post('no_nota'),
			'nama_customer'  => $this->input->post('nama_customer'),
			'tgl_masuk'      => $this->input->post('tgl_masuk'),
			'tgl_selesai'    => $this->input->post('tgl_selesai') ?: null,
			'detail_item'    => $this->input->post('detail_item'),
			'harga'          => $this->input->post('harga')  ?: 0,
			'debit'          => $this->input->post('debit')  ?: 0,
			'kredit'         => $this->input->post('kredit') ?: 0,
			'catatan'        => $this->input->post('catatan'),
			'status'         => $this->input->post('status'),
			'is_delivery'    => $this->input->post('is_delivery')    ?? 0,
			'biaya_delivery' => $this->input->post('biaya_delivery') ?? 0,
		];

		if ($this->M_Laundry->update_order($id, $data)) {
			// Hapus detail lama, insert baru
			$this->db->where('order_id', $id)->delete('order_detail');

			$detailLayanan = json_decode($this->input->post('detail_layanan'), true);
			if (!empty($detailLayanan)) {
				foreach ($detailLayanan as $d) {
					$this->db->insert('order_detail', [
						'order_id'    => $id,
						'layanan_id'  => $d['layanan_id'],
						'qty'         => $d['qty'],
						'harga_satuan' => $d['harga_satuan'],
						'subtotal'    => $d['subtotal'],
						'catatan'     => $d['catatan'] ?? null,  // tambah
					]);
				}
			}

			echo json_encode(['status' => 'success', 'message' => 'Order berhasil diperbarui']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui order']);
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');

		if ($this->M_Laundry->delete_order($id)) {
			echo json_encode(['status' => 'success', 'message' => 'Order berhasil dihapus']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus order']);
		}
	}

	public function processOrder()
	{
		$id     = $this->input->post('id');
		$status = $this->input->post('status');

		if ($this->M_Laundry->update_status($id, $status)) {
			echo json_encode(['status' => 'success', 'message' => 'Status berhasil diperbarui']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status']);
		}
	}

	public function getSummary()
	{
		$summary = $this->M_Laundry->get_summary();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($summary));
	}
}
