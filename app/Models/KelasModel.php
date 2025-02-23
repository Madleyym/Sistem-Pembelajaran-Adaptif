<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kelas', 'tingkat', 'guru_id', 'tahun_ajaran', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
