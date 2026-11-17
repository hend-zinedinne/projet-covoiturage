<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../View/view.php';

function afficherBienvenue(PDO $connexion): void
{
    afficherVue('bienvenue/index', [
        'titre' => 'Application de covoiturage',
        'pageCourante' => 'bienvenue',
        'alert' => $_SESSION['alert'] ?? 'Bienvenue ! L\'application a démarré avec succès.',
    ]);
}
