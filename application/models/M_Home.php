<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Home extends CI_Model
{
    private $table = 'orders';

    private $orderable = [
        0  => 'o.id',
        1  => 'o.tgl_masuk',
        2  => 'o.tgl_selesai',
        3  => 'o.no_nota',
        4  => 'o.nama_customer',
        5  => 'l.nama_layanan',
        6  => 'o.berat_kg',
        7  => 'o.detail_item',
        8  => 'o.harga',
        9 => 'o.debit',
        10 => 'o.kredit',
        11 => 'o.is_delivery',  // tambah
        12 => 'o.status',       // geser
    ];

    private function _base_query()
    {
        $this->db->select('o.*, l.nama_layanan')
            ->from('orders o')
            ->join('layanan l', 'l.id = o.layanan_id', 'left');

        // Search
        if (!empty($_POST['search']['value'])) {
            $search = $_POST['search']['value'];
            $this->db->group_start()
                ->like('o.no_nota', $search)
                ->or_like('o.nama_customer', $search)
                ->or_like('l.nama_layanan', $search)
                ->or_like('o.detail_item', $search)
                ->or_like('o.status', $search)
                ->group_end();
        }

        // Order
        $orderCol = $_POST['order'][0]['column'] ?? null;
        if ($orderCol !== null && !empty($this->orderable[$orderCol])) {
            $col = $this->orderable[$orderCol];
            $dir = ($_POST['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';
            $this->db->order_by($col, $dir);
        } else {
            $this->db->order_by('o.tgl_masuk', 'DESC');
        }
    }

    public function get_datatables()
    {
        $this->_base_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    public function count_filtered()
    {
        $this->_base_query();
        return $this->db->get()->num_rows();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_summary()
    {
        $today = date('Y-m-d');

        // Orderan masuk hari ini
        $orderan_hari_ini = $this->db
            ->where('DATE(tgl_selesai)', $today)
            ->where('status !=', 'batal')
            ->count_all_results($this->table);

        // Per status (semua data aktif)
        $statuses = ['proses', 'cuci', 'kering', 'belum_diambil', 'diambil'];
        $count    = [];
        foreach ($statuses as $s) {
            $count[$s] = $this->db
                ->where('DATE(tgl_selesai)', $today)
                ->where('status', $s)
                ->count_all_results($this->table);
        }

        // "Belum diproses" hari ini = masuk hari ini & status masih 'proses'
        $belum_diproses = $this->db
            ->where('DATE(tgl_selesai)', $today)
            ->where('status', 'proses')
            ->count_all_results($this->table);

        return [
            'orderan_hari_ini' => $orderan_hari_ini,
            'belum_diproses'   => $belum_diproses,
            'cuci'             => $count['cuci'],
            'kering'           => $count['kering'],
            'belum_diambil'    => $count['belum_diambil'],
            'diambil'          => $count['diambil'],
        ];
    }

    public function get_penghasilan()
    {
        $today = date('Y-m-d');

        $result = $this->db
            ->select_sum('debit')
            ->where('DATE(tgl_selesai)', $today)
            ->where('status', 'diambil')
            ->get($this->table)  // ← ini yang hilang
            ->row();

        return $result->debit ?? 0;
    }

    public function get_debit($year = null)
    {
        $year  = $year ?: date('Y');
        $month = date('m');

        $result = $this->db
            ->select_sum('debit')
            ->where('MONTH(tgl_selesai)', $month)
            ->where('YEAR(tgl_selesai)', $year)
            ->where('status', 'diambil')
            ->get($this->table)
            ->row();

        return $result->debit ?? 0;
    }

    public function get_credit($year = null)
    {
        $year  = $year ?: date('Y');
        $month = date('m');

        $result = $this->db
            ->select_sum('kredit')
            ->where('MONTH(tgl_selesai)', $month)
            ->where('YEAR(tgl_selesai)', $year)
            ->where('status', 'diambil')
            ->get($this->table)
            ->row();

        return $result->kredit ?? 0;
    }

    public function get_income_per_bulan($year = null)
    {
        $year = $year ?: date('Y');

        $result = $this->db
            ->select("MONTH(tgl_selesai) as bulan, SUM(debit) as total")
            ->where('YEAR(tgl_selesai)', $year)
            ->where('status', 'diambil')
            ->group_by('MONTH(tgl_selesai)')
            ->get($this->table)
            ->result();

        $data = array_fill(1, 12, 0);
        foreach ($result as $r) {
            $data[(int)$r->bulan] = (int)$r->total;
        }

        return array_values($data);
    }

    public function get_kredit_per_bulan($year = null)
    {
        $year = $year ?: date('Y');

        $result = $this->db
            ->select("MONTH(tgl_selesai) as bulan, SUM(kredit) as total")
            ->where('YEAR(tgl_selesai)', $year)
            ->where('status', 'diambil')
            ->group_by('MONTH(tgl_selesai)')
            ->get($this->table)
            ->result();

        $data = array_fill(1, 12, 0);
        foreach ($result as $r) {
            $data[(int)$r->bulan] = (int)$r->total;
        }

        return array_values($data);
    }

    // Ambil tahun yang tersedia di database
    public function get_available_years()
    {
        $result = $this->db
            ->select("DISTINCT YEAR(tgl_selesai) as tahun")
            ->where('status', 'diambil')
            ->order_by('tahun', 'DESC')
            ->get($this->table)
            ->result();

        return array_column((array)$result, 'tahun');
    }

    public function get_order_per_layanan()
    {
        $today = date('Y-m-d');
        $month = date('m');

        $result = $this->db
            ->select('l.nama_layanan, COUNT(DISTINCT d.id) as total', FALSE)
            ->from('order_detail d')
            ->join('layanan l', 'l.id = d.layanan_id', 'left')
            ->join('orders o', 'o.id = d.order_id', 'left')
            ->where('o.status !=', 'batal')
            // ->where('DATE(o.tgl_selesai)', $today)
            ->where('MONTH(o.tgl_selesai)', $month)
            ->group_by('d.layanan_id')
            ->get()
            ->result();

        return $result;
    }
}
