<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Layanan extends CI_Model
{
    private $table = 'layanan';

    private $orderable = [
        0 => 'id',
        1 => 'nama_layanan',
        2 => 'harga_per_kg',
        3 => 'is_active',
        4 => 'created_at',
    ];

    private function _base_query()
    {
        $this->db->from($this->table);

        if (!empty($_POST['search']['value'])) {
            $search = $_POST['search']['value'];
            $this->db->group_start()
                ->like('nama_layanan', $search)
                ->or_like('harga_per_kg', $search)
                ->group_end();
        }

        $orderCol = $_POST['order'][0]['column'] ?? null;
        if ($orderCol !== null && !empty($this->orderable[$orderCol])) {
            $col = $this->orderable[$orderCol];
            $dir = ($_POST['order'][0]['dir'] ?? 'asc') === 'asc' ? 'ASC' : 'DESC';
            $this->db->order_by($col, $dir);
        } else {
            $this->db->order_by('id', 'ASC');
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

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
