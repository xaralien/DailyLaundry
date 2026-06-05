<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Shuchkin\SimpleXLSXGen;

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

			// Hitung jumlah detail
			$jumlahDetail = $this->db->where('order_id', $r->id)->count_all_results('order_detail');

			$btnDetail = $jumlahDetail > 2
				? "<a href='#' class='btn btn-sm btn-outline-info me-1' onclick='detailOrder(" . $r->id . ")'><i class='ti ti-list-details'></i></a>"
				: '';


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
				$jumlahDetail > 2
					? "<span class='text-muted small'>" . $jumlahDetail . " layanan</span> " . $btnDetail
					: ($r->layanan_summary ?? '-'),
				$r->total_qty ?? '-',          // ganti dari berat_kg
				$r->detail_item ?? '-',
				'<span style="min-width:80px;display:inline-block" title="Rp ' . number_format($r->harga, 0, ',', '.') . '">' . 'Rp ' . round($r->harga / 1000) . 'k</span>',
				'<span style="min-width:80px;display:inline-block" title="Rp ' . number_format($r->debit, 0, ',', '.') . '">' . 'Rp ' . round($r->debit / 1000) . 'k</span>',
				$r->kredit > 0
					? '<span style="min-width:80px;display:inline-block" class="btn btn-sm btn-outline-danger" onclick="editOrder(' . $r->id . ')" title="Rp ' . number_format($r->kredit, 0, ',', '.') . '">' . 'Rp ' . round($r->kredit / 1000) . 'k</span>'
					: '<span style="min-width:80px;display:inline-block" class="btn btn-sm btn-outline-success" title="LUNAS">LUNAS</span>',
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

		$updateData = ['status' => $status];

		// Jika diambil dan ada pembayaran tambahan
		if ($status === 'diambil') {
			$tambahDebit = (float) ($this->input->post('tambah_debit') ?? 0);
			$kreditBaru  = (float) ($this->input->post('kredit_baru')  ?? 0);

			if ($tambahDebit > 0) {
				// Ambil debit lama lalu tambah
				$order = $this->M_Laundry->get_order_by_id($id);
				$updateData['debit']  = ($order->debit ?? 0) + $tambahDebit;
				$updateData['kredit'] = $kreditBaru;
			}
		}

		if ($this->M_Laundry->update_order($id, $updateData)) {
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

	public function export()
	{
		require_once APPPATH . 'third_party/SimpleXLSXGen.php';

		$dari   = $this->input->get('dari')   ?: date('Y-m-d');
		$sampai = $this->input->get('sampai') ?: date('Y-m-d');

		$results = $this->M_Laundry->get_export($dari, $sampai);

		$tglDari   = date('d/m/Y', strtotime($dari));
		$tglSampai = date('d/m/Y', strtotime($sampai));

		$fmt = function ($val) {
			return '<top><style border="thin" align="right">Rp. ' . number_format((float)$val, 0, ',', '.') . '</style></top>';
		};

		$fmtQty = function ($val) {
			$num = rtrim(rtrim(number_format((float)$val, 2, ',', '.'), '0'), ',');
			return '<top><style border="thin" align="right">' . $num . '</style></top>';
		};

		$data = [];

		// =============================================
		// TITLE
		// =============================================
		// Title rows — 16 kolom
		$data[] = ['<b>LAPORAN LAUNDRY INERBANG</b>', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
		$data[] = ["Periode: $tglDari s/d $tglSampai", '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
		$data[] = ['Dicetak: ' . date('d/m/Y H:i'), '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
		$data[] = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];

		// =============================================
		// HEADER — bgcolor biru, teks putih, bold, border
		// =============================================
		$h = function ($text) {
			return '<style bgcolor="#378ADD" color="#FFFFFF" border="thin">' . '<b>' . $text . '</b>' . '</style>';
		};

		$data[] = [
			$h('No'),
			$h('Order ID'),
			$h('No Nota'),
			$h('Nama Customer'),
			$h('Tgl Masuk'),
			$h('Tgl Selesai'),
			$h('Layanan'),
			$h('Total Qty'),
			$h('Detail Item'),
			$h('Delivery'),
			$h('Harga'),
			$h('Biaya Delivery'),
			$h('Total'),
			$h('Dibayar'),
			$h('Sisa'),
			$h('Status'),
		];

		// =============================================
		// DATA — border thin, top align, wrap text
		// =============================================
		$no           = 1;
		$totalHarga   = 0;
		$totalDibayar = 0;
		$totalSisa    = 0;
		$totalBiayaDelivery = 0;  // tambah

		foreach ($results as $r) {
			$details    = $this->M_Laundry->get_order_details($r->id);
			$layananStr = '';
			foreach ($details as $d) {
				$layananStr .= $d->nama_layanan . ' (' . $d->qty . ' ' . $d->satuan . ')';
				if ($d->catatan) $layananStr .= ' - ' . $d->catatan;
				$layananStr .= "\n";
			}

			$totalHarga   += (float) $r->harga;
			$totalDibayar += (float) $r->debit;
			$totalSisa    += (float) $r->kredit;
			$totalBiayaDelivery += (float) $r->biaya_delivery;  // tambah

			// Wrap teks + top align + border untuk setiap cell
			$c = function ($val, $wrap = false, $align = 'left') {
				$inner = $wrap ? '<wraptext>' . $val . '</wraptext>' : $val;
				return '<top><style border="thin" align="' . $align . '">' . $inner . '</style></top>';
			};

			$data[] = [
				$c($no++),
				$c('#' . str_pad($r->id, 3, '0', STR_PAD_LEFT)),
				$c($r->no_nota),
				$c($r->nama_customer),
				$c(date('d/m/Y', strtotime($r->tgl_masuk))),
				$c($r->tgl_selesai ? date('d/m/Y', strtotime($r->tgl_selesai)) : '-'),
				$c(trim($layananStr), true),
				$fmtQty($r->total_qty),                                        // tanpa $c
				$c($r->detail_item ?? '-'),
				$c($r->is_delivery ? 'Ya' : 'Tidak'),
				$fmt((float)$r->harga - (float)$r->biaya_delivery),           // tanpa $c
				$fmt($r->biaya_delivery),                                       // tanpa $c
				$fmt($r->harga),                                                // tanpa $c
				$fmt($r->debit),                                                // tanpa $c
				$fmt($r->kredit),                                               // tanpa $c
				$c(ucwords(str_replace('_', ' ', $r->status))),
			];
		}

		// =============================================
		// TOTAL ROW
		// =============================================
		$t = function ($val, $align = 'left') {
			return '<style bgcolor="#EEF4FF" border="thin" align="' . $align . '"><b>' . $val . '</b></style>';
		};

		// Sheet 1 total
		$data[] = [
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t('TOTAL'),
			$t(''),
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($totalHarga - $totalBiayaDelivery, 0, ',', '.') . '</b></style>',
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($totalBiayaDelivery, 0, ',', '.') . '</b></style>',
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($totalHarga, 0, ',', '.') . '</b></style>',
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($totalDibayar, 0, ',', '.') . '</b></style>',
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($totalSisa, 0, ',', '.') . '</b></style>',
			$t(''),
		];

		// =============================================
		// BUILD XLSX
		// =============================================
		$xlsx = SimpleXLSXGen::fromArray($data);

		$xlsx->mergeCells('A1:P1');
		$xlsx->mergeCells('A2:P2');
		$xlsx->mergeCells('A3:P3');

		$xlsx->setColWidth(1, 5);
		$xlsx->setColWidth(2, 10);
		$xlsx->setColWidth(3, 18);
		$xlsx->setColWidth(4, 20);
		$xlsx->setColWidth(5, 13);
		$xlsx->setColWidth(6, 13);
		$xlsx->setColWidth(7, 35);
		$xlsx->setColWidth(8, 10);
		$xlsx->setColWidth(9, 20);
		$xlsx->setColWidth(10, 10); // Delivery
		$xlsx->setColWidth(11, 14); // Harga
		$xlsx->setColWidth(12, 15); // Biaya Delivery
		$xlsx->setColWidth(13, 14); // Total
		$xlsx->setColWidth(14, 14); // Dibayar
		$xlsx->setColWidth(15, 14); // Sisa
		$xlsx->setColWidth(16, 15); // Status

		// =============================================
		// SHEET 2 — REKAP PER ORDER
		// =============================================

		$data2 = [];

		$data2[] = ['<b>REKAP PER ORDER PER LAYANAN</b>', '', '', '', '', '', '', ''];
		$data2[] = ["Periode: $tglDari s/d $tglSampai", '', '', '', '', '', '', ''];
		$data2[] = ['', '', '', '', '', '', '', ''];

		$data2[] = [
			$h('No'),
			$h('No Nota'),
			$h('Nama Customer'),
			$h('Layanan'),
			$h('Qty'),
			$h('Satuan'),
			$h('Harga/Satuan'),
			$h('Subtotal'),
		];

		$no2         = 1;
		$grandSubtotal = 0;

		foreach ($results as $r) {
			$details = $this->M_Laundry->get_order_details($r->id);

			foreach ($details as $d) {
				$subtotal       = (float) $d->qty * (float) $d->harga_satuan;
				$grandSubtotal += $subtotal;

				$data2[] = [
					$c($no2++),
					$c($r->no_nota),
					$c($r->nama_customer),
					$c($d->nama_layanan),
					$fmtQty($d->qty),        // tanpa $c
					$c($d->satuan),
					$fmt($d->harga_satuan),  // tanpa $c
					$fmt($subtotal),          // tanpa $c
				];
			}
		}

		$data2[] = [
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t(''),
			$t('TOTAL'),
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($grandSubtotal, 0, ',', '.') . '</b></style>',
		];

		$xlsx->addSheet($data2, 'Detail Per Layanan');

		$xlsx->setColWidth(1, 5);
		$xlsx->setColWidth(2, 18);
		$xlsx->setColWidth(3, 20);
		$xlsx->setColWidth(4, 20);
		$xlsx->setColWidth(5, 10);
		$xlsx->setColWidth(6, 10);
		$xlsx->setColWidth(7, 15);
		$xlsx->setColWidth(8, 15);

		$xlsx->mergeCells('A1:H1');
		$xlsx->mergeCells('A2:H2');

		// =============================================
		// SHEET 3 — REKAP PER LAYANAN
		// =============================================
		$rekapLayanan = $this->M_Laundry->get_rekap_per_layanan($dari, $sampai);

		$data3 = [];

		// Title
		$data3[] = ['<b>REKAP PER LAYANAN</b>', '', '', '', ''];
		$data3[] = ["Periode: $tglDari s/d $tglSampai", '', '', '', ''];
		$data3[] = ['', '', '', '', ''];

		// Header
		$data3[] = [
			$h('No'),
			$h('Layanan'),
			$h('Satuan'),
			$h('Total Qty'),
			$h('Total Harga'),
		];

		$no2         = 1;
		$grandQty    = 0;
		$grandHarga  = 0;

		foreach ($rekapLayanan as $rl) {
			$grandQty   += (float) $rl->total_qty;
			$grandHarga += (float) $rl->total_harga;

			$data3[] = [
				$c($no2++),
				$c($rl->nama_layanan),
				$c($rl->satuan),
				$fmtQty($rl->total_qty),  // tanpa $c
				$fmt($rl->total_harga),   // tanpa $c
			];
		}

		// Sheet 3 total
		$data3[] = [
			$t(''),
			$t('TOTAL'),
			$t(''),
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>' . rtrim(rtrim(number_format($grandQty, 2, ',', '.'), '0'), ',') . '</b></style>',
			'<style bgcolor="#EEF4FF" border="thin" align="right"><b>Rp. ' . number_format($grandHarga, 0, ',', '.') . '</b></style>',
		];

		$xlsx->addSheet($data3, 'Rekap Layanan');

		$xlsx->setColWidth(1, 5);
		$xlsx->setColWidth(2, 25);
		$xlsx->setColWidth(3, 10);
		$xlsx->setColWidth(4, 12);
		$xlsx->setColWidth(5, 15);

		$xlsx->mergeCells('A1:E1');
		$xlsx->mergeCells('A2:E2');



		$namaFile = 'Laporan_Laundry_' . date('d-m-Y', strtotime($dari)) . '_sd_' . date('d-m-Y', strtotime($sampai));
		$xlsx->downloadAs($namaFile . '.xlsx');
	}
}
