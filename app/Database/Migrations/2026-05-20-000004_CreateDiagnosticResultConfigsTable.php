<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiagnosticResultConfigsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INTEGER', 'unsigned' => true, 'auto_increment' => true],
            'level' => ['type' => 'VARCHAR', 'constraint' => 80],
            'min_score' => ['type' => 'INTEGER', 'default' => 0],
            'max_score' => ['type' => 'INTEGER', 'null' => true],
            'message' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('diagnostic_result_configs');

        $now = date('Y-m-d H:i:s');
        $this->db->table('diagnostic_result_configs')->insertBatch([
            [
                'level' => 'Stress faible',
                'min_score' => 0,
                'max_score' => 149,
                'message' => 'Votre score indique une exposition limitée aux événements stressants. Continuez à préserver vos temps de repos et vos habitudes protectrices.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'level' => 'Stress modéré',
                'min_score' => 150,
                'max_score' => 299,
                'message' => 'Votre score indique une exposition notable au stress. Il peut être utile d’identifier les sources principales et de mettre en place des pauses régulières.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'level' => 'Stress élevé',
                'min_score' => 300,
                'max_score' => null,
                'message' => 'Votre score indique une exposition forte au stress. Ce résultat n’est pas un diagnostic médical, mais il peut justifier d’en parler à un professionnel de santé.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('diagnostic_result_configs');
    }
}
