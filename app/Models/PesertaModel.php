<?php

namespace App\Models;
use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    protected $allowedFields = ['id_user','alamat','no_hp'];
}
