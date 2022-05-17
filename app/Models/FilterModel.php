<?php

namespace App\Models;

use CodeIgniter\Model;

class FilterModel extends Model
{
    public function filtScript($str)
    {
        return substr(strip_tags($str), 0, 100);
    }
}
