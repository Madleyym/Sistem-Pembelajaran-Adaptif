<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PenggunaModel;

class Auth extends Controller
{
    protected $penggunaModel;

    public function __construct()
    {
        $this->penggunaModel = new PenggunaModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->penggunaModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'peran' => $user['peran'],
                    'logged_in' => true
                ]);

                return redirect()->to('dashboard');
            }

            return redirect()->back()->with('error', 'Username atau password salah');
        }

        return view('auth/login', $data);
    }
}
