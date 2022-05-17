<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'supplier';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode', 'nama', 'alamat', 'deskripsi'];

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
}
