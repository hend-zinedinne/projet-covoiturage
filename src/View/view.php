<?php

/**
 * Affiche un fragment de views/ dans le layout commun.
 * Le nom de la vue et les données sont choisis par le contrôleur.
 */
function afficherVue(string $vue, array $donnees = []): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $enseignantConnecte = $_SESSION['enseignant'] ?? null;
    if (is_array($enseignantConnecte)) {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');
    }

    extract($donnees, EXTR_SKIP);
    $titre = $titre ?? 'Application de covoiturage';
    $pageCourante = $pageCourante ?? '';

    ob_start();
    require __DIR__ . '/../../views/' . $vue . '.php';
    $contenu = ob_get_clean();

    require __DIR__ . '/../../views/layout.php';
}
