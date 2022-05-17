<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table      = 'stok';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_supplier', 'id_barang', 'stok', 'satuan'];

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

    public function joins()
    {
        return $this->db->table('stok a')
        ->select('a.*, b.nama as nama_barang, c.nama as nama_supplier')
        ->join('barang b', 'a.id_barang = b.id')
        ->join('supplier c', 'a.id_supplier = c.id', 'left')
        ->get();
    }
    public function chartData()
    {
        // SELECT id_supplier, count(*) as num FROM barang GROUP BY id_supplier ORDER BY num DESC
        return $this->db->table('stok a')
        ->select('a.*, b.nama as nama_barang')
        ->join('barang b', 'a.id_barang = b.id')
        ->orderBy('stok', 'DESC')
        ->limit(10)
        ->get();
    }

    public function listSatuan()
    {
        return ['Pcs', 'Dus'];
    }

    public function sumStok()
    {
        // return $this->db->table('stok')
        // ->selectSum('stok')
        // ->get();
        return $this->db->table('stok')
        ->selectSum('stok')
        ->get();
    }
}
