<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="brand">
            <div>
                <p class="brand-title">Covoiturage entre enseignants</p>
                <?php if (is_array($enseignantConnecte)): ?>
                    <p class="subtitle">
                        Connecté : <?= htmlspecialchars(trim(($enseignantConnecte['prenom'] ?? '') . ' ' . ($enseignantConnecte['nom'] ?? ''))) ?>
                    </p>
                <?php else: ?>
                    <p class="subtitle">Partageons nos trajets entre collègues.</p>
                <?php endif; ?>
            </div>
        </div>

        <nav class="nav-bar" aria-label="Navigation principale">
            <a href="index.php?action=bienvenue"<?= $pageCourante === 'bienvenue' ? ' class="active" aria-current="page"' : '' ?>>Bienvenue</a>
            <?php if (!is_array($enseignantConnecte)): ?>
                <a href="index.php?action=creerCompte"<?= $pageCourante === 'creerCompte' ? ' class="active" aria-current="page"' : '' ?>>Créer votre compte</a>
                <a href="index.php?action=seConnecter"<?= $pageCourante === 'seConnecter' ? ' class="active" aria-current="page"' : '' ?>>Se connecter</a>
            <?php else: ?>
                <a href="index.php?action=seDeconnecter"<?= $pageCourante === 'seDeconnecter' ? ' class="active" aria-current="page"' : '' ?>>Se déconnecter</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <?= $contenu ?>
    </main>
</body>

</html>
