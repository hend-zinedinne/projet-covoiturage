<section aria-labelledby="titre-bienvenue">
    <?php if (is_array($enseignantConnecte)): ?>
        <h1 id="titre-bienvenue">Bonjour <?= htmlspecialchars(trim(($enseignantConnecte['prenom'] ?? '') . ' ' . ($enseignantConnecte['nom'] ?? '')), ENT_QUOTES, 'UTF-8') ?></h1>
    <?php else: ?>
        <h1 id="titre-bienvenue">Application de covoiturage</h1>
    <?php endif; ?>
    <div class="alert alert-success">
        <p><?= htmlspecialchars($alert) ?></p>
    </div>
    <p>Un espace pour organiser vos trajets entre collègues.</p>
</section>
