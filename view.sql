CREATE or REPLACE VIEW v_processeur as
select p.*,c.core,f.fabriquant from processeur p join coreprocesseur c on p.idcoreprocesseur = c.id join fabriquant f on p.idfabriquant = f.id;

CREATE or REPLACE VIEW v_ram as
select r.*,t.type from ram r join typeram t on r.idtype = t.id;

CREATE or REPLACE VIEW v_ecran as
select e.*,r.resolution,a.affichage from ecran e join resolutionecran r on e.idresolution = r.id join affichageecran a on e.idaffichage = a.id;

CREATE or REPLACE VIEW v_disquedur as
select d.*,t.type from disquedur d join typedisquedur t on d.idtype = t.id;

CREATE or REPLACE VIEW v_laptop as
select l.*,m.marque,p.nbcoeur,p.generation,p.frequence,p.idcoreprocesseur,p.idfabriquant,p.core,p.fabriquant,r.idtype as idtyperam,r.capacite as capaciteram,r.type as typeram,e.taille,e.idresolution,e.idaffichage,e.resolution,e.affichage,d.idtype as idtypedisque,d.capacite as capacitedisque,d.type as typedisque from laptop l join marque m on l.idmarque = m.id join v_processeur p on l.idprocesseur = p.id join v_ecran e on l.idecran = e.id join v_ram r on l.idram = r.id join v_disquedur d on l.iddisquedur = d.id;

CREATE or REPLACE VIEW v_utilisateurlibre as
select u.*,p.idutilisateur,p.idpointvente from utilisateur u left join utilisateurpv p on u.id = p.idutilisateur where p.idpointvente is null;

CREATE or REPLACE VIEW v_utilisateurpv as
select u.*,p.idutilisateur,p.idpointvente from utilisateur u left join utilisateurpv p on u.id = p.idutilisateur;

CREATE or REPLACE VIEW v_arrivagemagasin as
select m.*,l.reference,l.prix from arrivagemagasin m join laptop l on m.idlaptop = l.id;

CREATE or REPLACE VIEW v_mouvementmagasin as
select m.*,l.reference,l.prix from mouvementmagasin m join laptop l on m.idlaptop = l.id;

CREATE or REPLACE VIEW v_sortiemagasin as
select s.*,l.reference,l.prix,p.emplacement,p.contact from sortiemagasin s join laptop l on s.idlaptop = l.id join pointvente p on s.idpointvente = p.id;

CREATE or REPLACE VIEW v_situationstockmagasin as
select l.id,coalesce(sum(m.entree),0) as entree,coalesce(sum(m.sortie),0) as sortie from laptop l left join mouvementmagasin m on l.id = m.idlaptop group by l.id;

CREATE or REPLACE VIEW v_nombrerecupv as
select idsortiemagasin,sum(coalesce(quantite,0)) as recu from arrivagepv group by idsortiemagasin;

CREATE or REPLACE VIEW v_receptionpv as
select s.*,(s.quantite-coalesce(r.recu,0)) as reste from v_sortiemagasin s left join v_nombrerecupv r on s.id = r.idsortiemagasin;

CREATE or REPLACE VIEW v_listereceptionpv as
select a.*,l.reference from arrivagepv a join laptop l on a.idlaptop = l.id;

CREATE or REPLACE VIEW v_renvoipv as
select s.*,l.reference,l.prix,p.emplacement,p.contact from renvoipv s join laptop l on s.idlaptop = l.id join pointvente p on s.idpointvente = p.id;

CREATE or REPLACE VIEW v_situationstockpv as
select l.id,coalesce(sum(m.entree),0) as entree,coalesce(sum(m.sortie),0) as sortie from laptop l left join mouvementpv m on l.id = m.idlaptop group by l.id;

CREATE or REPLACE VIEW v_vente as
select v.*,c.nom,c.contact,p.emplacement from vente v join client c on v.idclient = c.id join pointvente p on v.idpointvente = p.id;

CREATE or REPLACE VIEW v_detailvente as
select d.*,l.reference,l.prix,v.date,v.idclient,v.idpointvente from detailvente d join laptop l on d.idlaptop = l.id join vente v on v.id = d.idvente;

CREATE or REPLACE VIEW v_nombrerecumagasin as
select idrenvoipv,sum(coalesce(quantite,0)) as recu from ReceptionMagasin group by idrenvoipv;

CREATE or REPLACE VIEW v_receptionmagasin as
select s.*,(s.quantite-coalesce(r.recu,0)) as reste from v_renvoipv s left join v_nombrerecumagasin r on s.id = r.idrenvoipv;

--Total vente par mois global (mbola tsy misy left join)
CREATE or REPLACE VIEW v_venteglobalmois as
select sum(quantite * prixunitaire) as total,extract(month from date) as mois from v_detailvente group by extract(month from date);

CREATE or REPLACE VIEW v_venteglobaltoutmois as
select m.*,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from mois m left join v_venteglobalmois v on m.numero = v.mois;

--Total vente par mois par point de vente (mbola tsy misy left join)
CREATE or REPLACE VIEW v_venteparpvmois as
select sum(quantite * prixunitaire) as total,extract(month from date) as mois,idpointvente from v_detailvente group by extract(month from date),idpointvente;

--Tout les mois par point de vente
CREATE or REPLACE VIEW v_allmoispv as
select pointvente.id,mois.numero as mois,mois.nom,mois.abreviation,pointvente.emplacement,pointvente.contact from mois,pointvente;

CREATE or REPLACE VIEW v_ventetoutpvtoutmois as
select a.*,coalesce(total,0) as total from v_allmoispv a left join v_venteparpvmois v on a.mois = v.mois and a.id = v.idpointvente;


--Achat par mois
CREATE or REPLACE VIEW v_achatglobalmois as
select sum(quantite * prixunitaire) as total,extract(month from date) as mois from v_arrivagemagasin group by extract(month from date);

CREATE or REPLACE VIEW v_achatglobaltoutmois as
select m.*,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from mois m left join v_achatglobalmois v on m.numero = v.mois;

--Perte par mois
CREATE or REPLACE VIEW v_perteglobalmois as
select sum(quantite * prixunitaire) as total,extract(month from date) as mois from perte group by extract(month from date);

CREATE or REPLACE VIEW v_perteglobaltoutmois as
select m.*,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from mois m left join v_perteglobalmois v on m.numero = v.mois;

CREATE or REPLACE VIEW v_beneficeglobaltoutmois as
select v.*,a.total as achat,p.total as perte,(v.total - (a.total + p.total)) as benefice from v_venteglobaltoutmois v join v_achatglobaltoutmois a on v.id = a.id join v_perteglobaltoutmois p on v.id = p.id;


--Raha misy filtre par annee
--1
CREATE or REPLACE VIEW v_anneeventeglobal as
select distinct(extract(year from date)) as annee from v_detailvente;

CREATE or REPLACE VIEW v_moisanneeventeglobal as
select * from mois,v_anneeventeglobal;

CREATE or REPLACE VIEW v_venteglobalmoisannee as
select sum(quantite) as quantite,sum(quantite * prixunitaire) as total,extract(month from date) as mois,extract(year from date) as annee from v_detailvente group by extract(month from date),extract(year from date);

CREATE or REPLACE VIEW v_venteglobaltoutmoisannee as
select m.*,coalesce(v.quantite,0) as quantite,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from v_moisanneeventeglobal m left join v_venteglobalmoisannee v on m.numero = v.mois and m.annee = v.annee;

--2
CREATE or REPLACE VIEW v_anneeventepv as
select distinct(extract(year from date)) as annee from v_detailvente;

CREATE or REPLACE VIEW v_moisanneeventepv as
select mois.*,v_anneeventepv.*,pointvente.id as idpointvente,pointvente.emplacement,pointvente.contact from mois,v_anneeventepv,pointvente;

CREATE or REPLACE VIEW v_venteparpvmoisannee as
select sum(quantite) as quantite,sum(quantite * prixunitaire) as total,extract(month from date) as mois,extract(year from date) as annee,idpointvente from v_detailvente group by extract(month from date),extract(year from date),idpointvente;

CREATE or REPLACE VIEW v_ventetoutpvtoutmoisannee as
select a.*,coalesce(v.quantite,0) as quantite,coalesce(total,0) as total from v_moisanneeventepv a left join v_venteparpvmoisannee v on a.numero = v.mois and a.annee = v.annee and a.idpointvente = v.idpointvente;

--3
--Achat
-- CREATE or REPLACE VIEW v_achatglobalmoisannee as
-- select sum(quantite * prixunitaire) as total,extract(month from date) as mois,extract(year from date) as annee from v_arrivagemagasin group by extract(month from date),extract(year from date);

-- CREATE or REPLACE VIEW v_anneeachatglobal as
-- select distinct(extract(year from date)) as annee from v_arrivagemagasin;

-- CREATE or REPLACE VIEW v_moisanneeachatglobal as
-- select * from mois,v_anneeachatglobal;

-- CREATE or REPLACE VIEW v_achatglobaltoutmoisannee as
-- select m.*,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from v_moisanneeachatglobal m left join v_achatglobalmoisannee v on m.numero = v.mois;


CREATE or REPLACE VIEW v_venteachatmoisannee as
select sum(quantite) as quantite,sum(v.quantite * l.prixachat) as totalachat,sum(v.quantite * l.prix) as totalvente,extract(month from date) as mois,extract(year from date) as annee from v_detailvente v join laptop l on v.idlaptop = l.id group by extract(month from date),extract(year from date);

CREATE or REPLACE VIEW v_venteachattoutmoisannee as
select m.*,coalesce(v.quantite,0) as quantite,coalesce(v.totalvente,0) as totalvente,coalesce(v.totalachat,0) as totalachat,coalesce(v.mois,m.numero) as mois from v_moisanneeventeglobal m left join v_venteachatmoisannee v on m.numero = v.mois and m.annee = v.annee;

--Perte
CREATE or REPLACE VIEW v_perteglobalmoisannee as
select sum(quantite * prixunitaire) as total,extract(month from date) as mois,extract(year from date) as annee from perte group by extract(month from date),extract(year from date);

CREATE or REPLACE VIEW v_anneeperteglobal as
select distinct(extract(year from date)) as annee from perte;

CREATE or REPLACE VIEW v_moisanneeperteglobal as
select * from mois,v_anneeperteglobal;

CREATE or REPLACE VIEW v_perteglobaltoutmoisannee as
select m.*,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from v_moisanneeperteglobal m left join v_perteglobalmoisannee v on m.numero = v.mois and m.annee = v.annee;;

--Benefice
-- CREATE or REPLACE VIEW v_beneficeglobaltoutmoisannee as
-- select v.*,a.total as achat,p.total as perte,(v.total - (a.total + p.total)) as benefice from v_venteglobaltoutmoisannee v full join v_achatglobaltoutmoisannee a on v.numero = a.numero and v.annee = a.annee full join v_perteglobaltoutmoisannee p on v.numero = p.numero and v.annee = p.annee;

-- CREATE or REPLACE VIEW v_anneebenefice as
-- select distinct(annee) as annee from v_beneficeglobaltoutmoisannee;

CREATE or REPLACE VIEW v_beneficeglobaltoutmoisannee as
select
    v.*,
    (v.totalvente - v.totalachat) as beneficebrute,
    p.total as perte,
    (v.totalvente - (v.totalachat + p.total)) as benefice
from v_venteachattoutmoisannee v
    full join v_perteglobaltoutmoisannee p on v.numero = p.numero and v.annee = p.annee;



----------------------------------------------------------------------------------------------------------------------------------------
--Benefice par mois,annee par point de vente
--achat
-- CREATE or REPLACE VIEW v_venteachatmoisanneepv as
-- select sum(quantite) as quantite,sum(v.quantite * l.prixachat) as totalachat,sum(v.quantite * l.prix) as totalvente,extract(month from date) as mois,extract(year from date) as annee,idpointvente from v_detailvente v join laptop l on v.idlaptop = l.id group by extract(month from date),extract(year from date),idpointvente;

-- CREATE or REPLACE VIEW v_venteachattoutmoisanneepv as
-- select m.*,coalesce(v.quantite,0) as quantite,coalesce(v.totalvente,0) as totalvente,coalesce(v.totalachat,0) as totalachat,coalesce(v.mois,m.numero) as mois from v_moisanneeventepv m left join v_venteachatmoisanneepv v on m.numero = v.mois and m.annee = v.annee and m.idpointvente = v.idpointvente;

--perte
-- CREATE or REPLACE VIEW v_perteglobalmoisanneepv as
-- select sum(quantite * prixunitaire) as total,extract(month from date) as mois,extract(year from date) as annee,idpoint from perte group by extract(month from date),extract(year from date);

-- CREATE or REPLACE VIEW v_anneeperteglobal as
-- select distinct(extract(year from date)) as annee from perte;

-- CREATE or REPLACE VIEW v_moisanneeperteglobal as
-- select * from mois,v_anneeperteglobal;

-- CREATE or REPLACE VIEW v_perteglobaltoutmoisannee as
-- select m.*,coalesce(v.total,0) as total,coalesce(v.mois,m.numero) as mois from v_moisanneeperteglobal m left join v_perteglobalmoisannee v on m.numero = v.mois and m.annee = v.annee;;

