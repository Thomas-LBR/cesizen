<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiagnosticTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'label' => ['type' => 'VARCHAR', 'constraint' => 180],
            'points' => ['type' => 'INTEGER'],
            'is_active' => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('diagnostic_events');

        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INTEGER', 'unsigned' => true],
            'score' => ['type' => 'INTEGER'],
            'level' => ['type' => 'VARCHAR', 'constraint' => 80],
            'message' => ['type' => 'TEXT'],
            'selected_events' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('diagnostic_results');
    }

    public function down()
    {
        $this->forge->dropTable('diagnostic_results');
        $this->forge->dropTable('diagnostic_events');
    }
}
