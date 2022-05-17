<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kategori', 'kode', 'nama', 'file', 'harga_beli', 'harga_jual', 'deskripsi'];

    // Dates
    protected $useTimestamps = true;

    public function encId($id = null)
    {
        return base64_encode(base64_encode(base64_encode(base64_encode($id))));
    }
    public function decId($id = null)
    {
        return base64_decode(base64_decode(base64_decode(base64_decode($id))));
    }

    public function joinKategori()
    {
        return $this->db->table('barang a')
        ->select('a.*, b.nama as nama_kategori')
        ->join('kategori b', 'a.id_kategori = b.id', 'left')
        ->get();
    }
    public function chartData()
    {
        // SELECT id_supplier, count(*) as num FROM barang GROUP BY id_supplier ORDER BY num DESC
        // return $this->db->table('barang a')
        // ->select('a.*, b.nama as nama_supplier, count(a.id_supplier) as num')
        // ->join('supplier b', 'a.id_supplier = b.id')
        // ->groupBy('id_supplier')
        // ->orderBy('num', 'DESC')
        // ->get();
    }

    public function listSatuan()
    {
        return ['Pcs', 'Dus'];
    }
}
