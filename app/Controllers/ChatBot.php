<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ChatHistoryModel;
use App\Helpers\ChatGPT;

class ChatBot extends Controller
{
    protected $chatGPT;
    protected $chatHistoryModel;

    public function __construct()
    {
        $this->chatGPT = new ChatGPT();
        $this->chatHistoryModel = new ChatHistoryModel();
    }

    public function sendMessage()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('/chatbot');
        }

        $pesan = $this->request->getPost('message');
        $userId = session()->get('id');

        // Simpan pesan user
        $this->chatHistoryModel->insert([
            'user_id' => $userId,
            'pesan' => $pesan,
            'response' => '',
            'is_bot' => false
        ]);

        // Dapatkan respons dari ChatGPT
        $response = $this->chatGPT->sendMessage($pesan);
        $botResponse = $response['choices'][0]['message']['content'];

        // Simpan respons bot
        $this->chatHistoryModel->insert([
            'user_id' => $userId,
            'pesan' => $botResponse,
            'response' => '',
            'is_bot' => true
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'response' => $botResponse
        ]);
    }
}