<?php

function getCodeInscription(PDO $connexion) {
    $sql = "SELECT code FROM parametres";

    $requete = $connexion->query($sql);
    return $requete->fetch();
}

function insertEnseignant(PDO $connexion, string $nom, string $prenom, string $email, string $numTel, string $mdp) {
}