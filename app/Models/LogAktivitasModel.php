<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAktivitasModel extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id',
        'type',
        'description',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = '';

    // Validasi
    protected $validationRules = [
        'user_id' => 'required|numeric',
        'type' => 'required',
        'description' => 'required'
    ];

    // Tambahkan method ini
    public function getRecentActivities($limit = 5)
    {
        $activities = $this->select('log_aktivitas.*, pengguna.username')
            ->join('pengguna', 'pengguna.id = log_aktivitas.user_id')
            ->orderBy('log_aktivitas.created_at', 'DESC')
            ->limit($limit)
            ->find();

        return array_map(function ($activity) {
            return [
                'type' => $this->getActivityType($activity['type']),
                'icon' => $this->getActivityIcon($activity['type']),
                'title' => $this->getActivityTitle($activity['type']),
                'description' => $activity['description'],
                'time' => $this->getTimeAgo($activity['created_at'])
            ];
        }, $activities);
    }

    private function getActivityType($type)
    {
        $types = [
            'LOGIN' => 'success',
            'LOGOUT' => 'danger',
            'CREATE' => 'primary',
            'UPDATE' => 'warning',
            'DELETE' => 'danger',
            'LOGIN_FAILED' => 'danger'
        ];
        return $types[$type] ?? 'info';
    }

    private function getActivityIcon($type)
    {
        $icons = [
            'LOGIN' => 'log-in',
            'LOGOUT' => 'log-out',
            'CREATE' => 'plus',
            'UPDATE' => 'edit',
            'DELETE' => 'trash',
            'LOGIN_FAILED' => 'x-circle'
        ];
        return $icons[$type] ?? 'info-circle';
    }

    private function getActivityTitle($type)
    {
        $titles = [
            'LOGIN' => 'Login Berhasil',
            'LOGOUT' => 'Logout',
            'CREATE' => 'Data Baru',
            'UPDATE' => 'Update Data',
            'DELETE' => 'Hapus Data',
            'LOGIN_FAILED' => 'Login Gagal'
        ];
        return $titles[$type] ?? 'Aktivitas Sistem';
    }

    private function getTimeAgo($timestamp)
    {
        $time = strtotime($timestamp);
        $current = time();
        $diff = $current - $time;

        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' menit yang lalu';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' jam yang lalu';
        } else {
            $days = floor($diff / 86400);
            return $days . ' hari yang lalu';
        }
    }
}
