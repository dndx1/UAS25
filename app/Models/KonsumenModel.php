<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsumenModel extends Model
{
    protected $table = 'konsumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'telepon', 'alamat'];
    protected $useTimestamps = true;
}
