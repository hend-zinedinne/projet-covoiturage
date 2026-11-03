CREATE TABLE enseignants (
    idEnseignant VARCHAR AUTOINCREMENT,
    nomEnseignant VARCHAR,
    prenomEnseignant VARCHAR,
    mailEnseignant VARCHAR,
    numTelEnseignant VARCHAR,
    mdpEnseignant VARCHAR,
    codeInscription VARCHAR,

    CONSTRAINT PK_ENSEIGNANTS PRIMARY KEY(idEnseignant)
)