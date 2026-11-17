<?php

function afficherSeDeconnecter(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // détruire la session pour déconnecter l'utilisateur
    session_destroy();

    // rediriger vers la page de bienvenue après la déconnexion
    header('Location: index.php?action=seConnecter');
    exit();
}