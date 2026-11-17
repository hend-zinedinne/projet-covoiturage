<?php

//---------------------------
// Contrôleur permettant de traiter toutes les actions liées à la gestion des films
//---------------------------

// Responsabilité : coordonner le traitement d'une requête lié à la notion de film

// Accès au modèle
require_once __DIR__ . "/../model/repository/connexionRepository.php";
// Accès à la fonction de rendu de vues (render)
require_once __DIR__ . "/../view/view.php";

// Traitement de l'actin "action=creerCompte"
function afficherSeConnecter(PDO $connexion) : void 
{
    afficherVue('seConnecter/index', [
        'titre' => 'Connexion à l\'application de covoiturage',
        'pageCourante' => 'seConnecter'
        ]);
}