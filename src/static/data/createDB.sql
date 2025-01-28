DROP TABLE IF EXISTS UTILISATEUR;
DROP TABLE IF EXISTS PROPOSER;
DROP TABLE IF EXISTS RESTAURANT;
DROP TABLE IF EXISTS TYPE_CUISINE;

CREATE TABLE UTILISATEUR (
  id_utilisateur   INT NOT NULL,
  nom              VARCHAR(42),
  prenom           VARCHAR(42),
  email            VARCHAR(100),
  mdp              VARCHAR(64),
  role             TEXT CHECK (role in ('CLIENT','MODERATEUR','ADMIN')) DEFAULT 'CLIENT',
  PRIMARY KEY (id_utilisateur)
);

CREATE OR REPLACE TABLE RESTAURANT (
    id_restaurant SERIAL PRIMARY KEY,
    name VARCHAR,
    type VARCHAR,
    operator VARCHAR,
    brand VARCHAR,
    opening_hours VARCHAR,
    wheelchair BOOLEAN,
    vegetarian BOOLEAN,
    vegan BOOLEAN,
    delivery BOOLEAN,
    takeaway BOOLEAN,
    internet_access VARCHAR,
    stars INT,
    capacity INT,
    drive_through BOOLEAN,
    wikidata VARCHAR,
    brand_wikidata VARCHAR,
    siret VARCHAR,
    phone VARCHAR,
    website VARCHAR,
    facebook VARCHAR,
    smoking BOOLEAN,
    com_insee BIGINT,
    com_nom VARCHAR,
    region VARCHAR,
    code_region BIGINT,
    departement VARCHAR,
    code_departement BIGINT,
    commune VARCHAR,
    code_commune BIGINT,
    latitude DOUBLE PRECISION,
    longitude DOUBLE PRECISION
);

CREATE OR REPLACE TABLE TYPE_CUISINE (
    id_cuisine SERIAL PRIMARY KEY,
    cuisine VARCHAR NOT NULL
);

CREATE OR REPLACE TABLE PROPOSER (
    id_restaurant INT NOT NULL,
    id_cuisine INT NOT NULL,
    PRIMARY KEY (id_restaurant, id_cuisine),
    FOREIGN KEY (id_restaurant) REFERENCES RESTAURANT(id_restaurant),
    FOREIGN KEY (id_cuisine) REFERENCES TYPE_CUISINE(id_cuisine)
);


