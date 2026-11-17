<?php

//---------------------------
// Contrôleur permettant de traiter toutes les actions liées à la gestion des films
//---------------------------

// Responsabilité : coordonner le traitement d'une requête lié à la notion de film

// Accès au modèle
require_once __DIR__ . "/../Model/Repository/connexionRepository.php";
// Accès à la fonction de rendu de vues (render)
require_once __DIR__ . "/../View/view.php";

function afficherSeConnecter(PDO $connexion): void
{
    $erreurs = [];
    $email = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim((string) ($_POST['email'] ?? ''));
        $mdp = (string) ($_POST['mdp'] ?? '');

        if ($email === '') {
            $erreurs[] = "L'adresse électronique est obligatoire.";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $erreurs[] = "L'adresse électronique est invalide.";
        }

        if ($mdp === '') {
            $erreurs[] = "Le mot de passe est obligatoire.";
        }

        if ($erreurs === []) {
            $erreurs[] = "La vérification des identifiants n'est pas encore configurée.";
        }
    }

    afficherVue('seConnecter/index', [
        'titre' => 'Se connecter',
        'pageCourante' => 'seConnecter',
        'erreurs' => $erreurs,
        'email' => $email,
    ]);
}