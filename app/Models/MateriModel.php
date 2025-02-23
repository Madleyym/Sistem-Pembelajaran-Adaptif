<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'deskripsi', 'level', 'kategori', 'konten', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
