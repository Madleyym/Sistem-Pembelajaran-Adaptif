<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluasiModel extends Model
{
    protected $table = 'evaluasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['siswa_id', 'materi_id', 'nilai', 'feedback', 'created_at'];
    protected $useTimestamps = true;

    public function getLearningProgress()
    {
        // Implementasi untuk mendapatkan progress pembelajaran
        return [65, 70, 75, 80, 85, 90];
    }

    public function getClassPerformance()
    {
        // Implementasi untuk mendapatkan performa kelas
        return [
            [
                'name' => 'Kelas 4A',
                'average_score' => 85,
                'progress' => 75,
                'status' => 'Baik',
                'status_color' => 'success'
            ],
            [
                'name' => 'Kelas 4B',
                'average_score' => 80,
                'progress' => 70,
                'status' => 'Baik',
                'status_color' => 'success'
            ]
            // ... tambahkan data kelas lainnya
        ];
    }
}
