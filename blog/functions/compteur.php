<?php
function ajouter_vue(){
    $fichier = "functions/compteur.txt";
    $fichier_journalier = $fichier . "-". date('Y-m-d');
    incrementer_vue($fichier);
    incrementer_vue($fichier_journalier);
    
    
}


function incrementer_vue(string $fichier):void{
    $compteur = 1;
    if(file_exists($fichier)){
        $compteur = (int)file_get_contents($fichier);
        $compteur++;
       
    }
        file_put_contents($fichier,$compteur);
}


function nombre_vue($chemin){
        return file_get_contents($chemin);
}


function nombre_vue_mois(int $annee, string $mois): int{
  //  $mois = str_pad($mois,2,"0",STR_PAD_LEFT);
    $fichier = dirname(__DIR__). DIRECTORY_SEPARATOR . "functions/compteur.txt" . "-".$annee ."-" .$mois."-*";
    $fichiers = glob($fichier);
    $total = 0;
    foreach($fichiers as $fichier){
        $total += file_get_contents($fichier);
    }
    return $total;
}

function nombre_vue_detail_mois(int $annee, string $mois): array{
    $fichier = dirname(__DIR__). DIRECTORY_SEPARATOR . "functions/compteur.txt" . "-".$annee ."-" .$mois."-*";
    $fichiers = glob($fichier);
    $visiteurs = [];
    foreach($fichiers as $fichier){
        $partie = explode("-",basename($fichier));
        $visiteurs[] = [
                "annee" => $partie[1],
                "mois" => $partie[2],
                "jour"=>   $partie[3],
                "visiteurs" => file_get_contents($fichier)
        ];
    }
    return $visiteurs;
}
/*
$annee = 2019;
$mois = "09";
echo $fichier = dirname(__DIR__). DIRECTORY_SEPARATOR . "functions/compteur.txt" . "-".$annee ."-" .$mois."-*";

*/