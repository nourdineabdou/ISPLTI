<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ComptesExport implements FromArray
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function array(): array
    {
        // Add header row
        $header = ['Agence', 'Compte', 'Clé', 'Montant'];
        $rows = array_map(function($row) {
            return [
                $row['agence'],
                $row['compte'],
                $row['cle'],
                $row['montant'],
            ];
        }, $this->table);
        array_unshift($rows, $header);
        return $rows;
    }
}
