<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password', 'foto', 'deskripsi', 'telp', 'alamat', 'token'];

    // Dates
    protected $useTimestamps = true;

    public function encPassword($password = null)
    {
        return md5(md5($password));
    }

    public function encId($id = null)
    {
        return base64_encode(base64_encode(base64_encode(base64_encode($id))));
    }
    public function decId($id = null)
    {
        return base64_decode(base64_decode(base64_decode(base64_decode($id))));
    }

}
