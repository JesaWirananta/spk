<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table = 'tb_alternatif';
    protected $primaryKey = 'kode_alternatif';
    protected $returnType = "object";
    protected $useAutoIncrement = false;
    protected $allowedFields = ['kode_alternatif', 'nama_alternatif', 'nim', 'fakultas', 'total'];
}
