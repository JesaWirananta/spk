<?php

namespace App\Models;

use CodeIgniter\Model;

class RelasiModel extends Model
{
    protected $table = 'tb_rel_alternatif';
    protected $primaryKey = 'ID';
    protected $returnType = "object";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['kode_alternatif', 'kode_kriteria', 'kode_crisp'];
}
