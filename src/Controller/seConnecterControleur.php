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
        $email = trim($_POST['email'] ?? '');
        $mdp = ($_POST['mdp'] ?? '');

        if ($email === '') {
            $erreurs[] = "L'adresse mail est obligatoire.";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $erreurs[] = "L'adresse mail est invalide.";
        }

        if ($mdp === '') {
            $erreurs[] = "Le mot de passe est obligatoire.";
        }

        if ($erreurs === []) {
            $utilisateur = trouverEnseignantParEmail($connexion, $email);

            if ($utilisateur === null || !password_verify($mdp, $utilisateur['mdpEnseignant'])) {
                $erreurs[] = "Adresse mail ou mot de passe incorrect.";
            } else {
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }

                session_regenerate_id(true);
                $_SESSION['enseignant'] = [
                    'id' => $utilisateur['idEnseignant'],
                    'nom' => $utilisateur['nomEnseignant'],
                    'prenom' => $utilisateur['prenomEnseignant'],
                    'email' => $utilisateur['mailEnseignant'],
                ];

                $_SESSION['alert'] = "Connexion réussie. Bienvenue, " . $utilisateur['prenomEnseignant'] . " !";

                header('Location: index.php?action=bienvenue');
                exit();
            }
        }
    }

    afficherVue('seConnecter/index', [
        'titre' => 'Se connecter',
        'pageCourante' => 'seConnecter',
        'erreurs' => $erreurs,
        'email' => $email,
    ]);
}