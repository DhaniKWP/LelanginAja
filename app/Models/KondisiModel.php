<?php

namespace App\Models;
use CodeIgniter\Model;

class KondisiModel extends Model
{
    protected $table = 'kondisi_barang';
    protected $primaryKey = 'id_kondisi';
    protected $allowedFields = ['nama_kondisi'];
}
