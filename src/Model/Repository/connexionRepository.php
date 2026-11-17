<?php

function trouverEnseignantParEmail(PDO $connexion, string $email): ?array
{
	$requete = $connexion->prepare(
		'SELECT idEnseignant, nomEnseignant, prenomEnseignant, mailEnseignant, mdpEnseignant
		FROM enseignants
		WHERE mailEnseignant = :email'
	);
	$requete->execute(['email' => $email]);
    $enseignant = $requete->fetch(PDO::FETCH_ASSOC);
    if ($enseignant === false) {
        return null;
    } else {
        return $enseignant;
    }
}
