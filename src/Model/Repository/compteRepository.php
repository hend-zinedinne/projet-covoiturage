<?php

function getCodeInscription(PDO $connexion) {
    $sql = "SELECT code FROM parametres";

    $requete = $pdo->query($sql);
    return $requete->fetch(PDO::FETCH_NUM);
}