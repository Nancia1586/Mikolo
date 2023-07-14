CREATE TABLE Admin(
    id SERIAL PRIMARY KEY,
    email varchar(200),
    mdp varchar(50)
);
INSERT INTO Admin(email,mdp)
VALUES
    ('admin@gmail.com',md5('admin'));

CREATE TABLE Utilisateur(
    id SERIAL PRIMARY KEY,
    nom varchar(200),
    email varchar(200),
    mdp varchar(50)
);
INSERT INTO Utilisateur(nom,email,mdp)
VALUES
    ('Rajerison','rajerisonnancia@gmail.com',md5('1234')),
    ('Nancia','lalaina.nancia64@gmail.com',md5('1234')),
    ('Dina','randriamifidydina@gmail.com',md5('1234')),
    ('Lalaina','lalainarazafimalala14@gmail.com',md5('1234'));

CREATE TABLE PointVente(
    id SERIAL PRIMARY KEY,
    emplacement varchar(100),
    contact varchar(200)
);
INSERT INTO PointVente(emplacement,contact)
VALUES
    ('Behoririka','0341284823'),
    ('Analakely','0341235823'),
    ('Betongolo','0341273823'),
    ('Analamahitsy','0347284823');


CREATE TABLE UtilisateurPV(
    id SERIAL PRIMARY KEY,
    idutilisateur int,
    idPointVente int,
    FOREIGN KEY (idutilisateur) REFERENCES utilisateur(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id)
);


CREATE TABLE Marque(
    id SERIAL PRIMARY KEY,
    marque varchar(100)
);
INSERT INTO Marque(marque)
VALUES
    ('HP'),
    ('Lenovo'),
    ('Toshiba'),
    ('Asus');


CREATE TABLE CoreProcesseur(
    id SERIAL PRIMARY KEY,
    core varchar(50)
);
INSERT INTO CoreProcesseur(core)
VALUES
    ('i3'),
    ('i5'),
    ('i7'),
    ('i9');

CREATE TABLE Fabriquant(
    id SERIAL PRIMARY KEY,
    fabriquant varchar(100)
);
INSERT INTO Fabriquant(fabriquant)
VALUES
    ('Intel'),
    ('AMD');


CREATE TABLE Processeur(
    id SERIAL PRIMARY KEY,
    nbcoeur int,
    generation int,
    frequence double precision,
    idCoreProcesseur int,
    idFabriquant int,
    FOREIGN KEY (idCoreProcesseur) REFERENCES CoreProcesseur(id),
    FOREIGN KEY (idFabriquant) REFERENCES Fabriquant(id)
);
INSERT INTO Processeur(nbcoeur,generation,frequence,idCoreProcesseur,idFabriquant)
VALUES
    (2,5,2.5,1,1),
    (4,4,2.6,2,1),
    (6,8,2.8,3,2),
    (4,6,3.1,4,2);


CREATE TABLE ResolutionEcran(
    id SERIAL PRIMARY KEY,
    resolution varchar(50)
);
INSERT INTO ResolutionEcran(resolution)
VALUES
    ('Full HD'),
    ('Ultra HD'),
    ('HD');

CREATE TABLE AffichageEcran(
    id SERIAL PRIMARY KEY,
    affichage varchar(50)
);
INSERT INTO AffichageEcran(affichage)
VALUES
    ('LED'),
    ('OLED'),
    ('LCD');


CREATE TABLE Ecran(
    id SERIAL PRIMARY KEY,
    taille double precision,
    idresolution int,
    idaffichage int,
    FOREIGN KEY (idresolution) REFERENCES ResolutionEcran(id),
    FOREIGN KEY (idaffichage) REFERENCES AffichageEcran(id)
);
INSERT INTO Ecran(taille,idresolution,idaffichage)
VALUES
    (17,1,1),
    (14,2,2),
    (15,3,3);

CREATE TABLE TypeDisqueDur(
    id SERIAL PRIMARY KEY,
    type varchar(50)
);
INSERT INTO TypeDisqueDur(type)
VALUES
    ('SSD'),
    ('HDD');


CREATE TABLE DisqueDur(
    id SERIAL PRIMARY KEY,
    idtype int,
    capacite double precision,
    FOREIGN KEY (idtype) REFERENCES TypeDisqueDur(id)
);
INSERT INTO DisqueDur(idtype, capacite)
VALUES
    (1,256),
    (1,125),
    (1,512),
    (2,500),
    (2,250),
    (2,1000);


CREATE TABLE TypeRam(
    id SERIAL PRIMARY KEY,
    type varchar(50)
);
INSERT INTO TypeRam(type)
VALUES
    ('DDR3'),
    ('DDR4'),
    ('DDR5');

CREATE TABLE Ram(
    id SERIAL PRIMARY KEY,
    idtype int,
    capacite double precision,
    FOREIGN KEY (idtype) REFERENCES TypeRam(id)
);
INSERT INTO Ram(idtype, capacite)
VALUES
    (1,4),
    (1,8),
    (2,8),
    (2,12),
    (3,8),
    (3,16);

CREATE TABLE Laptop(
    id SERIAL PRIMARY KEY,
    reference varchar(100),
    idmarque int,
    idprocesseur int,
    idram int,
    idecran int,
    iddisquedur int,
    FOREIGN KEY (idmarque) REFERENCES marque(id),
    FOREIGN KEY (idprocesseur) REFERENCES processeur(id),
    FOREIGN KEY (idram) REFERENCES ram(id),
    FOREIGN KEY (idecran) REFERENCES ecran(id),
    FOREIGN KEY (iddisquedur) REFERENCES disquedur(id)
);
INSERT INTO Laptop(reference,idmarque,idprocesseur,idram,idecran,iddisquedur)
VALUES
    ('Victus Gaming 15',1,1,1,1,1),
    ('Laptop HP 250 G8',1,1,1,1,2),
    ('HP Pavilion 17-cd0xxx',1,2,2,1,3),
    ('HP EliteBook 830 G5',1,2,2,1,4),
    ('Lenovo V15 G2',2,2,3,2,5),
    ('Lenovo V15 ADA',2,3,3,2,6),
    ('Lenovo Yoga X1',2,3,4,2,1),
    ('Toshiba R63/U',3,3,4,2,2),
    ('Toshiba R63/P',3,1,5,3,3),
    ('Asus K46C',4,4,5,3,4),
    ('Asus ZenBook 13 Oled',4,4,6,3,5),
    ('Asus Rog Strix G16',4,4,6,3,6);

ALTER TABLE Laptop ADD COLUMN prix double precision;
ALTER TABLE Laptop ADD COLUMN prixachat double precision;

CREATE TABLE ArrivageMagasin(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    quantite int,
    prixunitaire double precision,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id)
);

CREATE TABLE SortieMagasin(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    quantite int,
    idPointVente int,
    prixunitaire double precision,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id)
);

CREATE TABLE MouvementMagasin(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    entree int,
    sortie int,
    prixunitaire double precision,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id)
);

CREATE TABLE ArrivagePV(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    quantite int,
    prixunitaire double precision,
    idPointVente int,
    idSortieMagasin int,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id),
    FOREIGN KEY (idSortieMagasin) REFERENCES SortieMagasin(id)
);

CREATE TABLE MouvementPV(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    entree int,
    sortie int,
    prixunitaire double precision,
    idPointVente int,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id)
);

CREATE TABLE RenvoiPV(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    quantite int,
    idPointVente int,
    prixunitaire double precision,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id)
);

CREATE TABLE ReceptionMagasin(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    quantite int,
    idPointVente int,
    prixunitaire double precision,
    idRenvoipv int,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id),
    FOREIGN KEY (idRenvoipv) REFERENCES RenvoiPV(id)
);


CREATE TABLE Client(
    id SERIAL PRIMARY KEY,
    nom varchar(200),
    contact varchar(200)
);
INSERT INTO Client(nom,contact)
VALUES
    ('Rakoto','0329282912'),
    ('Rasoa','0345788932'),
    ('Marie','0330229303'),
    ('Randria','0341601897');

CREATE TABLE Vente(
    id SERIAL PRIMARY KEY,
    date date,
    idClient int,
    idPointVente int,
    FOREIGN KEY (idclient) REFERENCES client(id),
    FOREIGN KEY (idPointVente) REFERENCES PointVente(id)
);

CREATE TABLE DetailVente(
    id SERIAL PRIMARY KEY,
    idVente int,
    idlaptop int,
    quantite int,
    prixunitaire double precision,
    FOREIGN KEY (idvente) REFERENCES vente(id),
    FOREIGN KEY (idlaptop) REFERENCES laptop(id)
);

CREATE TABLE Perte(
    id SERIAL PRIMARY KEY,
    date date,
    idlaptop int,
    quantite int,
    prixunitaire double precision,
    FOREIGN KEY (idlaptop) REFERENCES laptop(id)
);

CREATE TABLE Mois(
    id SERIAL PRIMARY KEY,
    numero int,
    nom varchar(50),
    abreviation varchar(50)
);
INSERT INTO Mois(numero,nom,abreviation)
VALUES
    (1,'Janvier','Jan'),
    (2,'Fevrier','Fev'),
    (3,'Mars','Mar'),
    (4,'Avril','Avr'),
    (5,'Mai','Mai'),
    (6,'Juin','Jui'),
    (7,'Juillet','Juil'),
    (8,'Aout','Aou'),
    (9,'Septembre','Sep'),
    (10,'Octobre','Oct'),
    (11,'Novembre','Nov'),
    (12,'Decembre','Dec');


-- CREATE TABLE HistoriquePrixVente(
--     id SERIAL PRIMARY KEY,
--     date date,
--     idlaptop int,
--     prixunitaire double precision,
--     FOREIGN KEY (idlaptop) REFERENCES laptop(id)
-- );

-- CREATE TABLE PrixVente(
--     id SERIAL PRIMARY KEY,
--     idlaptop int,
--     prixunitaire double precision,
--     FOREIGN KEY (idlaptop) REFERENCES laptop(id)
-- );
-- INSERT INTO PrixVente(idlaptop,prixunitaire)
-- VALUES
--     (1,'5500000'),
--     (2,'1700000'),
--     (4,'2800000'),
--     (5,'2000000'),
--     (6,'3000000'),
--     (7,'3900000'),
--     (8,'1700000'),
--     (9,'1900000'),
--     (10,'2500000'),
--     (11,'4000000'),
--     (12,'3500000'),
--     (14,'1600000');

CREATE TABLE Commission(
    id SERIAL PRIMARY KEY,
    mois int ,
    annee int,
    totalmin double precision,
    totalmax double precision,
    commission double precision
);
INSERT INTO Commission(mois,annee,totalmin,totalmax,commission)
VALUES
    (1,2022,0,2000000,2),
    (1,2022,2000001,5000000,5),
    (1,2022,5000001,11000000,10),
    (11,2022,0,3000000,3),
    (11,2022,3000001,6000000,7),
    (11,2022,6000001,400000000,12),
    (3,2023,0,2000000,2),
    (3,2023,2000001,5000000,6),
    (3,2023,5000001,400000000,12);


------------------------------------------------------------------------------------------------------
CREATE TABLE Panier(
    id SERIAL PRIMARY KEY,
    sessionid varchar(255),
    produitid int,
    quantite double precision
);

