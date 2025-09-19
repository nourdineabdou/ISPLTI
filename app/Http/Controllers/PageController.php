<?php

namespace App\Http\Controllers;

use App\Exports\ComptesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Etablissement;
use Illuminate\Http\Request;

class PageController extends Controller
{

    // directeur
    public function directeur()
    {
        return view('pages_sites.directeur');
    }
   public function actualite()
   {

       return view('pages_sites.actualite');
   }

   public function contact()
   {
       return view('pages_sites.contact');
   }

   public function about()
   {
       return view('pages_sites.about');
   }

   public function events()
   {
       return view('pages_sites.events');
   }

   public function eventDetails($id)
   {
       return view('pages_sites.eventDetails', compact('id'));
   }

   public function viesEstudiantine()
   {
       return view('pages_sites.viesEstudiantine');
   }

        public function comptesFromFile()
    {
        // exemple ligne de fichier
        $li = "2            A                                   ABM                     000130620190000084001     5300000000000001113300VIREMENT ORDRE ARMEE NATIONALE";
        // recuperer monatant 001113300 avec substr a partir de $li
         $montant = substr($li, 112, 9); // le monatnt afficher avec sa ce'est 001113300V"
        // recuperere compte 90000084001 avec substr a partir de $li
         $compte = substr($li, 83, 11);
        // recuperer agence 06201 avec substr a partir de $li

         $agence = substr($li, 78, 5); // sa la sa afficher

        // recuperer cle 53 avec substr a partir de $li
         $cle = substr($li, 100, 2);
        // afficher le tous avec dd
         //dd($montant, $compte, $agence, $cle);
        $filePath = 'C:\Users\Administrateur\Downloads\000007 (2).txt';
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $results = [];
        foreach ($lines as $i => $line) {
            if ($i === 0) continue; // skip first line
            $agence = trim(substr($line, 78, 5));
            $compte = trim(substr($line, 83, 11));
            $cle = trim(substr($line, 100, 2));
            $montant = trim(substr($line, 112, 9));
            // mettre les donnees dans un fichier excel
            // ou csv
            // For example, you can use Laravel's Excel package to export to CSV or Excel
            // Here, we just prepare the data for demonstration purposes
            // You can replace this with actual export logic
            // e.g., using Laravel Excel or any other package
            // to export the results to a file
            // For now, we just return the results as an array
            $results[] = [
                'agence' => $agence,
                'compte' => $compte,
                'cle' => $cle,
                'montant' => $montant,
            ];

        }

        // mettre les donnees dans un fichier excel
       return Excel::download(new ComptesExport($results), 'comptes.xlsx');
        // return view('pages_sites.comptes', compact('results')); // Uncomment if you want to return a view instead

    }

    // methode qui permet des donnes et le mettre dans un fichier excel
    public function dowloadExcel($table){
        return Excel::download(new ComptesExport($table), 'comptes.xlsx');
    }
}

