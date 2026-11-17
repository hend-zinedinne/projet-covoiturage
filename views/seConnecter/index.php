<section aria-labelledby="titre-seconnecter">
    <h1 id="titre-seconnecter">Se connecter</h1>

    <?php if (!empty($erreurs)): ?>
        <div class="alert alert-error" role="alert">
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?action=seConnecter" method="post">
        <div class="form-group">
            <label for="email">Adresse électronique :</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required placeholder="Entrez votre adresse mail...">
        </div>

        <div class="form-group">
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" required placeholder="Entrez votre mot de passe...">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</section>
