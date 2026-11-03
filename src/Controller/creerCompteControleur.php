<?php

//---------------------------
// Contrôleur permettant de traiter toutes les actions liées à la gestion des films
//---------------------------

// Responsabilité : coordonner le traitement d'une requête lié à la notion de film

// Accès au modèle
require_once __DIR__ . "/../model/repository/compteRepository.php";
// Accès à la fonction de rendu de vues (render)
require_once __DIR__ . "/../view/view.php";

// Traitement de l'actin "action=creerCompte"
function afficherCreerCompte(PDO $pdo): void
{
    $errors      = [];
    $nom       = '';
    $prenom = '';
    $email = '';
    $numTel = '';
    $mdp = '';
    $codeInscription = 0;

    // Soumission du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Récupération des valeurs saisies
        $nom       = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $numTel = trim($_POST['numTel']);
        $mdp = trim($_POST['mdp']);
        $codeInscription = intval($_POST['code']);

        // Validation des données
        if ($nom === '') {
            $errors[] = "Le nom est obligatoire.";
        }
        if ($prenom === '') {
            $errors[] = "Le prénom est obligatoire.";
        }
        if ($email === '') {
            $errors[] = "Le prénom est obligatoire.";
        }
        if ($numTel === '') {
            $errors[] = "Le prénom est obligatoire.";
        }
        if ($mdp === '') {
            $errors[] = "Le prénom est obligatoire.";
        }
        if ($codeInscription !== getCodeInscription($connexion)) {
            $errors[] = "Le prénom est obligatoire.";
        }

        // Insertion en base de données si validation OK
        if ($errors === []) {
            // appel au modèle pour insérer les données
            insertFilm($pdo, $titre, $realisateur);
            // redirection vers la liste des films
            header('Location: index.php?action=list');
            exit();
        }

    }

    // Afficher le formulaire (VUE)
    //require_once __DIR__ . '/../../views/films/create.php';

    render("films/create", [
        "title"       => "Ajouter un film",
        "errors"      => $errors,
        "titre"       => $titre,
        "realisateur" => $realisateur,
    ]);
}

function deleteFilm(PDO $pdo): void {
    $filmID = intval($_POST["film-id"]);
    deleteFilmFromDB($pdo, $filmID);
    header("Location: index.php?action=list");
    exit();
}