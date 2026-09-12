<?php

namespace Database\Seeders;

use App\Models\Langue;
use App\Models\Master;
use App\Models\PieceObligatoireMaster;
use Illuminate\Database\Seeder;

class CandidatureFeatureSeeder extends Seeder
{
    /**
     * Donnees de reference pour la candidature en ligne (masters, langues, pieces obligatoires).
     * Utilise updateOrCreate : peut etre relance sans risque, ne duplique et ne supprime rien.
     */
    public function run(): void
    {
        $master = Master::updateOrCreate(
            ['code' => 'TTCN'],
            [
                'intitule' => 'Techniques de traduction et de communication numérique',
                'intitule_ar' => 'تقنيات الترجمة والاتصال الرقمي',
                'intitule_en' => 'Translation Technologies and Digital Communication',
                'annee_universitaire' => '2026/2027',
                'campus' => 'Nouadhibou',
                'description' => 'Master interdisciplinaire combinant expertise linguistique, traduction, interprétation, communication numérique et technologies de la traduction.',
                'description_ar' => 'ماستر متعدد التخصصات يجمع بين الخبرة اللغوية والترجمة والترجمة الفورية والاتصال الرقمي وتقنيات الترجمة.',
                'description_en' => "An interdisciplinary Master's program combining linguistic expertise, translation, interpreting, digital communication, and translation technologies.",
                'date_debut_candidature' => '2026-09-08',
                'date_fin_candidature' => '2026-09-29',
                'statut' => true,
            ]
        );

        $langues = [
            ['code' => 'AR', 'langue' => 'Arabe'],
            ['code' => 'EN', 'langue' => 'Anglais'],
            ['code' => 'FR', 'langue' => 'Français'],
            ['code' => 'ES', 'langue' => 'Espagnol'],
            ['code' => 'TR', 'langue' => 'Turc'],
            ['code' => 'ZH', 'langue' => 'Chinois'],
        ];
        foreach ($langues as $langue) {
            Langue::updateOrCreate(['code' => $langue['code']], ['langue' => $langue['langue'], 'actif' => true]);
        }

        $pieces = [
            ['code_document' => 'acte_naissance', 'libelle' => 'Extrait d’acte de naissance', 'obligatoire' => true, 'ordre' => 1],
            ['code_document' => 'carte_identite', 'libelle' => 'Copie de la carte nationale d’identité', 'obligatoire' => true, 'ordre' => 3],
            ['code_document' => 'diplome', 'libelle' => 'Copie certifiée conforme des diplômes', 'obligatoire' => true, 'ordre' => 4],
            ['code_document' => 'releve_notes', 'libelle' => 'Relevés de notes', 'obligatoire' => true, 'ordre' => 5],
            ['code_document' => 'memoire_rapport_projet', 'libelle' => 'Mémoire, rapport ou projet de fin d’études', 'obligatoire' => false, 'ordre' => 6],
            ['code_document' => 'certificat_formation', 'libelle' => 'Certificat de formation', 'obligatoire' => false, 'ordre' => 7],
            // le certificat de langue est optionnel : un candidat peut ne pas en avoir
            ['code_document' => 'certificat_langue', 'libelle' => 'Certificat de langue', 'obligatoire' => false, 'ordre' => 8],
            ['code_document' => 'certificat_travail', 'libelle' => 'Certificat de travail', 'obligatoire' => false, 'ordre' => 9],
            ['code_document' => 'projet_recherche', 'libelle' => 'Projet de recherche de 3 à 6 pages', 'obligatoire' => true, 'ordre' => 10],
            ['code_document' => 'lettre_motivation', 'libelle' => 'Lettre de motivation signée', 'obligatoire' => true, 'ordre' => 11],
        ];
        foreach ($pieces as $piece) {
            PieceObligatoireMaster::updateOrCreate(
                ['master_id' => $master->id, 'code_document' => $piece['code_document']],
                ['libelle' => $piece['libelle'], 'obligatoire' => $piece['obligatoire'], 'ordre' => $piece['ordre'], 'actif' => true]
            );
        }

        // pieces retirees de la liste ci-dessus au fil du temps (ex: certificat_nationalite) :
        // updateOrCreate ne supprime jamais une ligne qui n'est plus dans $pieces, donc un
        // environnement deja seede avant ce retrait garde la ligne obsolete indefiniment tant
        // qu'on ne la supprime pas explicitement ici. Sans impact sur les candidats : seule la
        // definition de la piece disparait, aucun document deja televerse n'est touche.
        $codesObsoletes = ['certificat_nationalite'];
        PieceObligatoireMaster::where('master_id', $master->id)
            ->whereIn('code_document', $codesObsoletes)
            ->delete();
    }
}
