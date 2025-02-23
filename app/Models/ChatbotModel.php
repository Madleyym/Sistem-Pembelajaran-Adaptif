<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatbotModel extends Model
{
    protected $table = 'chatbot_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'pesan', 'response', 'created_at'];
    protected $useTimestamps = true;

    public function getWeeklyInteractions()
    {
        // Implementasi untuk mendapatkan data interaksi mingguan
        return [45, 52, 49, 60, 55, 48, 50];
    }

    public function getConfig()
    {
        // Implementasi untuk mendapatkan konfigurasi chatbot
        return [
            'language' => 'bahasa_daerah_default',
            'model' => 'gpt-3.5-turbo',
            'max_tokens' => 150
        ];
    }
}
