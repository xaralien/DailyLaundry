<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Laundry extends CI_Model
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
        $this->db->select("
        o.*,
        (
            SELECT GROUP_CONCAT(l.nama_layanan, ' (', od.qty, ' ', l.satuan, ')' SEPARATOR ', ')
            FROM order_detail od
            JOIN layanan l ON l.id = od.layanan_id
            WHERE od.order_id = o.id
        ) AS layanan_summary,
        (
            SELECT SUM(od.qty)
            FROM order_detail od
            WHERE od.order_id = o.id
        ) AS total_qty
    ", FALSE)
            ->from('orders o');

        // Search
        if (!empty($_POST['search']['value'])) {
            $search = $_POST['search']['value'];
            $this->db->group_start()
                ->like('o.no_nota', $search)
                ->or_like('o.nama_customer', $search)
                ->or_like('o.detail_item', $search)
                ->or_like('o.status', $search)
                ->group_end();
        }

        // Order
        $orderCol = $_POST['order'][0]['column'] ?? null;
        // $orderCol = null;
        if ($orderCol !== null && !empty($this->orderable[$orderCol])) {
            $col = $this->orderable[$orderCol];
            $dir = ($_POST['order'][0]['dir'] ?? 'desc') === 'asc' ? 'ASC' : 'DESC';
            $this->db->order_by($col, $dir);
        } else {
            // $this->db->order_by('o.tgl_masuk', 'DESC');
            $this->db->order_by('o.no_nota', 'ASC');
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

    public function insert_order($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_layanan()
    {
        return $this->db->where('is_active', 1)->get('layanan')->result();
    }

    public function get_order_details($order_id)
    {
        return $this->db->select('od.*, l.nama_layanan, l.satuan')
            ->from('order_detail od')
            ->join('layanan l', 'l.id = od.layanan_id', 'left')
            ->where('od.order_id', $order_id)
            ->get()->result();
    }

    public function get_order_by_id($id)
    {
        return $this->db->select('o.*')
            ->from('orders o')
            ->where('o.id', $id)
            ->get()->row();
    }

    // public function get_order_by_id($id)
    // {
    //     return $this->db->select('o.*, l.nama_layanan')
    //         ->from('orders o')
    //         ->join('layanan l', 'l.id = o.layanan_id', 'left')
    //         ->where('o.id', $id)
    //         ->get()->row();
    // }

    public function update_order($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete_order($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function update_status($id, $status)
    {
        return $this->db->where('id', $id)->update($this->table, ['status' => $status]);
    }

    public function get_summary()
    {
        $today = date('Y-m-d');

        // Orderan masuk hari ini
        $orderan_hari_ini = $this->db
            // ->where('DATE(tgl_masuk)', $today)
            ->where('status !=', 'batal')
            ->count_all_results($this->table);

        // Per status (semua data aktif)
        $statuses = ['proses', 'cuci', 'kering', 'belum_diambil', 'diambil'];
        $count    = [];
        foreach ($statuses as $s) {
            $count[$s] = $this->db
                // ->where('DATE(tgl_masuk)', $today)
                ->where('status', $s)
                ->count_all_results($this->table);
        }

        // "Belum diproses" hari ini = masuk hari ini & status masih 'proses'
        $belum_diproses = $this->db
            // ->where('DATE(tgl_masuk)', $today)
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

    public function get_export($dari, $sampai)
    {
        return $this->db
            ->select("
            o.*,
            (
                SELECT GROUP_CONCAT(l.nama_layanan, ' (', od.qty, ' ', l.satuan, ')' SEPARATOR ', ')
                FROM order_detail od
                JOIN layanan l ON l.id = od.layanan_id
                WHERE od.order_id = o.id
            ) AS layanan_summary,
            (
                SELECT SUM(od.qty)
                FROM order_detail od
                WHERE od.order_id = o.id
            ) AS total_qty
        ", FALSE)
            ->from('orders o')
            ->where('DATE(o.tgl_masuk) >=', $dari)
            ->where('DATE(o.tgl_masuk) <=', $sampai)
            ->where('o.status !=', 'batal')
            ->order_by('o.tgl_masuk', 'ASC')
            ->order_by('o.id', 'ASC')
            ->get()
            ->result();
    }

    public function get_rekap_per_layanan($dari, $sampai)
    {
        return $this->db
            ->select('
            l.nama_layanan,
            l.satuan,
            SUM(od.qty)                    AS total_qty,
            SUM(od.qty * od.harga_satuan)  AS total_harga
        ', FALSE)
            ->from('order_detail od')
            ->join('layanan l',  'l.id  = od.layanan_id', 'left')
            ->join('orders o',   'o.id  = od.order_id',   'left')
            ->where('DATE(o.tgl_masuk) >=', $dari)
            ->where('DATE(o.tgl_masuk) <=', $sampai)
            ->where('o.status !=', 'batal')
            ->group_by('od.layanan_id')
            ->order_by('total_qty', 'DESC')
            ->get()
            ->result();
    }
}
