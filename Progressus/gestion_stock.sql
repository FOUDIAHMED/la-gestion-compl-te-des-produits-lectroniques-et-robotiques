CREATE TABLE categorie(
    idcategorie int PRIMARY KEY,
	description varchar(100),
    photo varchar(100),
    nom varchar(100) 
);

CREATE TABLE produit(
    idproduit int PRIMARY KEY,
    idcat int,
    reference varchar(30),
    code_bar varchar(30),
    prix_offre float NOT null,
    prix_final float NOT null,
    prix_achat float NOT null,
    qantity int not null,
    qantity_min int not null,
    CONSTRAINT fk_cat FOREIGN KEY(idcat)  REFERENCES categorie(idcategorie)
    );