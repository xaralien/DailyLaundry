<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NotaConfigModel extends CI_Model
{
    protected $table = 'nota_config';

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil config
    private function getConfig()
    {
        return $this->db->get_where($this->table, ['id' => 1])->row_array();
    }

    // Ambil nomor nota berikutnya
    public function getNextNota()
    {
        $config = $this->getConfig();

        // Cek apakah perlu auto reset
        $this->checkAutoReset($config);
        $config = $this->getConfig(); // refresh setelah reset

        // Build nomor nota
        $nota = $config['prefix'] . $config['sep'];

        if ($config['use_year']) {
            $nota .= date('Y') . $config['sep'];
        }
        if ($config['use_month']) {
            $nota .= date('m') . $config['sep'];
        }
        $nota .= $config['batch'] . $config['sep'];

        $nota .= str_pad($config['counter'], $config['padding'], '0', STR_PAD_LEFT);

        return $nota;
    }

    // Increment counter setelah order berhasil disimpan
    public function incrementCounter()
    {
        $this->db->query('UPDATE ' . $this->table . ' SET counter = counter + 1 WHERE id = 1');
    }

    // Cek & jalankan auto reset
    private function checkAutoReset($config)
    {
        $reset = false;

        if ($config['auto_reset'] === 'yearly') {
            $lastYear = $config['last_reset'] ? date('Y', strtotime($config['last_reset'])) : null;
            if ($lastYear !== date('Y')) $reset = true;
        } elseif ($config['auto_reset'] === 'monthly') {
            $lastMonth = $config['last_reset'] ? date('Y-m', strtotime($config['last_reset'])) : null;
            if ($lastMonth !== date('Y-m')) $reset = true;
        }

        if ($reset) {
            $this->db->where('id', 1);
            $this->db->update($this->table, [
                'counter'    => 1,
                'last_reset' => date('Y-m-d'),
            ]);
        }
    }

    // Set counter manual
    public function setCounter($counter)
    {
        $this->db->where('id', 1);
        $this->db->update($this->table, ['counter' => (int) $counter]);
    }

    // Update konfigurasi (prefix, sep, dll)
    public function updateConfig($data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', 1);
        $this->db->update($this->table, $data);
    }

    // Ambil semua config (untuk halaman pengaturan)
    public function getAll()
    {
        return $this->getConfig();
    }

    public function getConfigRow()
    {
        return $this->db->get_where($this->table, ['id' => 1])->row();
    }
}
