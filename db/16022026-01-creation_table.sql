create database bngrc;
use bngrc;

create table ville(
    id int primary key auto_increment,
    nom varchar (200),
    region varchar(200)
);

create table besoin(
    id int primary key auto_increment,
    id_ville int ,
    id_type int ,
    qte_besoin_ville int ,
    prix_unitaire int,
    date_saisie datetime 
);

create table type_besoin (
    id int primary key auto_increment,
    nom_type varchar(200),
    unite varchar(50),
    id_categorie int 
);

create table don(
    id int primary key auto_increment,
    id_type int,
    qte int,
    date_saisie datetime
);

create table historique(
    id int primary key auto_increment,
    id_don int,
    id_besoin int,
    qte int,
    date_mvt datetime 

);

create table categorie(
    id int primary key auto_increment,
    nom_categorie varchar(200),
    descri TEXT 
);

/*cles etrangere*/

ALTER TABLE besoin
ADD CONSTRAINT fk_besoin_ville
FOREIGN KEY (id_ville) REFERENCES ville(id);

ALTER TABLE besoin
ADD CONSTRAINT fk_besoin_type
FOREIGN KEY (id_type) REFERENCES type_besoin(id);

ALTER TABLE type_besoin
ADD CONSTRAINT fk_type_categorie
FOREIGN KEY (id_categorie) REFERENCES categorie(id);

ALTER TABLE don
ADD CONSTRAINT fk_don_type
FOREIGN KEY (id_type) REFERENCES type_besoin(id);


ALTER TABLE historique
ADD CONSTRAINT fk_hist_don
FOREIGN KEY (id_don) REFERENCES don(id);

ALTER TABLE historique
ADD CONSTRAINT fk_hist_besoin
FOREIGN KEY (id_besoin) REFERENCES besoin(id);
