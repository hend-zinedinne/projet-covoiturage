<?php

function getCodeInscription(PDO $connexion) {
    $sql = "SELECT code FROM parametres";

    $requete = $connexion->query($sql);
    return $requete->fetch();
}

function trouverEnseignantfromEmail(PDO $connexion, string $email) {
    $sql = "SELECT mailEnseignant FROM enseignants WHERE mailEnseignant = :email";
    $requete = $connexion->query($sql);
    $requete->execute(["email"=> $email]);
    return $requete->fetch();
}
function insertEnseignant(PDO $connexion, string $nom, string $prenom, string $email, string $numTel, string $mdp) {
    $sql = "INSERT INTO enseignants (
    idEnseignant,
    nomEnseignant,
    prenomEnseignant,
    mailEnseignant,
    numTelEnseignant,
    mdpEnseignant)
    VALUES(:id,:nom,:prenom,:email,:numTel,:mdp)";
    $requete = $connexion->prepare($sql);
    $requete->execute(
        [
        "id"=>time(),
        "nom"=> $nom,
        "prenom"=> $prenom,
        "email"=> $email,
        "numTel"=> $numTel,
        "mdp"=> $mdp
        ]
    );
}