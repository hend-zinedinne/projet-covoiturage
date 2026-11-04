<section aria-labelledby="titre-creercompte">
    <h1 id="titre-creercompte">Créer votre compte</h1>

    <?php if ($erreurs !== []): ?>
        <div class="alert alert-error">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                <li><?php echo htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?action=creerCompte" method="post">
        
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" value="<?php echo htmlspecialchars($nom) ?>" name="nom" placeholder="Entrez votre nom ici..." required/>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" value="<?php echo htmlspecialchars($prenom) ?>" name="prenom" placeholder="Entrez votre prénom ici..." required/>
        </div>

        <div class="form-group">
            <label for="email">Adresse électronique : </label>
            <input type="text" value="<?php echo htmlspecialchars($email) ?>" name="email" placeholder="Entrez votre adresse mail ici..." required/>
        </div>

        <div class="form-group">
            <label for="numTel">Numéro de téléphone : </label>
            <input type="text" value="<?php echo htmlspecialchars($numTel) ?>" name="numTel" placeholder="Entrez votre numéro de téléphone ici..." required/>
        </div>
        
        <div class="form-group">
            <label for="mdp">Mot de passe : </label>
            <input type="password" value="<?php echo htmlspecialchars($mdp) ?>" name="mdp" placeholder="Mot de passe personnel ici..." required/>
        </div>
        
        <div class="form-group">
            <label for="code">Code d'inscription : </label>
            <input type="text" value="<?php echo htmlspecialchars($codeInscription) ?>" name="code" placeholder="Votre code d'inscription fourni par le lycée." required/>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Créer votre compte</button>
            <a href="index.php?action=bienvenue" class="btn btn-outline">Annuler / Retour au menu</a>
        </div>
    </form>
</section>
