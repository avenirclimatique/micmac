-- génération de la base de données ici

drop database if exists micmac;
create database micmac;
use micmac;

drop table if exists domaine;
create table domaine (
  id int not null auto_increment primary key,
  label varchar(255),
  commentaires longtext
);

drop table if exists champ_type;
create table champ_type (
  id int not null auto_increment primary key,
  label varchar(255)
);

drop table if exists champ;
create table champ (
  id int not null auto_increment primary key,
  label varchar(255),
  valeurUnitaireCarbone double,
  unite varchar(50),
  formule varchar(255),
  id_domaine int,
  id_champ_type int,
  priorite int,
  FOREIGN KEY (id_domaine) REFERENCES domaine(id),
  FOREIGN KEY (id_champ_type) REFERENCES champ_type(id)
);

drop table if exists formule;
create table formule (
  id int not null auto_increment primary key,
  f mediumtext not null,
  id_champ int,
  FOREIGN KEY (id_champ) REFERENCES champ(id)
);


drop table if exists user;
create table user (
  id int not null auto_increment primary key,
  login varchar(255),
  mdp varchar(255)
);

drop table if exists resultat;
create table resultat (
  id int not null auto_increment primary key,
  total_general double,
  total_general_SP double,
  date_push DATETIME DEFAULT CURRENT_TIMESTAMP,
  login varchar(255)
);

insert into domaine(id,label, commentaires) values
  (1,'Logement', 'En règle générale, les données à rentrer dans cet outil sont vos données personnelles et pas celles de votre foyer.

Le logement est un cas particulier : il faut rentrer les consommations de votre foyer et son nombre d''occupants. L''outil divise les émissions du foyer en part égale pour chaque occupant.
La surface du logement est utilisée dans la partie resultat pour comparer votre logement avec des standards au m2.

Astuce : Vous trouverez vos consommations annuelles d''énergie sur vos factures de gaz et d''électricité ou sur votre compte en ligne sur le site de votre fournisseur.

En première approximation l''outil néglige l''impact du chauffage au bois.

Si vous utilisez plusieurs logements (par exemple une residence secondaire) il faut se debrouiller à "ramener" ces consommations dans celles du logement principal.
'),
(2,'Transports (hors transports professionnels)', '"Indiquez vos déplacements personnels et pas les déplacements professionnels.

Kilométrage annuel de vos déplacements PERSONNELS (cela comprend le trajet maison-travail mais pas ceux effectués dans le cadre de vos fonctions)
Nombre moyen d''usagers : les personnes vous accompagnant de manière régulière et partageant donc l''usage du vehicule.
Conso moyenne aux 100 : ci-dessous des valeurs standards si vous ne savez pas la consommation de votre voiture (source, guide facteurs émissions ADEME V6) :
* Essence : 6L (5CV et moins), 7L (6 à 10 CV), 11L (11 CV et plus)
* Diesel : 7L (5CV et moins), 9L (6 à 10 CV), 11L (11 CV et plus)
* Hybride : enlever 15 % aux consommations ci-dessus (source ADEME : http://www2.ademe.fr/servlet/KBaseShow?catid=13655)

Attention pour l''avion : on vous demande le nombre d''heures par an dans l''avion (afin de pénaliser les vols court courrier).

Attention pour le train et les transports en commun : le nombre d''heures par semaine à indiquer est le nombre d''heure effectivement passées dans le bus ou le métro, il ne faut pas compter le temps d''attente aux correspondances. Le train de banlieue et le RER comptent dans le temps de métro et non de train."
'),
(3,'Alimentation','INDICATEURS
(pour apprécier la quantité totale pour 1 SEMAINE)

Viande
* Un steack haché pèse 100 g environ
* Un oeuf pèse environ 50 g : 6 oeufs pèsent 0,3 kg ; 20 oeufs pèsent 1 kg
* Une portion: 0,15Kg

Laitages
Portion fromage : 0,05Kg
Portion laitages : 0,125Kg

Exemples de fruits et légumes arrivés par avion :
* Cerises, fraises et raisins de l''hémisphère sud,
* Ananas de Côte d''Ivoire, litchis de la Réunion
* Bananes, oranges d''Amérique du Sud

Plats cuisinés et conserves
Une boîte de conserve format classique contient 0,8 kg
'),
(4,'Biens et services','"Biens de consommation : Euros/an

L''énergie grise, c''est à dire le carbone nécessité pour fabriquer les objets qu''on achète, est beaucoup plus importante dans les objets et services de haute technologie que dans les objets et services courants (vêtements, mobilier, plombier).
Il s''agit ici de répartir votre budget d''achat annuel entre les 2 postes proposés. Mettre les abonnements téléphonie dans le 1er poste.

N''oubliez pas les budgets cadeau Noël et anniversaire. Scoop: les dons à taca et Avenir Climatique sont estimés à 0g Ce/€ !"
'),
(5,'Finance','"Finances : Euros

Il faut estimer ici la valeur de vos actifs financiers (divisez par 2 si vous êtes en couple avec communauté réduite aux acquets).

L''empreinte carbone est différente entre les placements classiques et les placements responsables."
'),
(6,'Services publics','');




insert into champ_type(id, label) values
(1, 'Voiture à essence/gazole'),
(2, 'Voiture au gaz'),
(3, 'Moto/Scooter/Mobilette'),
(4, 'Avion'),
(5, 'Train'),
(6, 'Transports en commun'),
(7, 'Viandes et poissons (kg/semaine)'),
(8, 'Produits bio dans la viande'),
(9, 'Laitages (par semaine)'),
(10,'Fruits et légumes frais (kg/semaine)'),
(11,'Plats cuisinés et boîtes de conserves (kg/semaine)'),
(12,'Pain, pâtes, riz, etc (kg/semaine)'),
(13,'Boissons (litres/semaine)'),
(14,'Buvez-vous votre eau en bouteille ?'),
(15,'Dépenses annuelles en €'),
(16,'Valeur en € de vos actifs financiers (épargne, livrets, actions, assurance vie, PEL, ...)'),
(17,'Services gratuits de l''Etat et des collectivités (Santé, routes, éducation, justice, défense, etc.)'),
(18, 'Caractéristiques du logement'),
(19, 'Électricité (conso annuelle en kWh)'),
(20, 'Gaz et fioul (consommation annuelle)');


insert into champ (id, label, valeurUnitaireCarbone, unite, id_domaine, id_champ_type, priorite)
values
(13, 'Nombre d habitants du logement', 0, 'Personnes', 1, 18,2),
(14, 'Surface logement (m²)', 0, 'm2', 1, 18,2),

(16, 'Fournisseur classique (EDF, ...)', 22, 'kg C/1000kWh', 1, 19,2),
(17, 'Fournisseur électricité verte', 1.99909090909091, 'kg C/1000kWh', 1, 19,1),

(19, 'Gaz en kWh',59.3385818181818,  'kg C/1000kWh', 1, 20,2),
(20, 'Fioul en litres', 1, 'kg C/Litre', 1, 20,2),

(25, 'Kilométrage annuel', 1, 'kg C/Litre', 2, 1,2),
(26, 'Nombre moyen d usagers', 0, 'Usagers', 2, 1,2),
(27, 'Conso moyenne aux 100km', 0, 'Litres', 2, 1,2),

(29, 'Kilométrage annuel', 0.7, 'kg C/Litre', 2, 2,2),
(30, 'Nombre moyen d usagers', 0, 'Usagers', 2, 2,2),
(31, 'Conso moyenne aux 100km', 0, 'Litres', 2, 2,2),

(33, 'Kilométrage annuel', 1, 'kg C/Litre', 2, 3,1),
(34, 'Conso moyenne aux 100km', 0, 'Litres', 2, 3,1),

(36, 'Nombre d heures de vol par an', 51.3409090909091, 'kg C/heure', 2, 4,1),

(38, 'Kilométrage annuel', 0.2, 'kg C/(100 km)', 2, 5,1),

(40, 'Nombre d heures de bus/semaine', 0.54, 'kg C/heure', 2, 6,1),
(41, 'Nombre d''heures de métro/semaine', 0.05, 'kg C/heure', 2, 6,2),

(46, 'Viandes de bœuf, veau, mouton', 5.45454545454545, 'kg C/kg', 3, 7,2),
(47, 'Viande de porc', 1.41409090909091, 'kg C/kg', 3, 7,2),
(48, 'Volaille et œufs', 0.818181818181818, 'kg C/kg', 3, 7,2),
(49, 'Poisson', 0.522, 'kg C/kg', 3, 7,2),

(51, '% de bio dans viande', 0.3, 'Part évité', 3, 8,1),

(53, 'Fromage et beurre (kg)', 2.72727272727273, 'kg C/kg', 3, 9,2),
(54, 'Laitages (kg)', 0.658909090909091, 'kg C/kg', 3, 9,1),
(55, 'Lait (litres)', 0.329454545454545, 'kg C/litre', 3, 9,1),

(57, 'Hors saison/non local/exotique', 0.754363636363636, 'kg C/kg', 3, 10,2),
(58, 'Arrivé par avion', 3, 'kg C/kg', 3, 10,1),
(59, 'Local et de saison', 0.0319090909090909, 'kg C/kg', 3, 10,1),

(61, 'Plats cuisinés, boîtes conserves, etc', 0.754363636363636, 'kg C/kg', 3, 11,1),

(63, 'Pain, pâtes', 0.15, 'kg C/kg', 3, 12,2),
(64, 'Riz', 0.75, 'kg C/kg', 3, 12,1),

(66, 'Alcool (tous types)', 0.400090909090909, 'kg C/kg', 3, 13,2),
(67, 'Sodas, jus, sirops, etc.', 0.163636363636364, 'kg C/kg', 3, 13,1),

(69, 'Cochez la case si oui', 30, 'kg C/an', 3, 14,1),

(74, 'Matériel informatique-téléphonie mobile (€/an)', 907.597402597402, 'kg C/1000€', 4, 15,2),
(75, 'Produits manufacturés (vêtements, livres, mobilier, électroménager, etc.) (€/an)', 34.7727272727273,' kg C/1000€', 4, 15,2),

(80, 'Banques/actifs classiques', 3.08522727272727, 'kg C/1000€', 5, 16,1),
(81, 'Banques/actifs "responsables"', 0.927272727272727, 'kg C/1000€', 5, 16,1),

(86, 'Forfait individuel identique pour tous', 350.116363636364, 'kg C/citoyen', 6, 17,1);

insert into user (login, mdp)
values
('aurelien','aurelien'),
('Geoffrey','Geoffrey');


-- il manque la case à cocher traitement nucléaire...



-- requête pour construire le formulaire de simulation
select d.label as domaine, ct.label as cat, c.label, c.unite, c.id from micmac.domaine as d, micmac.champ as c, micmac.champ_type as ct
where d.id =c.id_domaine and c.id_champ_type = ct.id;

select d.label as domaine, ct.label as cat, c.label, c.unite, c.id
                from micmac.domaine as d, micmac.champ as c, micmac.champ_type as ct
                where d.id =c.id_domaine and c.id_champ_type = ct.id;