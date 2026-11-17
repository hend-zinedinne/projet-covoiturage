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
    function afficherCreerCompte(PDO $connexion): void
{
    $erreurs         = [];
    $email           = '';
    $mdp             = '';

    // Soumission du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Récupération des valeurs saisies
        $email = trim($_POST['email']);
        $mdp = trim($_POST['mdp']);

        $emailValide = trouverEnseignantfromEmail($connexion, $email);
        // Validation des données
        if ($email === '') {
            $erreurs[] = "L'adresse mail est obligatoire.";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $erreurs[] = "L'adresse mail est invalide.";
        } elseif ($emailValide) {
            $erreurs[] = "Ce compte est déjà pris par un autre utilisateur.";
        }
        }
        if ($mdp === '') {
            $erreurs[] = "Le mot de passe est obligatoire.";
        }

        // Insertion en base de données si validation OK
        if ($erreurs === []) {
            // appel au modèle pour insérer les données
            if (insertEnseignant($connexion, $nom, $prenom, $email, $numTel, password_hash($mdp, PASSWORD_DEFAULT)) === false) {
                // en cas d'erreur lors de l'insertion, on revient
                $erreurs[] = "Une erreur est arrivée lors de la création du compte. Veuillez réessayer plus tard.";
                afficherVue("creerCompte/index", [
                "title"  => "Créer votre compte",
                "pageCourante" => "creerCompte",
                "erreurs" => $erreurs,
                "email"  => $email,
                 ]);
            };
            // redirection vers la liste des films
            header('Location: index.php?action=bienvenue');
            exit();
        }

    }

    // Afficher le formulaire (VUE)
    //require_once __DIR__ . '/../../views/films/create.php';

    afficherVue("creerCompte/index", [
        "title"  => "Créer votre compte",
        "pageCourante" => "creerCompte",
        "erreurs" => $erreurs,
        "nom"    => $nom,
        "prenom" => $prenom,
        "email"  => $email,
        "numTel" => $numTel,
    ]);
}
}