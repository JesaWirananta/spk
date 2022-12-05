<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $returnType = "object";
    protected $useAutoIncrement = false;
    protected $allowedFields = ['id_user', 'nama_user', 'user', 'pass'];
}
