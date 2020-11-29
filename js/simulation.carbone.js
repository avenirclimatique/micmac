/**
 * Created by   aureliengarret  on 12/06/2016.
 *  Edited by   Raphaël Biet    on 04/11/2016.
 */
var fullDisplay = false;
// var domToField = [];
var G_aFIELDS = [] ;
var G_aDOMAINES = [] ;
var G_aCATEGORIES = [] ;
var G_aUSERDATA = [] ;
var myChart = {} ;
var myChartcam = {} ;
var myChartHisto = {} ;

$(document).ready(function() {
    if (document.location.hash.replace("#", "") == "short")
        fullDisplay = false;
    else
        fullDisplay = true;
    
    // catch all the fields from the DB, then continnue page loading
    F_getDBinfo();
    
})

///////////////////////////////////////  Load Page  /////////////////////////////////
// run on body load, catch all the fields from the DB, then continnue page loading
function F_getDBinfo(){
    // in case user is already connected
    var sLogin = F_getCookie("username");
    
    $.ajax({
        url: 'php/api2.php',
        type: "POST",
        data: {
            selector: 'loadPage',
            type    : "download",
            logon   : sLogin,
        },
        dataType: 'json',
        success: function(data, status) {
            //on receive of reply
            // console.log("success: all    - " + data + " ---- " + status) ;
            // console.log("success: field  - " + JSON.stringify(data[0]) + " ---- " + status) ;
            // console.log("success: cat    - " + JSON.stringify(data[1]) + " ---- " + status) ;
            // console.log("success: domain - " + JSON.stringify(data[2]) + " ---- " + status) ;
            // console.log("success: user   - " + JSON.stringify(data[3]) + " ---- " + status) ;
            
            G_aFIELDS       = data[0] ;
            G_aCATEGORIES   = data[1] ;
            G_aDOMAINES     = data[2] ;
            G_aUSERDATA     = data[3] ;
            
            // now build page
            F_constructFields();
            
            // Add user saved value if any
            F_updateFieldsValues();
        },
        error: function(data, status, error) {
            console.log("Error.\n - Results:\n" + JSON.stringify(data) + "\n - Status:\n" + status + "\n - Error:\n" + error);
        },
        complete: function(data, status, error) {
            console.log("loaded");
            // console.log("complete (field load). status: " + status);
            // if user already saved values, retrieve and udpate
            // F_getUserInfoFromDB() ;
        }
    });
    
}

// get an array of values (user saved values from DB) and update fields with it
function F_updateFieldsValues() {
    // for all info retrieved 
    for (var i=0; i < G_aUSERDATA.length; i++) {
        if (G_aUSERDATA[i] != "") {
            // console.log(G_aUSERDATA[i]);
            if (G_aUSERDATA[i].indexOf(";") > -1) {
                var id = G_aUSERDATA[i].split(":")[0] ;
                // id is the same in DB and in form
                var node = document.getElementById('bdd-id-'+id) ;
                if (node) {
                    // only if empty, in case user just connected
                    if (node.value == "") {
                        var sTmp = G_aUSERDATA[i].split(";") ;
                        sTmp.pop() ; // dump one value
                        node.value = sTmp.pop() ;
                    }
                }
            }
        }
    }
    // refresh display with carbon values
    F_updateCarbonVal();
}

// write the form with all the different fields, in different domains
function F_constructFields() {
    //can't load data from DB...
    if (! G_aFIELDS.length) { return ; }
    
        var currentDomain = "";
        var currentCat = "";
        var fInCat = 0;
        var fInDom = 0;
        var fHidden = 0;
        var $content = false;
        var $cat = false;
        for (var i = 0; i < G_aFIELDS.length; i++) {
            // contenu de G_aFIELDS
            // G_aFIELDS[0] - id 
            // G_aFIELDS[1] - label
            // G_aFIELDS[2] - VU carbone
            // G_aFIELDS[3] - unité
            // G_aFIELDS[4] - formule
            // G_aFIELDS[5] - ID domaine
            // G_aFIELDS[6] - ID champ type
            // G_aFIELDS[7] - priorité
            
            // find associated domaine name (from domaine ID)
            var aDom = F_getDomain(G_aFIELDS[i][5], G_aDOMAINES);
            var sDomLabel = aDom.label;
            var sDom_Help = aDom.help;
            
            // find associated sub-domaine name (from sub-domaine ID)
            var aCat = F_getDomain(G_aFIELDS[i][6], G_aCATEGORIES);
            var sCatLabel = aCat.label;
            var sCat_Help = aCat.help;
            
            // Domains
            if (sDomLabel != currentDomain) {
                // If the previous category is too long, make the div limited in height and scrollable
                if (fInDom > 6) {
                    $content[0].style.overflowY = "scroll";
                    $content[0].style.height = "500px";
                }
                // next one
                fInDom = 0 ;
                currentDomain = sDomLabel;
                
            if ($content) { $content.append("<br/>"); } // line after the last field of the domain
                
                var $title = $("<h3>" + currentDomain + "<span class='help-hover'>?</span></h3>");
                
                $title.find('.help-hover').qtip({
                    // Grab some elements to apply the tooltip to
                    content: {
                        title: currentDomain,
                        text: sDom_Help,
                        button: 'Close',
                    },
                    hide: {
                        event: 'unfocus',
                        delay: 100,
                    },
                    style: {
                        classes: 'qtip-tipsy qtip-shadow',
                    }
                })
                
                $("#form-simul-micmac").append($title);
                
                var $content = $("<div class='qa-content' style='margin-top:3px;'></div>");
                $("#form-simul-micmac").append($content);
            }
            
            // sub-category
            if (sCatLabel != currentCat) {
                if ($cat && fHidden == fInCat) {
                    $cat.hide();
                }
                currentCat = sCatLabel;
                fHidden = fInCat = 0;
                if (sCat_Help){
                    $cat = $("<h4 style='margin-top:5px; border-bottom:1px solid grey;'>" + sCatLabel + "<span class='help-hover help-hover-sub'>?</span></h4>");
                    $cat.find('.help-hover-sub').qtip({
                        // Grab some elements to apply the tooltip to
                        style: 'qtip-tipsy',
                        content: {
                            title: currentCat,
                            text: sCat_Help,
                            button: 'Close',
                        },
                        hide: {
                            event: 'unfocus',
                            delay: 100,
                        },
                    })
                } else {
                    $cat = $("<h4 style='margin-top:20px; border-bottom:1px solid grey;'>" + sCatLabel + "</h4>");
                }
                $content.append($cat);
            }
            
            // Create the field. IDs are used for calculations
            var $field = $("<label class='control-label' style='margin-top:3px;'>" + G_aFIELDS[i][1] + "</label>" + 
            "<div class='input-group' style='width: 100%;'>" + 
            "<input id='bdd-id-" + G_aFIELDS[i][0] + "' type='text' class='form-control' placeholder='' value='"+F_defaultValue(G_aFIELDS[i][0], G_aFIELDS[i][2])+"' OnKeyUp='F_updateCarbonVal()'/>" + 
            "<span class='input-group-addon' style='width: 15%;'>" + G_aFIELDS[i][3] + "</span>" + 
            "<span class='input-group-addon' style='width: 20%;' id='keqCa-id-" + G_aFIELDS[i][0] + "' ></span>" + 
            "<span class='input-group-addon' style='width: 20%;' id='keqCo-id-" + G_aFIELDS[i][0] + "' ></span>" + 
            "</div>")
            $content.append($field);
            
            fInCat++;
            fInDom++;
            
            if (G_aFIELDS[i][7] < 2 && !fullDisplay) {
                // if short calculation, display only high priority
                fHidden++;
                $field.hide();
            }
            if (G_aFIELDS[i][0] == 86) {
                $field.find('#bdd-id-86').val(350);
                $field.find('#bdd-id-86').attr('readonly', 'readonly');
            }
        }
        $content.append("<br/>");
        
        $(".qa-accordion").collapse({
            accordion: true,
            open: function() {
                this.slideDown(550);
            },
            close: function() {
                this.slideUp(550);
            }
        });
    F_updateCarbonVal();
}

// when user change a value, update carbon equivalent values
function F_updateCarbonVal() {
    
    // get user value from form
    var valueTab = F_getUserValues() ;
    
    for (var i = 0; i <= valueTab['bdd-id'].length; i++) {
        var node1 = document.getElementById("keqCa-id-" + valueTab['bdd-id'][i]) ;
        var node2 = document.getElementById("keqCo-id-" + valueTab['bdd-id'][i]) ;
        
        if (node1 != null) {
            if (valueTab['resultat'][i]) {
                node1.innerHTML = (valueTab['resultat'][i]).F_formatNum(0) + " kg C" ;
                node2.innerHTML = (valueTab['resultat'][i] * 44 / 12).F_formatNum(0) + " kg CO<SUB>2</SUB>" ;
            }else{
                node1.innerHTML = "" ;
                node2.innerHTML = "" ;
            }
        }
    }
}

//////////////////////////////// START calculate Button ////////////////////////////////
function F_CarbAssessment() {
    // get user value from form
    var valueTab = F_getUserValues() ;
    
    //Display results with graphs and stuff
    F_displayGraphTab(valueTab);
}

// get values in input fields
function F_getUserValues() {
    var valueTab             = new Array();
    valueTab['bdd-id']       = new Array();
    valueTab['valeurSaisie'] = new Array();
    valueTab['coeffCO2']     = new Array();
    valueTab['formules']     = new Array();
    valueTab['resultat']     = new Array();
    valueTab['label']        = new Array();
    valueTab['unite']        = new Array();
    
    var k = 0;
    // list all text input, which ID start by bdd-id, and send ID number and value
    var node_list = document.getElementsByTagName('input');
    for (var i = 0; i < node_list.length; i++) {
        var node = node_list[i];
        if (node.getAttribute('type') == 'text') {
            if (node.id.substring(0, 7) == 'bdd-id-') {
                // console.log(node.id.substring(7));
                valueTab['bdd-id'][k] = node.id.substring(7);
                
                // get user values
                if (node.value) {
                    // var iTmp = node.value ;
                    // var iTmp = parseFloat(node.value.replace(',','.').replace(' ','')) ;
                    var iTmp = node.value.replace(',','.').replace(' ','') ;
                    if (valueTab['bdd-id'][k] == "50") {
                        // percentage organic in meat
                        if (iTmp > 100)    {iTmp = 100} 
                        else if (iTmp < 0) {iTmp = 0}
                        node.value = iTmp ;
                        valueTab['valeurSaisie'][k] = iTmp ;
                    } else if (valueTab['bdd-id'][k] == "69") {
                        // Bottled water
                        var yesRegex = /^(?:Yes|oui)$/i ;
                        var no_Regex = /^(?:No|non)$/i ;
                        // myRegex.test('Chaîne de caractères dans laquelle effectuer la recherche'))
                        if (yesRegex.test(iTmp))        {valueTab['valeurSaisie'][k] = 1}
                        else if (no_Regex.test(iTmp))   {valueTab['valeurSaisie'][k] = 0}
                        else                            {valueTab['valeurSaisie'][k] = 0}
                    } else {
                        //all other values
                        valueTab['valeurSaisie'][k] = iTmp ;
                    }
                    // init some values if empty
                } else if (valueTab['bdd-id'][k] == "13") {
                    // number of people in habitation
                    valueTab['valeurSaisie'][k] = "1";
                } else if (valueTab['bdd-id'][k] == "26") {
                    // number of passenger in car
                    valueTab['valeurSaisie'][k] = "1";
                } else if (valueTab['bdd-id'][k] == "29") {
                    // number of passenger in car
                    valueTab['valeurSaisie'][k] = "1";
                } else if (valueTab['bdd-id'][k] == "69") {
                    // bottled water
                    valueTab['valeurSaisie'][k] = "0";
                } else {
                    valueTab['valeurSaisie'][k] = "0";
                }
                k++;
            }
        }
    }
    //carbon equivalent
    F_calcResult(valueTab);
    
    return valueTab ;
    
}

// Calculate Carbon and CO2 equivalent
function F_calcResult(valueTab) {
    // replace values in RPN formulas (if fields are dependant from several inputs)
    F_replaceValues(valueTab) ;
    // evaluate RPN formulas
    F_calc(valueTab);
}

// place user values in formulas
function F_replaceValues(valueTab) {
    
    for (var i = 0; i < G_aFIELDS.length; i++) {
        valueTab['coeffCO2'].push(G_aFIELDS[i][2]);
        // formulas should be written in RPN:
        // http://interactivepython.org/runestone/static/pythonds/BasicDS/InfixPrefixandPostfixExpressions.html
        // https://www.youtube.com/watch?v=vXPL6UavUeA
        // http://csis.pace.edu/~wolf/CS122/infix-postfix.htm
        valueTab['formules'].push(G_aFIELDS[i][4]);
        valueTab['label'].push(G_aFIELDS[i][1]);
        valueTab['unite'].push(G_aFIELDS[i][3]);
    }
    //initialize results at 0
    for (var i = 0; i <= valueTab['bdd-id'].length; i++) {
        valueTab['resultat'][i] = 0;
    }
    // for each value saved
    for (var i = 0; i <= valueTab['bdd-id'].length; i++) {
        // if associated formula isn't empty
        if (valueTab['formules'][i] != null ) {
            // console.log(valueTab['formules'][i]);
            // get each user values that are in the formula
            for (var j = 0; j <= valueTab['bdd-id'].length; j++) {
                if (valueTab['formules'][i].indexOf("B" + valueTab['bdd-id'][j]) > -1 || valueTab['formules'][i].indexOf("D" + valueTab['bdd-id'][j]) > -1) {
                    if (valueTab['valeurSaisie'][j] != "") {
                        //replace in formula with correct values
                        valueTab['formules'][i] = valueTab['formules'][i].replace("B" + valueTab['bdd-id'][j], valueTab['valeurSaisie'][j]);
                        valueTab['formules'][i] = valueTab['formules'][i].replace("D" + valueTab['bdd-id'][j], valueTab['coeffCO2'][j]);
                    } else {
                        // console.log(valueTab['bdd-id'][j] + " is empty, needed in " + valueTab['formules'][i] + " - " + valueTab['valeurSaisie'][j] + " - ");
                    }
                }
            }
        }
    }
    valueTab['formules'][39] = valueTab['valeurSaisie'][39];
}

// evaluate RPN formulas
function F_calc(valueTab) {
    for (var i = 0; i <= valueTab['bdd-id'].length; i++) {
        if (valueTab['formules'][i] != null ) {
            valueTab['resultat'][i] = F_evalrpn(valueTab['formules'][i].trim().split(" "));
        }
    }
}

// evaluate RPN formula
function F_evalrpn(tks) {
    
    if (!tks.length) {
        return 0;
    }
    var x, y;
    var xTemp;
    
    // get last non empty element
    var tk = tks.pop();
    if (tk == "") {
        tk = tks.pop();
    }
    
    // either it's a number, or it's a formula
    xTemp = parseFloat(tk);
    if (isNaN(xTemp)) {
        x = tk;
        
        y = F_evalrpn(tks);
        x = F_evalrpn(tks);
        if (tk == "+") {
            x += y;
        } else if (tk == "-") {
            x -= y;
        } else if (tk == "*") {
            x *= y;
        } else if (tk == "/") {
            x /= y;
        } else {
        // console.log("error rpn: " + tks + ", " + tk);
        }
    } else {
        x = xTemp;
    }
    return x;
}

// display graphs, tables of results
function F_displayGraphTab(tab) {
    
    var res   = tab['resultat'];
    var label = tab['label'];
    var value = tab['valeurSaisie'];
    var unite = tab['unite'];
    var fact  = tab['coeffCO2'];
    var aIDs  = tab['bdd-id'];
    
    // user total
    var iTotal = 0;
    var aDomSum = [];
    var aFieldSum = [] ;
    var aDrilldown = [] ;
    var aConvert = [] ;
    var iConvert = 0 ;
    
    var totaux = [0, 0, 0, 0, 0, 0]; //OLD
    // G_aFIELDS[0] - id 
    // G_aFIELDS[1] - label
    // G_aFIELDS[2] - VU carbone
    // G_aFIELDS[3] - unité
    // G_aFIELDS[4] - formule
    // G_aFIELDS[5] - ID domaine
    // G_aFIELDS[6] - ID champ type
    // G_aFIELDS[7] - priorité
    
    for (var i = 0; i < res.length; i++) {
        if (!isNaN(res[i]) && !(res[i] == 0) && label[i] != undefined) {
            // user total
            iTotal += res[i];
            // domaine construction
            for (var j = 0; j < G_aFIELDS[0].length; j++){
                if( G_aFIELDS[0][j] == aIDs[i] ){
                    var iDomID = G_aFIELDS[5][j] ;
                }
            }
            var aDom = F_getDomain(G_aFIELDS[i][5], G_aDOMAINES);
            // keep graphs working when a whole domain is empty
            if (aConvert[G_aFIELDS[i][5] - 1] == undefined){
                aConvert[G_aFIELDS[i][5] - 1] = iConvert;
                iConvert++ ;
            }
            if (aDomSum[aConvert[G_aFIELDS[i][5] - 1]] == undefined){
                aDomSum[aConvert[G_aFIELDS[i][5] - 1]] = {
                    name : aDom.label, 
                    y:0, 
                    color : "rgba(" + aDom.color + ", 0.7)", 
                    drilldown: aDom.label
                };
                // drilldown: detailled results
                aDrilldown[G_aFIELDS[i][5] - 1] = {
                    name: aDom.label,
                    id: aDom.label,
                    
                    color: "rgba(" + aDom.color + ", 0.7)", 
                    dataLabels: {
                        formatter: function () {
                            return null; // makes the graph unreadable
                            // return this.y > 5 ? this.point.name : null;
                        },
                    },
                    data: [] 
                };
            }
            aDomSum[aConvert[G_aFIELDS[i][5] - 1]].y += res[i];
            
            var iPos = aDrilldown[G_aFIELDS[i][5] - 1].data.length ;
            // aDrilldown[G_aFIELDS[i][5] - 1].data[iPos][0] = [label[i].replace("&euro;", "€"), res[i]];
            aDrilldown[G_aFIELDS[i][5] - 1].data[iPos] = {
                name: label[i].replace("&euro;", "€"),
                y: res[i],
                // color: "rgba(" + aDom.color + ", 0.7)", 
                color: "rgba(" + aDom.color + ", " + (Math.random()*0.7 +0.3) + ")", 
            } ;
            
            // aDrilldown[G_aFIELDS[i][5] - 1].data[iPos] = [] ;
            // aDrilldown[G_aFIELDS[i][5] - 1].data[iPos][0] = label[i].replace("&euro;", "€");
            // aDrilldown[G_aFIELDS[i][5] - 1].data[iPos][1] = res[i];
            
            // field construction
            aFieldSum.push({name :label[i].replace("&euro;", "€"), y : res[i], color : "rgba(" + aDom.color + ", 1)"});
            
            //quick & dity solution to get results for each fields
            var sFact = "" , seq_C = "" , seqCO = "" ;
            if (Number(fact[i])!= 0){sFact = Number(fact[i]).F_formatNum() } ;
            if (Number(res[i]) != 0){seq_C = Number(res[i]).F_formatNum() + " kg C" ;
                                     seqCO = Number(res[i] * 44 / 12).F_formatNum() + " kg CO<SUB>2</SUB>" } ;
            sTmp += "<tr><td>"  + label[i] + "</td><td>" + Number(value[i]).F_formatNum() + " " + unite[i] + 
                    "</td><td>" + sFact    + "</td><td>" + seq_C + "</td><td>" + seqCO + "</td></tr>";
            ///// Q&D
        }
    }
    // console.log(i + "\n\n" + JSON.stringify(aDomSum) + "\n\n" + JSON.stringify(aDrilldown)) ;
    
    $(function () {
        Highcharts.chart('myChart', {
            chart: {
                type: 'column'},
            title: {
                text: 'kg équivalents carbone (kg Ce)'},
            subtitle: {
                text: 'Cliquez sur les colonnes pour avoir le détails de chaque domaine'},
            tooltip: {
                formatter: function() {
                    return this.point.name.replace(" (", "<br>(") + '<br><b>' + this.y.F_formatNum(0) + 'kg C</b>';
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                column: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                },
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}kgCe'
                    }
                }
            },
            series: [{
                name: 'domaines',
                data: aDomSum,
            }],
            drilldown: {
                series: aDrilldown,
            },
        });
    });
    $(function () {
        Highcharts.chart('myChartcam', {
            chart: {
                type: 'pie'},
            title: {
                text: 'kg équivalents carbone (kg Ce)'},
            subtitle: {
                text: 'Cliquez sur les colonnes pour avoir le détails de chaque domaine'},
            tooltip: {
                formatter: function() {
                    return this.point.name.replace(" (", "<br>(") + ':<br>' + this.y.F_formatNum(0) + 'kg C - <b>' + this.percentage.F_formatNum(2) + '%</b>';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                }
            },
            series: [{
                name: 'domaines',
                data: aDomSum,
                size: '80%',
                dataLabels: {
                    formatter: function () {
                        return this.y > 5 ? this.point.name : null;
                        // return null;
                    },
                    // color: '#ffffff',
                    distance: -10
                }
            }, {
                name: 'champs',
                data: aFieldSum,
                size: '100%',
                innerSize: '80%',
                dataLabels: {
                    formatter: function () {
                        // display only if larger than x%
                        // return this.percentage > 1 ? this.point.name + ': ' + this.y.F_formatNum(0) + 'kg C - ' + this.percentage.F_formatNum(2) + '%' : null;
                        return null; // too much stuff
                    }
                }
            }],
            drilldown: {
                series: aDrilldown,
                dataLabels: {
                    formatter: function () {
                        return null;
                    },
                },
            },
        });
    });
    
    // tables with general results
    $("#tot-carb-serv").html(Math.ceil(iTotal));
    $("#tot-co2-serv").html(Math.ceil(iTotal * 44 / 12));
    $("#carbonPrice").html((Math.ceil((iTotal * 44 / 12)/1000*32)).F_formatNum(0) + "€");
    
    $("#tot-carb").html(Math.ceil(Math.max(0, iTotal - 350)));
    $("#tot-co2").html(Math.ceil(Math.max(0, (iTotal - 350) * 44 / 12)));
    
    // hide and show stuff
    $("#form-simul-micmac").slideUp();
    $("#envoyer").hide();
    $("#conso-title").hide();
    $("#res-table").slideDown();
    
    // get user history from DB
    F_drawUserHistory(tab) ;
    
    $("body").scrollTop(0);
    
    // add text for Building Performances
    F_buildingPerfo(tab);
    
    //quick & dity solution to get results for each fields
    var sTmp = "<tr><th>champ</th><th>Valeur saisie</th><th>Facteur d'émission</th><th>Kg eq C</th><th>Kg eq CO<SUB>2</SUB></th></tr>" + sTmp;
    document.getElementById("tempstorage").innerHTML = sTmp;
    ///// Q&D
}

// draw a graph that contain uer history
function F_drawUserHistory(tab) {
    var aDate        = [] ;
    var aStack       = [] ;
    var aPoints      = [] ;
    var datasetValue = [];
    var sColor       = "";
    
    // get dates from user history
    for (var i=0; i < G_aUSERDATA.length; i++) {
        if (G_aUSERDATA[i] != "") {
            // 13:2016/11/14;3_2016/11/18;3_2017/01/16;4
            aLine = G_aUSERDATA[i].split(":")[1].split("_");
            for (var j=0; j < aLine.length;j++){
                aDate.push(F_CDate(aLine[j].split(";")[0]));
            }
        }
    }
    
    aDate.push(Date.now());     // add today just in case
    // aDate=aDate.F_getUnique().sort(F_compareDay).F_fillMissingDays(); // filter, sort and add missing days
    aDate = aDate.F_getUnique().sort(); // filter & sort
    
    var k = 0 ;
    var iLine = 0 ;
    if (G_aUSERDATA.length) { // user has history data
        for (var i=0; i < G_aUSERDATA.length; i++) {
            if (G_aUSERDATA[i] != "") {
                // field ID
                sID = G_aUSERDATA[i].split(":")[0];
                var aField = F_getDomain(sID, G_aFIELDS);
                var sColor = F_getDomain(aField.domaine, G_aDOMAINES).color ;
                
                // for each date, add a value point (except today)
                for (var j=0; j < aDate.length-1; j++) {
                    var iTmp = Number(F_getValAtDate(G_aUSERDATA[i], aDate[j])) ;
                    aPoints.push([aDate[j], iTmp]);
                    iLine += iTmp ;
                }
                // today's value
                // console.log(sID);
                var iTmp = Number(F_getValToday(sID,tab));
                if (iTmp) {
                    // console.log(iTmp);
                    var iDate = (Math.round(Date.now()/100000))*100000 // stuff cause nothing work without that...
                    var iTmp  = (Math.round(iTmp*100000))/100000       // stuff cause nothing work without that...
                    aPoints.push([iDate, iTmp]);
                    iLine += iTmp ;
                }
                if (iLine){
                    datasetValue[k] = {
                        name  : aField.label ,
                        data  : aPoints ,
                        color : "rgba(" + sColor + ", 0.5)",
                    }
                    k++ ;
                }
                aPoints = [] ;
                iLine = 0 ;
            }
        }
        var oMess = document.getElementById("HistorySubTitle") ;
        oMess.innerHTML = "en kg équivalent Carbone" ;
    } else { // first data
        // @TODO to convert to something like date.setDate(date.getDate() - 1);
        aDate.push(moment(moment(-1).format("YYYY MM DD")));// add yesterday
        
        // only today's result
        for (var i=0; i < tab['bdd-id'].length; i++) {
            var aField = F_getDomain(tab['bdd-id'][i], G_aFIELDS);
            var sColor = F_getDomain(aField.domaine, G_aDOMAINES).color ;
            
            iTmp = tab['resultat'][i] ;
            aPoints.push(iTmp);
            aPoints.push(iTmp);
            
            if (iTmp){
                datasetValue[k] = {
                    name    : aField.label ,
                    color   : "rgba(" + sColor + ", 0.5)",
                    data    : aPoints ,
                    // borderColor          : "rgba(0,0,0, 0.2)",
                    // pointBorderColor     : "rgba(0,0,0, 0.2)",
                    // backgroundColor      : "rgba(" + sColor + ", 0.9)",
                    // pointBackgroundColor : "rgba(" + sColor + ", 1)",
                    // borderWidth          : 1,
                    // pointRadius          : 10,
                    // lineTension          : 0.5,
                }
                k++ ;
            }
            aPoints = [] ;
        }
        // HistorySubTitle
        
        var oMess = document.getElementById("HistorySubTitle") ;
        oMess.innerHTML = "en kg équivalent Carbone.<br>En <A href='#' onclick='F_openModal();'> créant un compte</A> et en modifiant vos donnés en fonction de vos habitudes de consommations, vous verrez ici s'afficher vos changements d'émissions" ;
    }
    
    // console.log("datasetValue\n" + JSON.stringify(datasetValue)+"\n\n\n\n") ; //https://jsonformatter.curiousconcept.com/
    // console.log("aDate\n" + aDate.join("\n")+"\n\n\n\n") ;
    
    $(function () {
        Highcharts.chart('myHistory', {
            chart: {
                type: 'area'},
            title: {
                text: 'kg équivalents carbone (kg Ce)'},
            // subtitle: {
                // text: 'Cliquez sur les colonnes pour avoir le détails de chaques domaines'},
            tooltip: {
                formatter: function() {
                    return this.series.name.replace("&euro;", "€").replace(" (", "<br>(") + ':<br><b>' + this.y.F_formatNum(0) + 'kg Ce </b>';
                }
            },
            xAxis: { // new
                type: 'datetime',
                dateTimeLabelFormats: {
                    // month: '%e. %b',
                    // year: '%e. %b'
                    day: '%e. %b',
                    month: '%b \'%y',
                    year: '%Y'
                },
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                },
            },
            yAxis: { //new 
                title: {
                    text: 'kg Ce'},
                labels: {
                    formatter: function () {return this.value;}
                }
            },
            plotOptions: { // new
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            legend: { 
                enabled: false // if true, too much data, but can be used to select
            },
            series: datasetValue,
        });
    });
}

//////////////////////////////// END BOUTON ENVOYER ////////////////////////////////

// Get domaine help and name from ID
function F_getDomain(sID, aDom) {
    log = typeof log !== 'undefined' ? log : false;
    for (var i = 0; i < aDom.length; i++) {
        if (aDom[i][0] == sID) {
            // if(true){
                // console.log( aDom[i][1]+ aDom[i][2]+ aDom[i][3]) ;
            // }
            return {
                label:   aDom[i][1],
                help:    aDom[i][2],
                color:   aDom[i][3],
                domaine: aDom[i][5],
            };
        }
    }
}

// manage default values
function F_defaultValue(i, Value) {
    // console.log(i + " " + Value) ;
    if (i == 86){return Number(Value).F_formatNum(0)}
    return "" ;
}

// go back to form
function F_reedit() {
    $("#form-simul-micmac").slideDown();
    $("#envoyer").show();
    $("#res-table").slideUp();
    $("#conso-title").show();
    $("body").scrollTop(0);
    // myChart.clear() ;
    // myChartcam.clear() ;
    // myChartHisto.clear() ;
}

// save user data to DB
function F_sauv() {
    // connexion is needed
    var sLogin = F_getCookie("username");
    if (sLogin == "") {
        // this allow to save after connexion
        F_setCookie("save_data", "save_data", 1);
        F_openModal();
        // @TODO wrong place
        document.getElementById('lastChanges').style.display = 'block';
        document.getElementById('lastChanges').innerHTML = "il faut être connecté pour sauvegarder ses données" ;
        return;
    }
    
    // get user values
    
    valueTab = F_getUserValues();
    
    // send results to DB
    var sData = JSON.stringify(Array(valueTab['valeurSaisie'], valueTab['bdd-id'], valueTab['resultat']));
    F_sendResult(sData);
    
    
    F_setCookie("save_data", "save_data", -1); // cookie to yesterday --> deleted
}

// send result to the DB
function F_sendResult(sData) {
    
    var sLogin = F_getCookie("username");
    if (sLogin == "") { return }
    
    $.ajax({
        url: 'php/userData.php',
        type: "POST",
        data: {
            type: "upload",
            logon: sLogin,
            data: sData,
        },
        // dataType: 'json',
        success: function(result, status) {
            //on receive of reply
            console.log("yo"+result);
            
            F_openModal();
            document.getElementById('lastChanges').style.display = 'block';
            document.getElementById('lastChanges').innerHTML = F_formatHistory(result);
            // lastChanges
        },
        error: function(result, status, erreur) {
            window.alert("There was a problem, your data weren't stored. Please Check your internet connection and retry.\n" + 
            "If the issue persist, please contact the administrator (contact@avenirclimatique.org)");
            console.log("error. resultat: " + result + " status: " + status + " error: " + erreur);
        },
        complete: function(result, status) {
            console.log("complete (upload data). status: " + status);
        }
    });
}

function F_CDate(sDate){
    // from "yyyy/mm/dd" to js milliseconds
    var tempdate = sDate.split("/")
    return Date.UTC(Number(tempdate[0]), Number(tempdate[1])-1, Number(tempdate[2]) );
    
}

function F_getValToday(sID, aTab){
    for (var i=0;i<aTab['bdd-id'].length;i++){
        // console.log("id " +sID + " - " + aTab['bdd-id'][i]);
        if(aTab['bdd-id'][i] == sID){
            // console.log("res " +sID + " - " + aTab['resultat'][i]);
            return aTab['resultat'][i] ;
        }
    }
    return 0 ;
}

function F_getValAtDate(sLine, oDate) {
    // 13:2016/11/14;3;12_2016/11/18;3;12_2017/01/16;4;16
    var sRet = "0" ;
    var aLine = sLine.split(":")[1].split("_");
    for (var i=0, l=aLine.length; i<l;i++){
        if(F_compareDay(F_CDate(aLine[i].split(";")[0]), oDate) == 0){return aLine[i].split(";")[2]}
        if(F_compareDay(F_CDate(aLine[i].split(";")[0]), oDate) <  0){sRet = aLine[i].split(";")[2]}
        if(F_compareDay(F_CDate(aLine[i].split(";")[0]), oDate) >  0){return sRet}
        // if(F_compareDay(moment(aLine[i].split(";")[0]), oDate) <  0){sRet = aLine[i].split(";")[2]}
        // if(F_compareDay(moment(aLine[i].split(";")[0]), oDate) >  0){return null}
    }
    return sRet ;
}

function F_resetField() {

    G_aFIELDS = [] ;
    $.ajax({
        url: 'php/api.php',
        type: "POST",
        data: {
            tableID: 'champ'
        },
        dataType: 'json',
        success: function(res, status) {
            //on receive of reply
            // console.log("success: " + res.length + " -  " + res + " ---- " + status);
            G_aFIELDS = res ;
        },
        error: function(res, status, erreur) {
            console.log("error. resultat: " + res + " status: " + status + " error: " + erreur);
        },
        complete: function(res, status, erreur) {
            console.log("complete (field reset). status: " + status);
        }
    });
}

// format message to display after user saved data to DB
function F_formatHistory(sMess){
    
    if (sMess.trim() == "no update needed") { return "<H1>Aucun changements détectés</H1>"} // can be used to manage languages
    
    // F_devAlert("yo: " + sMess.trim()) ;
    
    aRes = sMess.trim().split("\n") ;
    
    sMess = "" ;
    for (var i = 0; i < aRes.length; i++) {
        // F_devAlert(aRes[i].indexOf("_change_") + "-" + aRes[i].indexOf("_chanfeefge_")) ;
        if (aRes[i].indexOf("_change_") == 0) {
            //get values inside return variable
            sFieldID = aRes[i].split("_domaine_")[1] ;
            sOld = aRes[i].split("_was_")[1] ;
            sNew = aRes[i].split("_new_")[1] ;
            // write message
            sMess += "mise à jour du champ \"" +F_getField(sFieldID)+"\" par \"" + sNew + "\" (anciennement \"" +sOld+"\")<br>";
        } else if (aRes[i].indexOf("_create_") == 0) {
            sFieldID = aRes[i].split("_domaine_")[1] ;
            sNew = aRes[i].split("_new_")[1] ;
            sMess += "1ère valeure du champ \"" +F_getField(sFieldID)+"\" avec \"" + sNew + "\"<br>";
        } else if (aRes[i].indexOf("_create_column_") == 0) {
            // do nothing
        }
    }
    // if (F_isDev()){sMess = sMess + "<br>" + G_aFIELDS}
    
    return "<H1>Derniers Changements:</H1>" + sMess ;
    
}

function F_getField(sID) {
    // contenu de G_aFIELDS:
    // 0 - id 
    // 1 - label
    // 2 - VU carbone
    // 3 - unité
    // 4 - formule
    // 5 - ID domaine
    // 6 - ID champ type
    // 7 - priorité
    for (var i = 0; i < G_aFIELDS.length; i++) {
        if (G_aFIELDS[i][0] == sID) {
            return G_aFIELDS[i][1] ;
        }
    }
}

// formating of all numbers for display purposes
Number.prototype.F_formatNum = function(c, d, t){
    // c = digits after decimal (default 4, max 20)
    // d = decimal separator (default ",")
    // t = space between group of 3 digits (default " ")
    var n = this,                                                   // number to format
    c = isNaN(c = Math.abs(c)) ? 4 : c > 20 ? 20 : c,               // digits after decimal (default 2, max 20)
    d = d == undefined ? "," : d,                                   // decimal separator
    t = t == undefined ? " " : t,                                   // space between group of 3 digits
    s = n < 0 ? "-" : "",                                           // sign
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),  // absolute integer part
    j = (j = i.length) > 3 ? j % 3 : 0;                             // 1st part to place before group of 3 digits
    var sTmp = "" ;
    sTmp += s + (j ? i.substr(0, j) + t : "") ;                     // sign and 1st part of digit group
    sTmp += i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) ;       // rest of integer part with digit grouping
    sTmp += (c ? d + (Math.abs(n - i).toFixed(c).slice(2)) : "");   // decimal part
    if(c){sTmp = sTmp.replace(/0*$/, "") ;}                         // remove trailing 0s
    sTmp = sTmp.substr(-1) == d ? sTmp.slice(0,-1) : sTmp ;         // remove trailing decimal sep
    return sTmp ;
}

function F_calcElec(){
    var amount = document.getElementById('elecIn').value;
    var type = document.getElementById('elecPeriod').value;
    var coeff = document.getElementById('elecCoef').value;
    var iRes = 0 ;
    if (type == "month") {iRes = amount * 12 / coeff}
    else if (type == "year") {iRes = amount / coeff}
    
    else {console.log("Unkonwn type: " +type); return}
    
    document.getElementById('elecRes').innerHTML = "<br><br>Equivaut à " + iRes.F_formatNum(2) + " kWh";
}

function F_calcGaz(){
    var amount = document.getElementById('GazIn').value;
    var type = document.getElementById('GazPeriod').value;
    var iRes = 0 ;
    if (type == "month") {iRes = amount * 12 / 0.07}
    else if (type == "year") {iRes = amount / 0.07}
    else {console.log("Unkonwn type: " +type); return}
    
    document.getElementById('GazRes').innerHTML = "<br><br>Equivaut à " + iRes.F_formatNum(2) + " kWh";
    
}

function F_buildingPerfo(tab){
    var ID    = tab['bdd-id'];
    var res   = tab['resultat'];
    var value = tab['valeurSaisie'];
    var people___val = 0 ;
    var surface__val = 0 ;
    var electric_val = 0 ;
    var green____val = 0 ;
    var gas______val = 0 ;
    var fuelOil__val = 0 ;
    var people___res = 0 ;
    var surface__res = 0 ;
    var electric_res = 0 ;
    var green____res = 0 ;
    var gas______res = 0 ;
    var fuelOil__res = 0 ;
    var sTmp1 = "" ;
    var cat_climate  = "" ;
    
    for (var i= 0; i < res.length; i++){
             if(ID[i] == "13"){people___val = value[i]; people___res = res[i]} // nb people in house
        else if(ID[i] == "14"){surface__val = value[i]; surface__res = res[i]} // house surface
        else if(ID[i] == "16"){electric_val = value[i]; electric_res = res[i]} // Fournisseur Classique
        else if(ID[i] == "17"){green____val = value[i]; green____res = res[i]} // Fournisseur Vert
        else if(ID[i] == "19"){gas______val = value[i]; gas______res = res[i]} // Gas
        else if(ID[i] == "20"){fuelOil__val = value[i]; fuelOil__res = res[i]} // Fuel Oil
    }
    
    var power = electric_val *2.58+ green____val *1.05+gas______val*0.9028+ fuelOil__val *11.6 ;
    
    // console.log(" - " + surface__val + " - "+ power + " - ");
    if (surface__val==0){
        sTmp1 = "<br><h3>Merci de rentrer la surface de votre logement pour obtenir un résultat</h3>" ;
    }
    if (power==0){
        sTmp1 += "<br><h3>Merci de rentrer vos consommations énergétiques pour obtenir un résultat</h3>" ;
    }
    if (sTmp1 != ""){
        document.getElementById("perfoEnergy").innerHTML = sTmp1 ;
        document.getElementById("perfoClimat").innerHTML = sTmp1 ;
        return ;
    }
    
    var power = power / surface__val ;
    
    var X1 = 5;
    var cat_energy = "" ;
    
    if(power<15){
        cat_energy = "A+" ;
        var X2 = 57;  var Y1 = 35;  var Y2 = 71;
    } else if(power<51){
        cat_energy = "A" ;
        var X2 = 72;  var Y1 = 70;  var Y2 = 107;
    } else if(power<91){
        cat_energy = "B" ;
        var X2 = 100; var Y1 = 105; var Y2 = 142;
    } else if(power<151){
        cat_energy = "C" ;
        var X2 = 125; var Y1 = 140; var Y2 = 177;
    } else if(power<231){
        cat_energy = "D" ;
        var X2 = 153; var Y1 = 174; var Y2 = 212;
    } else if(power<331){
        cat_energy = "E" ;
        var X2 = 178; var Y1 = 209; var Y2 = 246;
    } else if(power<451){
        cat_energy = "F" ;
        var X2 = 207; var Y1 = 244; var Y2 = 280;
    } else {
        cat_energy = "G" ;
        var X2 = 231; var Y1 = 279; var Y2 = 315;
    }
    var sText = "<br><h3>" +
    "Avec une Puissance consomée de <b>" + power.F_formatNum(1) + "</b> kWh/m²/an, votre bâtiment est classé <b>" + cat_energy +"</b><br></h3>";
    document.getElementById("perfoEnergy").innerHTML = sText
    
    // draw a square on the picture
    var canvas = document.getElementById("EperfoCanvas");
    var ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.lineWidth = 3;
    ctx.moveTo(X1, Y1);
    ctx.lineTo(X2, Y1);
    ctx.lineTo(X2, Y2);
    ctx.lineTo(X1, Y2);
    ctx.lineTo(X1, Y1);
    ctx.strokeStyle = "sienna";
    ctx.stroke();
    ctx.closePath();
    
    // add all k eq C, multiply by number of people (it was calculated for 1) and divide by surface
    var GES = (electric_res+green____res+gas______res+fuelOil__res) * people___val / surface__val ;
    
    if(GES<=5){
        cat_climate = "A" ;
        var X2 = 115; var Y1 = 45;  var Y2 = 102; // coordinates of related square
    } else if(GES<11){
        cat_climate = "B" ;
        var X2 = 156; var Y1 = 100; var Y2 = 159;
    } else if(GES<21){
        cat_climate = "C" ;
        var X2 = 198; var Y1 = 156; var Y2 = 215;
    } else if(GES<36){
        cat_climate = "D" ;
        var X2 = 242; var Y1 = 212; var Y2 = 270;
    } else if(GES<56){
        cat_climate = "E" ;
        var X2 = 283; var Y1 = 268; var Y2 = 325;
    } else if(GES<80){
        cat_climate = "F" ;
        var X2 = 324; var Y1 = 323; var Y2 = 381;
    } else {
        cat_climate = "G" ;
        var X2 = 367; var Y1 = 379; var Y2 = 437;
    }
    // draw a square on the picture
    var X1 = 8; // always the same coordinate
    var canvas = document.getElementById("CperfoCanvas");
    var ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.lineWidth = 3;
    ctx.moveTo(X1, Y1);
    ctx.lineTo(X2, Y1);
    ctx.lineTo(X2, Y2);
    ctx.lineTo(X1, Y2);
    ctx.lineTo(X1, Y1);
    ctx.strokeStyle = "sienna";
    ctx.stroke();
    ctx.closePath();
    
    var sText = "<br><h3>" +
    "Avec des emissions de GES de <b>" + GES.F_formatNum(1) + "</b> kg eqC/m²/an, ou <b>" + (GES*44/12).F_formatNum(1) + "</b> kg eqCO<SUB>2</SUB>/m²/an, votre bâtiment est classé <b>" + cat_climate + "</b><br></h3>";
    document.getElementById("perfoClimat").innerHTML = sText
    
    
}

function F_testPic(){
    return ;
    
    var canvas = document.getElementById("EperfoCanvas");
    var ctx = canvas.getContext("2d");
    var img = new Image(); 
    img.src = './img/perf_energetique_2.png';
    
    img.onload = function() {
        // var W = img.width;
        // var H = img.height;
        // canvas.width = W;
        // canvas.height = H;
        // ctx.drawImage(img, 0, 0); //draw image
        // ctx.drawImage(this,0,0, 400, 340);
        ctx.beginPath(); // A+
        ctx.lineWidth = 3;
        ctx.moveTo(5, 35);
        ctx.lineTo(57,35);
        ctx.lineTo(57,71);
        ctx.lineTo(5, 71);
        ctx.lineTo(5, 35);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // A
        ctx.lineWidth = 3;
        ctx.moveTo(5, 71);
        ctx.lineTo(72,71);
        ctx.lineTo(72,106);
        ctx.lineTo(5, 106);
        ctx.lineTo(5, 71);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // B
        ctx.lineWidth = 3;
        ctx.moveTo(5, 106);
        ctx.lineTo(98,106);
        ctx.lineTo(98,141);
        ctx.lineTo(5, 141);
        ctx.lineTo(5, 106);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // C
        ctx.lineWidth = 3;
        ctx.moveTo(5,  141);
        ctx.lineTo(125,141);
        ctx.lineTo(125,176);
        ctx.lineTo(5,  176);
        ctx.lineTo(5,  141);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // D
        ctx.lineWidth = 3;
        ctx.moveTo(5,  176);
        ctx.lineTo(153,176);
        ctx.lineTo(153,211);
        ctx.lineTo(5,  211);
        ctx.lineTo(5,  176);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // E
        ctx.lineWidth = 3;
        ctx.moveTo(5,  211);
        ctx.lineTo(178,211);
        ctx.lineTo(178,245);
        ctx.lineTo(5,  245);
        ctx.lineTo(5,  211);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // F
        ctx.lineWidth = 3;
        ctx.moveTo(5,  245);
        ctx.lineTo(207,245);
        ctx.lineTo(207,279);
        ctx.lineTo(5,  279);
        ctx.lineTo(5,  245);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
        
        ctx.beginPath(); // G
        ctx.lineWidth = 3;
        ctx.moveTo(5,  279);
        ctx.lineTo(231,279);
        ctx.lineTo(231,314);
        ctx.lineTo(5,  314);
        ctx.lineTo(5,  279);
        ctx.strokeStyle = "sienna";
        ctx.stroke();
        ctx.closePath();
    };
    
    
}

Array.prototype.F_getUnique = function(){
    var u = {}, a = [];
    for(var i = 0, l = this.length; i < l; ++i){
        // console.log("r " + this[i]);
        if(u.hasOwnProperty(this[i])) {
            continue;
        }
        a.push(this[i]);
        u[this[i]] = 1;
    }
    return a;
}

Array.prototype.F_fillMissingDays = function(){
    var a = [], lst = 0;
    var i = 0;
    for(var i = 0, l = this.length; i < l; ++i){
        lst = this[i] ;
        // if(i+1<l){ console.log("next: " + this[i+1].format('YYYY MMM DD')) ;}
        while (i+1<l && F_compareDay(lst, this[i+1]) !=0) {
            // console.log("current: " + lst.format('YYYY MMM DD')) ;
            a.push(moment(lst.format())) ; // avoid to push object reference
            lst = lst.add(1, 'd') ;
        }
    }
    a.push(moment(lst.format())) ;
    return a;
}

function F_compareDay(a,b) {
    return a-b ;
    
    if(a.year() < b.year()) return -1;
    if(a.year() > b.year()) return 1;
    if(a.dayOfYear() < b.dayOfYear()) return -1;
    if(a.dayOfYear() > b.dayOfYear()) return 1;
    return 0;
}

