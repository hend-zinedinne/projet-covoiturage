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
function afficherCreerCompte(PDO $connexion): void
{
    $erreurs         = [];
    $nom             = '';
    $prenom          = '';
    $email           = '';
    $numTel          = '';
    $mdp             = '';
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
            $erreurs[] = "Le nom est obligatoire.";
        }
        if ($prenom === '') {
            $erreurs[] = "Le prénom est obligatoire.";
        }
        if ($email === '') {
            $erreurs[] = "L'adresse mail est obligatoire.";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $erreurs[] = "L'adresse mail est invalide.";
        }
        if ($numTel === '') {
            $erreurs[] = "Le numéro de téléphone est obligatoire.";
        } elseif (verifierNumero($numTel) === false) {
            $erreurs[] = "Le numéro de téléphone est invalide.";
        }
        if ($mdp === '') {
            $erreurs[] = "Le mot de passe est obligatoire.";
        }
        if ($codeInscription !== getCodeInscription($connexion)) {
            $erreurs[] = "Le code d'inscription est incorrect..";
        }

        // Insertion en base de données si validation OK
        if ($erreurs === []) {
            // appel au modèle pour insérer les données
            insertEnseignant($connexion, $nom, $prenom, $email, $numTel, password_hash($mdp, PASSWORD_DEFAULT));
            // redirection vers la liste des films
            header('Location: index.php?action=bienvenue');
            exit();
        }

    }

    // Afficher le formulaire (VUE)
    //require_once __DIR__ . '/../../views/films/create.php';

    afficherVue("creerCompte/index", [
        "title"  => "Créer votre compte",
        "erreurs" => $erreurs,
        "nom"    => $nom,
        "prenom" => $prenom,
        "email"  => $email,
        "numTel" => $numTel,
        "mdp"    => $mdp,
        "codeInscription"   => $codeInscription,
    ]);
}

function verifierNumero($phone){
    return preg_match('/^[0-9]{10}+$/', $phone);
}