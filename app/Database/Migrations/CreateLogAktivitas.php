<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogAktivitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ],
            'user_agent' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->createTable('log_aktivitas');
    }

    public function down()
    {
        $this->forge->dropTable('log_aktivitas');
    }
}
