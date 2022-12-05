<?php

namespace App\Models;

use CodeIgniter\Model;

class CrispModel extends Model
{
    protected $table = 'tb_crisp';
    protected $primaryKey = 'kode_crisp';
    protected $returnType = "object";
    protected $useAutoIncrement = false;
    protected $allowedFields = ['kode_crisp', 'kode_kriteria', 'nama_crisp', 'nilai_crisp'];
}
