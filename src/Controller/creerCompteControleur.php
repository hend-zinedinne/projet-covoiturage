<?php

//---------------------------
// Contrôleur permettant de traiter toutes les actions liées à la gestion des films
//---------------------------

// Responsabilité : coordonner le traitement d'une requête lié à la notion de film

// Accès au modèle
require_once __DIR__ . "/../Model/Repository/compteRepository.php";
// Accès à la fonction de rendu de vues (render)
require_once __DIR__ . "/../View/view.php";

// Traitement de l'actin "action=creerCompte"
function afficherCreerCompte(PDO $connexion): void
{
    $erreurs         = [];
    $nom             = '';
    $prenom          = '';
    $email           = '';
    $numTel          = '';
    $mdp             = '';
    $codeInscription = '';

    // Soumission du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Récupération des valeurs saisies
        $nom       = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $numTel = trim($_POST['numTel']);
        $mdp = trim($_POST['mdp']);
        $codeInscription = trim($_POST['code']);

        $emailValide = trouverEnseignantfromEmail($connexion, $email);
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
        } elseif ($emailValide) {
            $erreurs[] = "Ce compte est déjà pris par un autre utilisateur.";
        }
        if ($numTel === '') {
            $erreurs[] = "Le numéro de téléphone est obligatoire.";
        } elseif (verifierNumero($numTel) === false) {
            $erreurs[] = "Le numéro de téléphone est invalide.";
        }
        if ($mdp === '') {
            $erreurs[] = "Le mot de passe est obligatoire.";
        }
        if (getCodeInscription($connexion) === [] || getCodeInscription($connexion) === null) {
            $erreurs[] = "Le service d'inscription est indisponible. Veuillez réessayer plus tard.";
        }
        elseif ($codeInscription !== strval(getCodeInscription($connexion))) {
            $erreurs[] = "Le code d'inscription est incorrect.";
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
                "nom"    => $nom,
                "prenom" => $prenom,
                "email"  => $email,
                "numTel" => $numTel,
                "code" => $codeInscription,
                 ]);
            };
            // redirection vers la page de bienvenue
            session_start();
            $_SESSION['alert'] = "Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.";
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

function verifierNumero(string $phone):bool{
    return preg_match("#[0][67][- \.?]?([0-9][0-9][- \.?]?){4}$#", $phone);
}