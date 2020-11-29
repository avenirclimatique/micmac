<!doctype html>
<html class="no-js" lang="fr">
    <head>
        <!-- Basic page needs   ============================================ -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MicMac | Faire le test</title>
        <meta name="description" content="">
        <!-- Mobile metas       ============================================ -->
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
        <link rel="stylesheet" type="text/css" href="lib/rs-plugin/css/settings.css" media="screen"/>
        <!-- normalize CSS      ============================================ -->
        <link rel="stylesheet" href="css/normalize.css">
        <!-- main CSS           ============================================ -->
        <link rel="stylesheet" href="css/main.css">
        <!-- style CSS          ============================================ -->
        <link rel="stylesheet" href="css/style.css">
        <!-- connect form CSS   ============================================ -->
        <link rel="stylesheet" href="css/connect.css">
        <!-- result graphs and tables CSS   ================================ -->
        <link rel="stylesheet" href="css/SimulationCarbone.css">
        <!-- result table CSS   ============================================ -->
        <link rel="stylesheet" href="css/table_res.css">
        <link rel="stylesheet" href="css/res_table_mm.css">
        <!-- responsive CSS     ============================================ -->
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="js/jquery.qtip.css">
        <!-- modernizr js       ============================================ -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        
    </head>
    <body class="home-2 home-3">
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add the header via php -->
        <?php include 'php/header.php';?>
        <!-- Add your site or application content here -->
        <div class="company-area fix">
            <div class="container">
                <div class="row">
                    <div id="conso-title" class="col-xs-12">
                        <div class="section-heading-3" style="margin-bottom: 0px;">
                            <h2>Saisissez vos consommations</h2>
                        </div>
                        <div id="form-simul-micmac" class="qa-accordion"></div><!-- Place where all the fields are loaded-->
                        <button id="envoyer" class="btn-micmac" onClick="F_CarbAssessment();">Calculer</button><!-- send button-->
                        
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12">
                <!-- Results. Hidden until they are checked-->
                <div id="res-table" style="text-align: center; display: none;">
                    <button id="reedit" class="btn-micmac" onClick="F_reedit();">Modifier la saisie</button>
                    <button id="sauv" class="btn-micmac" onClick="F_sauv();">Sauvegarder le bilan</button>
                    <br><br>
                    <h2>TOTAL GÉNÉRAL (avec services publics) </h2>
                     <table class="res-table-mm" border="1" align="middle" style="margin: auto;padding:6px">
                    <!--<table class=responstable> -->
                        <tr style="margin: auto;padding:6px">
                            <th></th>
                            <th>kg eq Carbone</th>
                            <th>kg eq CO<SUB>2</SUB></th>
                        </tr>
                        <tr>
                            <td><b>Votre total</b></td>
                            <td id="tot-carb-serv"></td>
                            <td id="tot-co2-serv"></td>
                        </tr>
                        <tr>
                            <td><b>Moyenne française</b></td>
                            <td>2630</td>
                            <td>9644</td>
                        </tr>
                        <tr>
                            <td><b>Objectif 2050</b></td>
                            <td>500</td>
                            <td>1800</td>
                        </tr>
                    </table>
                    <br/>
                    <!-- tableau histo et camembert -->
                    <div id="myChart"    class=smallGraph ></div>
                    <div id="myChartcam" class=smallGraph ></div>
                    <br/>
                    
                    <h2>VOTRE HISTORIQUE</h2>
                    <h3 id=HistorySubTitle>en kg équivalent Carbone</h3>
                    <div id="myHistory"  class=histoGraph ></div>
                    
                    <br/><br/>
                    <h2>TOTAL GÉNÉRAL (hors services publics)</h2>
                    <table class="res-table-mm" border="1" align="middle" style="margin: auto;padding:6px">
                        <tr>
                            <th></th>
                            <th>kg eq Carbone</th>
                            <th>kg eq CO<SUB>2</SUB></th>
                        </tr>
                        <tr>
                            <td><b>Votre total</b></td>
                            <td id="tot-carb"></td>
                            <td id="tot-co2"></td>
                        </tr>
                        <tr>
                            <td><b>Moyenne française</b></td>
                            <td>2280</td>
                            <td>8360</td>
                        </tr>
                    </table>
                    
                    <br/><br/>
                    <h2>PROPOSITION VOLONTAIRE POUR LE <A href=https://fr.wikipedia.org/wiki/Prix_du_carbone target=_blank>SIGNAL PRIX CARBONE</A></h2>
                    <div style="margin: auto;padding: 10px;">
                        <table style="align: center;margin: auto;padding: 10px;width:90%"><tr>
                            <td>
                                <img src="./images/leonardoDiCaprio.png" alt="Léonardo Dicaprio" style="width:200px;">
                            </td>
                            <td style="padding: 10px;text-align:left">
                                Comme Leonardo Dicaprio, ambassadeur climat de l’ONU (voir son dernier documentaire 
                                <A href=https://www.theguardian.com/film/2016/oct/20/before-the-flood-review-leonardo-dicaprio-climate-change-documentary target=_blank>
                                Before the Flood</A>), vous pouvez vous appliquer le prix carbone sur votre empreinte carbone 2016.<br>
                                En utilisant le prix de <strong>32€ par tonne de CO2</strong> (soit un peu moins de 10 centimes par litre de carburant)
                                proposé par <A href=http://www.geo.fr/environnement/actualite-durable/environnement-taxe-carbone-rocard-44975 target=_blank>
                                la commission Rocard en 2009</A>, vous devriez payer pour vos émissions de l'année : <u><strong><p id=carbonPrice style="display:inline"></p></strong></u><br>
                                La proposition de TaCa d’un Signal Prix Carbone mondial prévoit une redistribution totale à part égale pour
                                chaque être humain qui est évaluée pour 2016 à 200 € (à déduire du paiement).<br><br>
                                
                                Je soutiens cette proposition en m’engageant a faire un don du montant du prix carbone que j’aurais du payer en 2016 aupres d’une association de mon choix.<br>
                                Je signale mon soutien par un mail à <a href="mailto:contact@taca.asso.fr">contact@taca.asso.fr</a>
                            </td>
                        </tr></table>
                    </div>
                    <br><br><br>
                    
                    <h2>PERFORMANCE DE VOTRE LOGEMENT</h2>
                    <p id=perfoEnergy></p>
                    <div id="EperfoContainer">
                        <img class="perfoImg" src="./img/perf_energetique.png" alt="Performance Energétique" style="width:400px;">
                        <canvas id="EperfoCanvas" width="400" height="340" style=""></canvas>
                    </div>
                    <p id=perfoClimat></p>
                    <div id="CperfoContainer">
                        <img class="perfoImg" src="./img/perf_climatique.png" alt="Performance Climatique" style="width:400px;">
                        <canvas id="CperfoCanvas" width="400" height="483" style=""></canvas>
                    </div>
                    
                    <br><br>
                    <button id="reedit" class="btn-micmac" onClick="F_reedit();">Modifier la saisie</button>
                    <button id="sauv" class="btn-micmac" onClick="F_sauv();">Sauvegarder le bilan</button>
                    
                    <br><br><br><br><br><br>
                    <h2>Pour plus de détails sur vos résultats</h2>
                    <h4>(en attendant que notre dévelopeur fasse mieux &#x1f609; en intégrant ceci dans les graphs)</h4>
                    <h4>Les valeurs ne peuvent avoir une telle précision à partir de facteur d'émissions. Les chiffres après la virgule ne sont là que pour vérifier la précision des calculs, pas des résultats!</h4>
                    
                    <!-- temp solution to display detailed results -->
                    <div class="col-xs-12">
                        <div class="table-responsive">
                            <table class="responstable tableWithFloatingHeader" id=tempstorage></table>
                        </div>
                    </div>
                    <br>
                    <button id="envoyer" class="btn-micmac" onClick="F_resetField();">ResetData</button><!-- send button-->
                </div>
            </div>
        </div>
        <!-- Add the footer via php -->
        <?php include 'php/footer.php';?>
        
        <!-- Specific for this page-->
        <script src="js/simulation.carbone.js"></script>
        
    </body>
</html>