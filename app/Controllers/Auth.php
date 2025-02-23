<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PenggunaModel;
use App\Models\LogAktivitasModel;

class Auth extends Controller
{
    protected $penggunaModel;
    protected $logModel;
    protected $session;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->logModel = new LogAktivitasModel();
        $this->session = session();
    }

    public function index()
    {
        return redirect()->to('login');
    }

    public function login()
    {
        // Cek jika sudah login
        if ($this->session->get('logged_in')) {
            return $this->redirectBasedOnRole($this->session->get('peran'));
        }

        $data = [
            'title' => 'Login - Sistem Pembelajaran Adaptif',
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() === 'post') {
            // Validasi input
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => 'Username harus diisi',
                        'min_length' => 'Username minimal 4 karakter'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Password minimal 6 karakter'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->penggunaModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Set session data
                $sessionData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'] ?? $user['username'],
                    'email' => $user['email'] ?? '',
                    'peran' => $user['peran'],
                    'logged_in' => true,
                    'last_login' => date('Y-m-d H:i:s')
                ];

                $this->session->set($sessionData);

                // Log aktivitas login
                $this->logUserActivity($user['id'], 'LOGIN', 'User berhasil login');

                // Update last login di database
                $this->penggunaModel->update($user['id'], [
                    'last_login' => date('Y-m-d H:i:s'),
                    'last_ip' => $this->request->getIPAddress()
                ]);

                return $this->redirectBasedOnRole($user['peran']);
            }

            // Log percobaan login gagal
            if ($user) {
                $this->logUserActivity($user['id'], 'LOGIN_FAILED', 'Password salah');
            } else {
                $this->logUserActivity(0, 'LOGIN_FAILED', 'Username tidak ditemukan: ' . $username);
            }

            return redirect()->back()->withInput()
                ->with('error', 'Username atau password salah');
        }

        return view('auth/login', $data);
    }

    /**
     * Fungsi untuk redirect berdasarkan peran
     */
    private function redirectBasedOnRole($peran)
    {
        switch ($peran) {
            case 'admin':
                return redirect()->to(base_url('admin'));
            case 'guru':
                return redirect()->to(base_url('guru'));
            case 'siswa':
                return redirect()->to(base_url('siswa'));
            case 'orangtua':
                return redirect()->to(base_url('orangtua'));
            default:
                return redirect()->to(base_url('login'));
        }
    }

    /**
     * Fungsi untuk logout
     */
    public function logout()
    {
        if ($this->session->get('id')) {
            // Log aktivitas logout
            $this->logUserActivity(
                $this->session->get('id'),
                'LOGOUT',
                'User logout: ' . $this->session->get('username')
            );
        }

        // Hapus semua data session
        $this->session->destroy();

        // Redirect ke halaman login dengan pesan
        return redirect()->to(base_url('login'))
            ->with('message', 'Anda berhasil logout');
    }

    /**
     * Fungsi untuk mencatat aktivitas user
     */
    private function logUserActivity($userId, $type, $description)
    {
        $this->logModel->insert([
            'user_id' => $userId,
            'type' => $type,
            'description' => $description,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
