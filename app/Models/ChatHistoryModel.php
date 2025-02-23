<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatHistoryModel extends Model
{
    protected $table            = 'chat_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'pesan', 'response', 'is_bot'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    // Validasi
    protected $validationRules = [
        'user_id'  => 'required|numeric',
        'pesan'    => 'required',
        'is_bot'   => 'permit_empty|in_list[0,1]'
    ];
}
