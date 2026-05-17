<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $this->db->table('users')->insertBatch([
            [
                'firstname' => 'Admin',
                'lastname' => 'CESIZen',
                'email' => 'admin@cesizen.test',
                'password_hash' => password_hash('Admin123!', PASSWORD_DEFAULT),
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'firstname' => 'Thomas',
                'lastname' => 'Lebrun',
                'email' => 'user@cesizen.test',
                'password_hash' => password_hash('User123!', PASSWORD_DEFAULT),
                'role' => 'user',
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->db->table('pages')->insertBatch([
            [
                'title' => 'Comprendre le stress',
                'slug' => 'comprendre-le-stress',
                'summary' => 'Repères simples pour identifier les signaux du stress.',
                'content' => "Le stress est une réaction naturelle face à une situation perçue comme exigeante. Il devient problématique lorsqu'il s'installe dans la durée ou lorsqu'il perturbe le sommeil, l'attention ou les relations.",
                'is_published' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Prévenir la surcharge mentale',
                'slug' => 'prevenir-la-surcharge-mentale',
                'summary' => 'Conseils de prévention pour retrouver des marges au quotidien.',
                'content' => "Planifier des pauses, prioriser les tâches et parler à un professionnel en cas de difficulté persistante sont des leviers utiles. CESIZen accompagne l'auto-évaluation, sans remplacer un avis médical.",
                'is_published' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $events = [
            ['Décès du conjoint', 100],
            ['Divorce', 73],
            ['Séparation conjugale', 65],
            ['Emprisonnement', 63],
            ['Décès d’un proche', 63],
            ['Blessure ou maladie personnelle', 53],
            ['Mariage', 50],
            ['Perte d’emploi', 47],
            ['Réconciliation conjugale', 45],
            ['Retraite', 45],
            ['Changement important de santé d’un proche', 44],
            ['Grossesse', 40],
            ['Difficultés sexuelles', 39],
            ['Arrivée d’un nouveau membre dans la famille', 39],
            ['Changement important au travail', 39],
            ['Changement financier important', 38],
            ['Décès d’un ami proche', 37],
            ['Changement de poste', 36],
            ['Conflits conjugaux fréquents', 35],
            ['Crédit ou achat important', 31],
            ['Changement de responsabilités professionnelles', 29],
            ['Départ d’un enfant du foyer', 29],
            ['Difficultés avec la belle-famille', 29],
            ['Réussite personnelle importante', 28],
            ['Début ou fin d’emploi du conjoint', 26],
            ['Début ou fin d’études', 26],
            ['Changement des conditions de vie', 25],
            ['Modification d’habitudes personnelles', 24],
            ['Problèmes avec le responsable hiérarchique', 23],
            ['Changement des horaires ou conditions de travail', 20],
            ['Déménagement', 20],
            ['Changement d’école', 20],
            ['Changement des loisirs', 19],
            ['Changement des activités sociales', 18],
            ['Changement des habitudes de sommeil', 16],
            ['Changement des habitudes alimentaires', 15],
            ['Vacances', 13],
            ['Fêtes de fin d’année', 12],
            ['Petite infraction', 11],
        ];

        foreach ($events as [$label, $points]) {
            $this->db->table('diagnostic_events')->insert([
                'label' => $label,
                'points' => $points,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
