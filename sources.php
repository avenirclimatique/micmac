<!doctype html>
<html class="no-js" lang="fr">
    <head>
        <!-- Basic page needs   ============================================ -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MicMac | Sources</title>
        <meta name="description" content="">
        <!-- Mobile specific metas  ============================================ -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts              ============================================ -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700' rel='stylesheet' type='text/css'>
        <!-- Favicon            ============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <!-- CSS  -->
        <!-- Bootstrap CSS      ============================================ -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- font-awesome CSS   ============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- owl.carousel CSS   ============================================ -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <!-- animate CSS        ============================================ -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- fancybox CSS       ============================================ -->
        <link rel="stylesheet" href="css/fancybox/jquery.fancybox.css">
        <!-- meanmenu CSS       ============================================ -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <!-- RS slider CSS      ============================================ -->
        <link rel="stylesheet" type="text/css" href="lib/rs-plugin/css/settings.css" media="screen" />
        <!-- normalize CSS      ============================================ -->
        <link rel="stylesheet" href="css/normalize.css">
        <!-- main CSS           ============================================ -->
        <link rel="stylesheet" href="css/main.css">
        <!-- style CSS          ============================================ -->
        <link rel="stylesheet" href="css/style.css">
        <!-- connect form CSS    ============================================ -->
        <link rel="stylesheet" href="css/connect.css">
        <!-- responsive CSS     ============================================ -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- modernizr js       ============================================ -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>    
        <link rel="stylesheet" href="css/table_res.css">
    </head>
    <body class="home-2 home-3">
        <!--[if lt IE 8]>            
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add the header via php -->
        <?php include 'php/header.php';?>
        <!-- Add your site or application content here --> 
        <div class="company-area fix">
            <div class="containe2">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section-heading-3">
                            <h2>Sources des données</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="section-heading-3" style="margin-bottom: 0px;">
                            <H1>Ce site est basé sur un outil Excel précédemment dévellopé conjointement par Avenir Climatique et TACA <br>
                            <a href="http://avenirclimatique.org/les-outils/">Cliquez ici pour utiliser la version Excel du MicMac</a></H1>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="responstable tableWithFloatingHeader">
                                <tr>
                                    <th style="width:15%">Postes d'émissions</th>
                                    <th style="width:5% ">gr éq carbone</th>
                                    <th style="width:5% ">gr éq CO<SUB>2</SUB></th>
                                    <th style="width:5% ">/Unité</th>
                                    <th style="width:50%">Explications et sources</th>
                                    <th style="width:20%">Liens vers les sources</th>
                                </tr>
                                <tr>
                                    <th colspan="6">Logement</th>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Electricité</td>
                                </tr>
                                <tr>
                                    <td>Electricité: Fournisseur classique</td>
                                    <td>22</td>
                                    <td>80</td>
                                    <td>/kWh</td>
                                    <td>Base Carbone - Electricité, Mix moyen, France continentale, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Fournisseur élec. Verte</td>
                                    <td>2.0</td>
                                    <td>7.33</td>
                                    <td>/kWh</td>
                                    <td>Approximé à l'éolien, Base Carbone - Electricité par mode de production, éolien, calcul ACV inclus, pertes réseau inclus, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Gaz et fioul</td>
                                </tr>
                                <tr>
                                    <td>Gaz</td>
                                    <td>59</td>
                                    <td>218</td>
                                    <td>/kWh PCI</td>
                                    <td>D'après la Base Carbone (241 g CO2e/kWh PCI) et ratio PCI/PCS = 0,9028. Base Carbone - Gaz naturel, amont et combustion, France continentale, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Fioul</td>
                                    <td>1</td>
                                    <td>4</td>
                                    <td>/litre</td>
                                    <td>Émissions du fioul amont et combustion (884 g Ce/litre) arrondies à 1 kg Ce/litre pour des raisons mnemotechniques et pour tenir compte de l'amortissement de la chaudière (pas de source à ce sujet). Base Carbone - Fioul domestique, amont et combustion, France continentale, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Simulation Facture énergétique</td>
                                </tr>
                                <tr>
                                    <td>Cout du kWh électrique</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>€/kWh</td>
                                    <td>Estimation du cout du kWh par divers fournisseur, et divers type de compteur.<br>
                                    La valeur utilisée est soit une moyenne de l'ensemble, ces valeurs changeant peu d'un fournisseur à un autre, soit la sélection du fournisseur</td>
                                    <td><A href="http://www.jechange.fr/energie/electricite/guides/prix-electricite-kwh-2435">JeChange.fr (életricité)</A></td>
                                </tr>
                                <tr>
                                    <td>Cout du kWh de divers sources</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>€/kWh</td>
                                    <td>Estimation du cout du kWh pour divers source énergétiques</td>
                                    <td><A href="https://elyotherm.fr/comparatif-cout-energies-kwh">Elyotherm.fr</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Calcul de la performance énergétique du logement</td>
                                </tr>
                                <tr>
                                    <td>Performances énergétiques</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>Conversion du gaz en PCI : facteur 0,9028<br>
                                        Conversion de l'électricité en équivalent primaire :<br>
                                        - facteur de conversion de 2,58 pour EDF/classique<br>
                                        - facteur de conversion de 1,05 pour électricité verte.<br>
                                        En considérant l'électricité verte comme provenant à 100 % de renouvelables.</td>
                                    <td><A href=""></A></td>
                                </tr>
                                <tr>
                                    <td>Réglementation RT2005</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td style="padding:0px; background:#FFFFFF">
                                        Consommation maximale exprimée en énergie primaire pour les consommations
                                        de chauffage, refroidissement et production d’eau chaude sanitaire
                                        <div>
                                            <table style="width:100%" class=subTable>
                                                <tr><td style="width:10%">Zone Climatique</td><td>Combustibles fossiles </td><td>Chauffage électrique (y compris pompes à chaleur)</td></tr>
                                                <tr><td>H1             </td><td>130 kWh primaire/m2/an</td><td>250 kWh primaire/m2/an                           </td></tr>
                                                <tr><td>H2             </td><td>110 kWh primaire/m2/an</td><td>190 kWh primaire/m2/an                           </td></tr>
                                                <tr><td>H3             </td><td>80 kWh primaire/m2/an </td><td>130 kWh primaire/m2/an                           </td></tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td><A href="http://www.developpement-durable.gouv.fr/IMG/DGALN_Essentiel_RT2005.pdf">developpement-durable.gouv.fr</A></td>
                                </tr>
                                <tr>
                                    <td>Réglementation RT2012</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>Consommation maximale en énergie de 50 kwh/m2/an pour le chauffage, l'eau
                                        chaude, la climatisation et l'éclairage. Ce seuil de  50 kWh est une moyenne, qui est corrigée par
                                        des coefficients tenant compte d'un ensemble de critères, en particulier la
                                        situation géographique, l'altitude, et le type d'usage du bâtiment. Donc le
                                        seuil est plus bas sur la côte d'Azur qu'à Lille ou à Paris, par exemple. 
                                    </td>
                                    <td><A href="http://www.francetvinfo.fr/replay-radio/modes-de-vie/rt2012-la-norme-qui-va-vous-faire-economiser-l-energie_1739289.html">francetvinfo.fr</A></td>
                                </tr>
                                <tr>
                                    <td>Réglementation RT2020</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>La RT2020 va mettre en œuvre le concept de bâtiment à énergie positive, appelé aussi "BEPOS" au sein du Plan Bâtiment Durable.<br> 
                                    Les bâtiments à énergie positive sont des bâtiments qui produisent plus d’énergie (chaleur, électricité) qu'ils n’en consomment.<br>
                                    Ce sont en général des bâtiments passifs très performants et fortement équipés en moyens de production énergétique par rapport à leurs besoins en énergie.<br>
                                    Les murs, toits, voire fenêtres peuvent être mis à profit dans l'accumulation et la restitution de la chaleur ou dans la production d’électricité.<br>
                                    L'excédent en énergie se fait grâce à des principes bioclimatiques et constructifs mais aussi par le comportement des usagers qui vont limiter leur consommation.<br>
                                    Une étude menée par l'ADEME en juin 2012 montre que pour la centaine de réalisations à énergie positive en France (65 % dans le tertiaire, 29 % en pavillons individuels et 6 % en logements collectifs) la consommation est d'environ 50 kWh/m2/an.
                                    </td>
                                    <td><A href="http://www.rt-2020.com/">rt-2020.com</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Transport</th>
                                </tr>
                                
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Voiture et moto</td>
                                </tr>
                                <tr>
                                    <td>Voiture à essence/gazole</td>
                                    <td>1 019</td>
                                    <td>3 737</td>
                                    <td>/litres essence</td>
                                    <td>Sur la base d'une moyenne essence (2,95 kg CO2e/L) et gazole (3,19 kg CO2e/L) pour les émissions de combustion du carburant avec amont à quoi on ajoute les émissions de fabrication de la voiture raportées à son utilisation (40 g CO2e/km) sur la base de 6 litres/100 km de conso moyenne. Le résultat de 3,737 kg CO2e/litre=1,019 kg Ce/litre est arrondi à 1 kg Ce/litre pour des raisons mnemotechnique. Base carbone - Voiture, fabrication amortie sur durée de vie ; Essence pure, amont et combustion ; Gazole pur, amont et combustion, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Voiture au gaz</td>
                                    <td>684</td>
                                    <td>2 507</td>
                                    <td>/litre gaz</td>
                                    <td>Sur la base des émissions du GPL (1,84 kg CO2e/litres) à quoi on ajoute les émissions de fabrication de la voiture raportées à son utilisation (40 g CO2e/km) sur la base de 6 litres/100 km de conso moyenne. Base carbone - Voiture, fabrication amortie sur durée de vie ; GPL, gaz de pétrole liquéfié, amont et combustion, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Moto/Scooter/Mobilette</td>
                                    <td>1</td>
                                    <td>4</td>
                                    <td>/litre essence</td>
                                    <td>En reprenant le même chiffre que pour la voiture à essence/gazole pour des raisons mnemotechniques.</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Longues distances</td>
                                </tr>
                                <tr>
                                    <td>Avion</td>
                                    <td>51 341</td>
                                    <td>188 250</td>
                                    <td>/heure de vol (un passager)</td>
                                    <td>Déterminé sur la base de 251 gCO2e/(passager.km) et d'une vitesse de 750 km/h. Base Carbone - Avion, déplacement/voyage, 180-250 sièges, 3000-4000 km, carburant et amortissement de la fabrication du véhicule ; ordre de grandeur de vitesse tiré de ABM, consulté le 05/09/2014</td>
                                    <td><A href=http://www.abm.fr/voyager-en-avion-le-guide-du-passager/en-complement/distances-et-durees-de-vol.html>www.abm.fr, le guide du passage en avion</A><br>
                                    <A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Train</td>
                                    <td>1.5</td>
                                    <td>5.6</td>
                                    <td>/km (pour un passager)</td>
                                    <td>Base Carbone - Train grandes lignes, électricité ACV, pertes réseau incluses, France continentale, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Transport en commun</td>
                                </tr>
                                <tr>
                                    <td>Nb heures bus/semaine</td>
                                    <td>543</td>
                                    <td>1992</td>
                                    <td>/heures (pour un passager)</td>
                                    <td>Sur la base de 166 gCO2e/(passager.km) et de 12 km/h de vitesse moyenne - Base Carbone - Bus, moyen, réseaux urbains Classe 2 (zone urbaine et interurbaine) - amont et combustion ; Mairie de Paris pour la vitesse des bus, consulté le 05/09/2014</td>
                                    <td><A href=http://www.paris.fr/pratique/deplacements-voirie/transports-en-commun/promouvoir-les-transports-collectifs/rub_385_stand_10755_port_1208>www.paris.fr, transports en commun</A><br>
                                    <A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Nb heures metro/semaine</td>
                                    <td>45</td>
                                    <td>166</td>
                                    <td>/heures (pour un passager)</td>
                                    <td>Sur la base de 6,63 gCO2e/(passager.km) et de 25 km/h de vitesse moyenne. Base Carbone- Métro/tram/Trolley, réseaux urbains Classe 1 - amont et combustion ; transports.blog.lemonde.fr, consulté le 05/09/2014</td>
                                    <td><A href=http://transports.blog.lemonde.fr/2013/03/11/les-petits-secrets-de-la-ratp-reveles-au-public/>le Monde.fr, les petits secrets de la ratp reveles au public</A><br>
                                    <A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Alimentation</th>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Viandes et Poisson</td>
                                </tr>
                                <tr>
                                    <td>Viande de bœuf, veau, mouton</td>
                                    <td>5455</td>
                                    <td>20000</td>
                                    <td>/kg</td>
                                    <td>Sur la base de 17 600 gCO2e/kg pour la vache de réforme et des valeurs supérieures à 25 000 gCO2e/kg pour veau, bœuf, mouton ; Base Carbone - vache allaintante de réforme, fabrication ; Base Carbone - veau fabrication ; Base Carbone - Bœuf - Fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Viande de porc</td>
                                    <td>1414</td>
                                    <td>5185</td>
                                    <td>/kg</td>
                                    <td>Base Carbone - Cochon, fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Volaille et œufs</td>
                                    <td>818</td>
                                    <td>3000</td>
                                    <td>/kg</td>
                                    <td>Sur la base de 2 816 gCO2e/kg de volaille industrielle, de 3 176 gCO2e/kg pour l'oeuf et de valeurs supérieures à 3 500 gCO2e/kg pour poulet fermier, pintade et canard. Base Carbone - Vollaille industrielle, fabrication ; Base Carbone - Œuf, fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Poisson</td>
                                    <td>522</td>
                                    <td>1914</td>
                                    <td>/kg</td>
                                    <td>Base Carbone - Pêche europenne, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Produits bio dans la viande</td>
                                    <td colspan=3><strike>30 % d'émissions en moins</strike></td>
                                    <td>Ancienne option à supprimer, influence non significative pour les émissions de gaz à effet de serre.</td>
                                    <td><A href=http://www.manicore.com/documentation/serre/assiette.html>Manicore: Combien de gaz à effet de serre dans notre assiette ?</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Produits Laitiers</td>
                                </tr>
                                <tr>
                                    <td>Fromage et beurre</td>
                                    <td>2727</td>
                                    <td>10000</td>
                                    <td>/kg</td>
                                    <td>Sur la base de 10 065 gCO2e/kg pour le beurre, 7247 gCO2e/kg pour les fromages à pâte molle et 13 805 gCO2e/kg pour les fromages à pâte dure. Base Carbone - Beurre, fabrication ; Fromage, pâte molle, fabrication ; Fromage, pâte dure, fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Laitages</td>
                                    <td>659</td>
                                    <td>2416</td>
                                    <td>/kg</td>
                                    <td>Base Carbone - Yaourts, fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Lait</td>
                                    <td>329</td>
                                    <td>1 208</td>
                                    <td>/litre</td>
                                    <td>Base Carbone - Lait de vache, fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Fruits et légumes (kg/semaine)</td>
                                </tr>
                                <tr>
                                    <td>hors saison/non local/exotique</td>
                                    <td>754</td>
                                    <td>2766</td>
                                    <td>/kg</td>
                                    <td>Sur la base de Base Carbone - Tomates, sous serre, fabrication, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Légumes arrivés par avion</td>
                                    <td>3000</td>
                                    <td>11000</td>
                                    <td>/kg</td>
                                    <td>Sur la base de 5000 km en moyen courrier à 611 g Ce/(kg.km) - Guide des facteurs d'émissions V6 de l'ADEME, chapître transport, p54</td>
                                    <td><A href="http://www2.ademe.fr/servlet/KBaseShow?catid=24826">ADEME</A></td>
                                </tr>
                                <tr>
                                    <td>Légumes de saison : très faibles émissions</td>
                                    <td>32</td>
                                    <td>117</td>
                                    <td>/kg</td>
                                    <td>Base Carbone - Autres fruits et légumes de saison, consulté le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Plats cuisinés et conserves</td>
                                    <td>754</td>
                                    <td>2766</td>
                                    <td>/kg</td>
                                    <td>Sur la base de l'indice carbone de Casino sur un échantillon de plats cuisinés. http://www.produits-casino.fr, consulté le 25/08/2014</td>
                                    <td><A href="http://www.produits-casino.fr/developpement-durable/dd_indice-carbone-produits.html?debut_passerelle=15#pagination_passerelle">Casino</A></td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Pain, pâtes, riz</td>
                                </tr>
                                <tr>
                                    <td>Pain, pâtes</td>
                                    <td>150</td>
                                    <td>550</td>
                                    <td>/kg</td>
                                    <td>D'après un document de la ville de Mundolsheim qui cite l'ADEME, consulté en 2014. Mise à jour prévue avec la nouvelle version d'Agribalyse en 2020.</td>
                                    <td><s>Document : http://www.mundolsheim.fr/publicmedia/original/179/24/fr/Facteurs%20%C3%A9missions%20aliments.pdf</s></td>
                                </tr>
                                <tr>
                                    <td>Riz</td>
                                    <td>750</td>
                                    <td>2750</td>
                                    <td>/kg</td>
                                    <td>D'après un document de la ville de Mundolsheim qui cite l'ADEME, consulté en 2014. Mise à jour prévue avec la nouvelle version d'Agribalyse.</td>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Boissons</td>
                                </tr>
                                <tr>
                                    <td>Alcool</td>
                                    <td>400</td>
                                    <td>1467</td>
                                    <td>/litre</td>
                                    <td>Sur la base du vin à 1467 gCO2e/kg. Base Carbone - Vin, Fabrication, consulté le 05/09/2014</td>
                                    <td><A href="http://www.basecarbone.fr">Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Sodas, jus, sirops, etc.</td>
                                    <td>164</td>
                                    <td>600</td>
                                    <td>/litre</td>
                                    <td>Sur la base de l'indice carbone Casino de 60 g CO2e/100g du diabolo à la grenadine. Www.casino.fr, consulté le 05/09/2014</td>
                                    <td><A href="http://www.produits-casino.fr/vos-produits/famili/enfants-190/alimentaire/diabolo-a-la-grenadine.html">Casino</A></td>
                                </tr>
                                <tr>
                                    <td>Eau en bouteille</td>
                                    <td>44795</td>
                                    <td>164250</td>
                                    <td>/an</td>
                                    <td>Sur la base d'une consommation d'une bouteille de 1,5 litres par jour à 30 g CO2e/100g. Casino, indice carbone - Eau de source 1,5 L, consulté le 05/09/2014</td>
                                    <td><A href="http://www.produits-casino.fr/vos-produits/plaisir-de-cuisiner/boissons/eaux/eau-de-source-1-5l.html">Casino</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Biens et services</th>
                                </tr>
                                <tr>
                                    <td>Matériel informatique-électronique</td>
                                    <td>908</td>
                                    <td>3328</td>
                                    <td>/€</td>
                                    <td>Sur la base d'écran LCD 24 pouces (431 kgCOe/appareil) à 200 €, d'ordinateur portable (1900 kgCO2/appareil) à 350 €, de smartphone (480 kgCOe/appareil) à 200 €. Base Carbone - Ecran LCD 24 pouces ; Ordinateur portable>15 pouces, consulté le 05/09/2014</td>
                                    <td><A href="http://www.basecarbone.fr">Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Produits manufacturés (vêtement, livres, mobilier, électroménager, etc.)</td>
                                    <td>35</td>
                                    <td>128</td>
                                    <td>/€</td>
                                    <td>Sur la base de livres (1100 gCO2e/livre) à 20 € et d'une cuisinière avec 20 kg d'acier 50 % recyclé (2000 gCO2e/kg ; moyenne de neuf et recyclé) à 200 €. Base Carbone - Livre 300g ; Acier ou fer blanc neuf, fabrication ; Acier ou fer blanc, recyclé, fabrication, consulté le 05/09/2014</td>
                                    <td><A href="http://www.basecarbone.fr">Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Finance</th>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Valeur en € de vos actifs financiers (épargne, livrets, actions, assurance vie, PEL, ...)</td>
                                </tr>
                                <tr>
                                    <td>Banques/actifs classiques</td>
                                    <td>3.1</td>
                                    <td>11.3</td>
                                    <td>/€</td>
                                    <td>d'intérêts	Sur la base de BNP Paribas (émissions annuelles de 905 gCO2e/€), en considérant, contrairement à l'utilisation qui est faite par epargneclimat.com et au vu de leur méthodologie de calcul, que ces émissions sont à appliquer aux dividendes touchés et non à l'épargne totale. Les dividendes en fonction de l'épargne ou des actifs sont évalués sur la base d'un taux d'intérêt de 1,25 % (taux du livret A). epagneclimat.com, consulté le 05/09/2014</td>
                                    <td><A href="https://avenirclimatique.org/micmac/2013-Epargneclimat.com-%20Classement%20banques.pdf">Rapport Epargne Climat</A></td>
                                </tr>
                                <tr>
                                    <td>Banques/actifs "responsables"</td>
                                    <td>0.9</td>
                                    <td>3.4</td>
                                    <td>/€</td>
                                    <td>d'intérêts	Sur la base d'une moyenne entre La Banque Postale (émissions annuelles de 480 gCO2e/€) et la Nef (émissions annuelles de 200 gCO2e/€), en considérant, contrairement à l'utilisation qui est faite par epargneclimat.com et au vu de leur méthodologie de calcul, que ces émissions sont à appliquer aux dividendes touchés et non à l'épargne totale. Les dividendes en fonction de l'épargne ou des actifs sont évalués sur la base d'un taux d'intérêt de 1 % (au lieu de 1,25 % en épargne classique, en considérant que ces placements sont moins rentables), consulté le 05/09/2014</td>
                                    <td><A href="https://avenirclimatique.org/micmac/2013-Epargneclimat.com-%20Classement%20banques.pdf">Rapport Epargne Climat</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Services publics</th>
                                </tr>
                                <tr style='background-color: #bedada;'>
                                    <td colspan="6">Services gratuits de l'Etat et des collectivités: Santé, routes, éducation, justice, défense, etc.</td>
                                </tr>
                                <tr>
                                    <td>Forfait individuel identique pour tous</td>
                                    <td>350116</td>
                                    <td>1283760</td>
                                    <td>/citoyen</td>
                                    <td>Sur la base des services d'utilité publique. Carbone 4 - Services d'utilité publique, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Pénalité nucléaire artificielle</td>
                                    <td>130</td>
                                    <td>477</td>
                                    <td>/kWh</td>
                                    <td>Sur la base de l'électricité produite par des centrales à gaz. Guide des facteurs d'émissions ADEME Version 6, chapître énergie, tableau 26, consulté le 05/09/2014</td>
                                    <td><A href="http://www2.ademe.fr/servlet/KBaseShow?catid=24826">ADEME</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Moyennes</th>
                                </tr>
                                <tr>
                                    <td>Logement - moyenne française</td>
                                    <td>424364</td>
                                    <td>1556000</td>
                                    <td>/personnes</td>
                                    <td>Carbone 4 - Energie des logements 2010, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Transports - moyenne française</td>
                                    <td>501273</td>
                                    <td>1838000</td>
                                    <td>/citoyen</td>
                                    <td>Carbone 4 - Transports 2010, consulté le 05/09/2014	</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Alimentation - moyenne française</td>
                                    <td>670091</td>
                                    <td>2457000</td>
                                    <td>/citoyen</td>
                                    <td>Carbone 4 - Alimentation 2010, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Biens et services - moyenne française</td>
                                    <td>548215</td>
                                    <td>2010120</td>
                                    <td>/citoyen</td>
                                    <td>Sur la base des estimations Carbone 4 des émissions des biens de consommations moins le fret. Carbone 4 - Autres biens de consommations 2010 ; Fret de marchandises et distribution 2010, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Finance - moyenne française</td>
                                    <td>136156</td>
                                    <td>499240</td>
                                    <td>/citoyen</td>
                                    <td>Carbone 4 - Services privés 2010, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Services publics - moyenne française</td>
                                    <td>350116</td>
                                    <td>1283760</td>
                                    <td>/citoyen</td>
                                    <td>Carbone 4 - Services d'utilité publique 2010, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <td>Émissions totales - moyenne française</td>
                                    <td>2630215</td>
                                    <td>9644120</td>
                                    <td>/citoyen</td>
                                    <td>Carbone 4 - Services d'utilité publique 2010, consulté le 05/09/2014</td>
                                    <td><A href="http://www.carbone4.com/notre-revolution-carbone/">Carbone 4</A></td>
                                </tr>
                                <tr>
                                    <th colspan="6">Simulation prix carbone</th>
                                </tr>
                                <tr>
                                    <td>Calcul impact d'une augmentation de prix des carburants</td>
                                    <td colspan=3>Surcoût saisie( en €/litre) / 0,87 x émissions (en kg Ce)</td>
                                    <td>
                                        Sur la base de 3,19 kg CO2e/litre soit 0,87 kg Ce/litre pour le gazole, on considère que chaque kg Ce émis (tout poste compris) vient de la consommaton de 1,149 L de gazole et on applique le surcoût saisie.  Base Carbone - Gazole pur, amont et combustion, consultée le 05/09/2014</td>
                                    <td><A href=http://www.basecarbone.fr>Base Carbone</A></td>
                                </tr>
                                <tr>
                                    <td>Calcul impact d'une prix/taxe CO2</td>
                                    <td colspan=3>Prix CO2 saisi (en €/tonne CO2e) * émissions (en kg Ce) * 44/12/1000</td>
                                    <td>
                                        Sur la base de la conversion 1 tonne CO2e = 12/44*1000 kg Ce</td>
                                    <td><A href=""></A></td>
                                </tr>
                                <tr>
                                    <td>Calcul du montant du chèque CO2 redistribuée</td>
                                    <td colspan=3>Prix CO2 saisi (en €/tonne CO2e) * émissions moyennes françaises (en tonne CO2)</td>
                                    <td>
                                        Sur la base des émissions moyennes françaises calculées ci-dessus.</td>
                                    <td><A href=""></A></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add the footer via php -->
        <?php include 'php/footer.php';?>
    </body>
</html>
