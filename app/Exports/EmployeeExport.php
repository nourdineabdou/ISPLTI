<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $exportData = [];
        foreach ($this->data as $date => $shifts) {
            $row = [
                'Date' => $date,
                'JOUR' => $shifts['JOUR']['ManPower'],
                'NUIT' => $shifts['NUIT']['ManPower'],
                'Superviseurs HSE' => $shifts['Fonction Totals']['Superviseur HSE'] ?? 0,
                'Superviseurs Opérations' => $shifts['Fonction Totals']['Superviseur Opérations'] ?? 0,
                'Superviseurs Magasin' => $shifts['Fonction Totals']['Superviseur Magasin'] ?? 0,
                'Assistant QHSE' => $shifts['Fonction Totals']['Assistant QHSE'] ?? 0,
                'TOTAL' => $shifts['Total'],
            ];
            $exportData[] = $row;
        }
        return $exportData;
    }

    public function headings(): array
    {
        return [
            'Date',
            'JOUR',
            'NUIT',
            'Superviseurs HSE',
            'Superviseurs Opérations',
            'Superviseurs Magasin',
            'Assistant QHSE',
            'TOTAL',
        ];
    }
}
