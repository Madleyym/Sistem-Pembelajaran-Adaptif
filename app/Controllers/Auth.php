<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PenggunaModel;

class Auth extends Controller
{
    protected $penggunaModel;
    protected $session;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
        $this->session = session();
    }

    public function login()
    {
        // Cek jika sudah login
        if ($this->session->get('logged_in')) {
            return $this->redirectBasedOnRole($this->session->get('peran'));
        }

        $data = [
            'title' => 'Login'
        ];

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->penggunaModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Set session data
                $this->session->set([
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'peran' => $user['peran'],
                    'logged_in' => true
                ]);

                // Redirect ke halaman sesuai peran
                return $this->redirectBasedOnRole($user['peran']);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah');
        }

        return view('auth/login', $data);
    }

    /**
     * Fungsi untuk redirect berdasarkan peran
     * @param string $peran
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function redirectBasedOnRole($peran)
    {
        switch ($peran) {
            case 'admin':
                return redirect()->to('admin');
            case 'guru':
                return redirect()->to('guru');
            case 'siswa':
                return redirect()->to('siswa');
            case 'orangtua':
                return redirect()->to('orangtua');
            default:
                return redirect()->to('dashboard');
        }
    }

    /**
     * Fungsi untuk logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login')->with('message', 'Berhasil logout');
    }
}
