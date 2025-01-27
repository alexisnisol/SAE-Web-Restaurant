DROP TABLE IF EXISTS UTILISATEUR;

CREATE TABLE UTILISATEUR (
  id_utilisateur   INT NOT NULL,
  nom              VARCHAR(42),
  prenom           VARCHAR(42),
  email            VARCHAR(100),
  mdp              VARCHAR(64),
  role             TEXT CHECK (role in ('CLIENT','MODERATEUR','ADMIN')) DEFAULT 'CLIENT',
  PRIMARY KEY (id_utilisateur)
);