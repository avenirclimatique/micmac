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
        <!-- result table CSS   ============================================ -->
        <link rel="stylesheet" href="css/table_res.css">
        <!-- responsive CSS     ============================================ -->
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="js/jquery.qtip.css">
        <!-- modernizr js       ============================================ -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <style type="text/css">
            .res-table-mm {
                font-size: 18px;
            }
            .res-table-mm td {
                background: white;
                padding: 5px;
            }
            .res-table-mm thead td {
                background: #256075 !important;
                color: white;
            }
            .qTipInput {
                background: #333333 
            }
        </style>
    </head>
    <body class="home-2 home-3">
        <div id=divTools1 style="float: left;position: fixed; top:auto;z-index:99999999">
            <button id="openTools" class="btn-micmac" onClick="document.getElementById('divTools').style.display='block';document.getElementById('divTools1').style.display='none'">Outils</button>
        </div>
        <div id=divTools style="float: left;position: fixed; top:auto;z-index:99999999;overflow-y: auto;display:none">
            <span onclick="document.getElementById('divTools').style.display='none';document.getElementById('divTools1').style.display='block'" class="close" title="Close Modal">&times;</span>
            <br>
            <iframe id="iCalculette" src="http://www.epargneclimat.com/gadget-200.html" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:531px;" ></iframe >
            <br>
            <iframe width="219" height="302" src="http://www.calculator-1.com/outdoor/?f=666666&r=000000" scrolling="no" frameborder="0"></iframe>
        </div>
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
                            <h2>TOTAL GÉNÉRAL (avec services publics) </h2>
                            <div style="height: 300px; background : white; display: inline-block">
                                <canvas id="myChart" width="412" height="300"></canvas>
                            </div>
                            <div style="height: 300px; background : white; display: inline-block">
                                <canvas id="myChartcam" width="412" height="300"></canvas>
                            </div>
                            <br/>
                            <br/>
                            <table class="res-table-mm" border="1" align="middle" style="margin: auto;">
                                <tr>
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
                            <br/>
                            <br/>
                            <h2>TOTAL GÉNÉRAL (hors services publics)</h2>
                            <table class="res-table-mm" border="1" align="middle" style="margin: auto;">
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
                            <br>
                            <br>
                            <br>
                            <h2>Performance de votre logement</h2>
                            <p id=perfoEnergy></p>
                            <img src="./img/perf_energetique.png" alt="Performance Energétique" style="width:400px;">
                            <p id=perfoClimat></p>
                            <img src="./img/perf_climatique.png"  alt="Performance Climatique"  style="width:400px;">
                            <br>
                            <br>
                            <button id="reedit" class="btn-micmac" onClick="F_reedit();">Modifier la saisie</button>
                            <button id="sauv" class="btn-micmac" onClick="F_sauv();">Sauvegarder le bilan</button>
                            <p id=tempstorage></p>
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