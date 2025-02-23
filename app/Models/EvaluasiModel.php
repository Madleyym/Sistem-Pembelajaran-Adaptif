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
        // Mengambil progress pembelajaran 6 bulan terakhir
        $result = $this->db->query("
            SELECT 
                MONTH(created_at) as bulan,
                AVG(progress) as rata_rata_progress
            FROM kemajuan_siswa
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY MONTH(created_at)
            ORDER BY created_at ASC
            LIMIT 6
        ")->getResultArray();

        // Mengambil nilai progress saja
        return array_column($result, 'rata_rata_progress');
    }

    public function getClassPerformance()
    {
        // Query untuk mendapatkan performa setiap kelas
        $result = $this->db->query("
            SELECT 
                k.id,
                k.nama_kelas as name,
                p.nama_lengkap as teacher,
                (
                    SELECT AVG(n.nilai)
                    FROM nilai n
                    JOIN siswa_kelas sk ON sk.siswa_id = n.siswa_id
                    WHERE sk.kelas_id = k.id
                    AND sk.status = 'aktif'
                ) as average_score,
                (
                    SELECT AVG(ks.progress)
                    FROM kemajuan_siswa ks
                    JOIN siswa_kelas sk ON sk.siswa_id = ks.siswa_id
                    WHERE sk.kelas_id = k.id
                    AND sk.status = 'aktif'
                ) as progress,
                CASE 
                    WHEN (
                        SELECT AVG(n.nilai)
                        FROM nilai n
                        JOIN siswa_kelas sk ON sk.siswa_id = n.siswa_id
                        WHERE sk.kelas_id = k.id
                        AND sk.status = 'aktif'
                    ) >= 85 THEN 'Sangat Baik'
                    WHEN (
                        SELECT AVG(n.nilai)
                        FROM nilai n
                        JOIN siswa_kelas sk ON sk.siswa_id = n.siswa_id
                        WHERE sk.kelas_id = k.id
                        AND sk.status = 'aktif'
                    ) >= 75 THEN 'Baik'
                    ELSE 'Cukup'
                END as status
            FROM kelas k
            JOIN pengguna p ON p.id = k.guru_id
            WHERE k.tahun_ajaran = YEAR(CURRENT_DATE)
            ORDER BY k.tingkat ASC, k.nama_kelas ASC
        ")->getResultArray();

        // Menambahkan warna berdasarkan status dan memformat data
        return array_map(function ($class) {
            $avg_score = round($class['average_score'] ?? 0, 1);
            $progress = round($class['progress'] ?? 0);

            // Menentukan warna berdasarkan rata-rata nilai
            if ($avg_score >= 85) {
                $color = 'primary';
                $status_color = 'primary';
            } elseif ($avg_score >= 75) {
                $color = 'success';
                $status_color = 'success';
            } else {
                $color = 'warning';
                $status_color = 'warning';
            }

            return [
                'name' => $class['name'],
                'teacher' => $class['teacher'],
                'average_score' => $avg_score,
                'progress' => $progress,
                'status' => $class['status'],
                'status_color' => $status_color,
                'color' => $color
            ];
        }, $result);
    }

    public function getEvaluationData()
    {
        return $this->select('
                nilai.*,
                p.nama_lengkap as nama_siswa,
                m.judul as nama_materi,
                k.nama_kelas
            ')
            ->join('pengguna p', 'p.id = nilai.siswa_id')
            ->join('materi m', 'm.id = nilai.materi_id')
            ->join('siswa_kelas sk', 'sk.siswa_id = nilai.siswa_id')
            ->join('kelas k', 'k.id = sk.kelas_id')
            ->where('sk.status', 'aktif')
            ->orderBy('nilai.created_at', 'DESC')
            ->findAll();
    }
}
