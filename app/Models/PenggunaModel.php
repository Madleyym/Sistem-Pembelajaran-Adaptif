<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'password',
        'email',
        'nama_lengkap',
        'peran',
        'last_login',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'username'     => 'required|min_length[3]|is_unique[pengguna.username,id,{id}]',
        'email'        => 'required|valid_email|is_unique[pengguna.email,id,{id}]',
        'nama_lengkap' => 'required',
        'peran'        => 'required|in_list[admin,guru,siswa,orangtua]'
    ];
}
