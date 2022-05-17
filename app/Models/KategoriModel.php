<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'deskripsi'];

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
