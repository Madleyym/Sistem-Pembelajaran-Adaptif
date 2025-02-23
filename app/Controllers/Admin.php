<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PenggunaModel;
use App\Models\MateriModel;
use App\Models\KelasModel;
use App\Models\ChatbotModel;
use App\Models\EvaluasiModel;

class Admin extends Controller
{
    protected $penggunaModel;
    protected $materiModel;
    protected $kelasModel;
    protected $chatbotModel;
    protected $evaluasiModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->materiModel = new MateriModel();
        $this->kelasModel = new KelasModel();
        $this->chatbotModel = new ChatbotModel();
        $this->evaluasiModel = new EvaluasiModel();
    }

    public function index()
    {
        // Data untuk statistik dasar
        $data = [
            'total_guru' => $this->penggunaModel->where('peran', 'guru')->countAllResults(),
            'total_siswa' => $this->penggunaModel->where('peran', 'siswa')->countAllResults(),
            'total_orangtua' => $this->penggunaModel->where('peran', 'orangtua')->countAllResults(),
            'total_materi' => $this->materiModel->countAllResults(),
            'total_kelas' => $this->kelasModel->countAllResults(),

            // Data pengguna
            'pengguna_terbaru' => $this->penggunaModel->orderBy('created_at', 'DESC')
                ->limit(5)
                ->find(),

            // Data pembelajaran
            'learning_progress' => $this->evaluasiModel->getLearningProgress(),
            'class_performance' => $this->evaluasiModel->getClassPerformance(),

            // Data ChatBot
            'chatbot_labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'chatbot_data' => $this->chatbotModel->getWeeklyInteractions(),

            // Data aktivitas terbaru
            'recent_activities' => $this->getRecentActivities(),

            // Informasi user yang sedang login
            'current_user' => [
                'username' => session()->get('username'),
                'nama_lengkap' => session()->get('nama_lengkap'),
                'peran' => session()->get('peran'),
                'last_login' => session()->get('last_login')
            ],

            // Informasi waktu server
            'server_time' => date('Y-m-d H:i:s')
        ];

        return view('admin/dashboard', $data);
    }

    private function getRecentActivities()
    {
        // Contoh data aktivitas (dalam implementasi nyata, ini akan diambil dari database)
        return [
            [
                'type' => 'success',
                'description' => 'Materi baru ditambahkan: Pengenalan Bahasa Daerah Tingkat Dasar',
                'time' => '5 menit yang lalu'
            ],
            [
                'type' => 'info',
                'description' => 'Siswa baru mendaftar ke kelas Bahasa Daerah 4A',
                'time' => '10 menit yang lalu'
            ],
            [
                'type' => 'warning',
                'description' => 'Update konfigurasi ChatBot AI',
                'time' => '30 menit yang lalu'
            ]
        ];
    }

    // Method untuk manajemen materi
    public function materi()
    {
        $data['materi'] = $this->materiModel->findAll();
        return view('admin/materi', $data);
    }

    // Method untuk manajemen kelas
    public function kelas()
    {
        $data['kelas'] = $this->kelasModel->findAll();
        return view('admin/kelas', $data);
    }

    // Method untuk manajemen guru
    public function guru()
    {
        $data['guru'] = $this->penggunaModel->where('peran', 'guru')->findAll();
        return view('admin/guru', $data);
    }

    // Method untuk manajemen siswa
    public function siswa()
    {
        $data['siswa'] = $this->penggunaModel->where('peran', 'siswa')->findAll();
        return view('admin/siswa', $data);
    }

    // Method untuk manajemen orangtua
    public function orangtua()
    {
        $data['orangtua'] = $this->penggunaModel->where('peran', 'orangtua')->findAll();
        return view('admin/orangtua', $data);
    }

    // Method untuk konfigurasi chatbot
    public function chatbot()
    {
        $data['config'] = $this->chatbotModel->getConfig();
        $data['interactions'] = $this->chatbotModel->getRecentInteractions();
        return view('admin/chatbot', $data);
    }

    // Method untuk evaluasi pembelajaran
    public function evaluasi()
    {
        $data['evaluasi'] = $this->evaluasiModel->getEvaluationData();
        return view('admin/evaluasi', $data);
    }
    public function logAktivitas()
    {
        $logModel = new \App\Models\LogAktivitasModel();
        $data['logs'] = $logModel->select('log_aktivitas.*, pengguna.username')
        ->join('pengguna', 'pengguna.id = log_aktivitas.user_id')
        ->orderBy('created_at', 'DESC')
        ->paginate(20);
        $data['pager'] = $logModel->pager;

        return view('admin/log_aktivitas', $data);
    }
}

