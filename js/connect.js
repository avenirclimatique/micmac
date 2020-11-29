// var api = "" ;

//on load function
$(document).ready(function() {
    // get user if defined
    var sLogin = F_getCookie("username");
    F_setUserSession(sLogin);
    if ( !HTMLFormElement.reportValidity ) {
        HTMLFormElement.reportValidity = function() {
            var submitButtons = this.querySelectorAll( "button, input[type=button]" );
            for ( var i = 0; i < submitButtons.length; i++ ) {
                // Filter out <button type="button">, as querySelectorAll can't
                // handle :not filtering
                if ( submitButtons[ i ].type === "submit" ) {
                    submitButtons[ i ].click();
                    return;
                }
            }
        }
    }
})
// display of the connect modal form
var modal = document.getElementById('modalForm');// Get the modal
var oMess = document.getElementById("floatMessage") ;
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    // console.log("yui 1") ;
    if (event.target == modal) {
        // console.log("yui in") ;
        modal.style.display = "none";
    }
    // console.log("yui fin") ;
}

///////////////////////////// LOGIN /////////////////////////////
// run connexion script
function F_connect() {
    var oName = document.getElementById("uname");
    var oPswd = document.getElementById("psw1") ;
    oName.required = true;
    oPswd.required = true;
    var sName = oName.value ;
    var sPswd = oPswd.value ;
    
    F_resetErrMess();
    
    // check data
    if (sName == "") {
        F_setErrorValidity("uname", "Merci d'entrer un nom d'utilisateur") ;
        return ;
    } else if (sName.length < 6){
        F_setErrorValidity("uname", "Le nom d'utilisateur doit faire au moins 6 charactères") ;
        return ;
    } else {
        oName.setCustomValidity("");
    }
    if (sPswd == "") {
        F_setErrorValidity("psw1", "Merci d'entrer un mot de passe") ;
        return ;
    } else if (sPswd.length < 8){
        F_setErrorValidity("psw1", "Le mot de passe doit faire au moins 8 charactères") ;
        return ;
    } else {
        oPswd.setCustomValidity("");
    }
    
    oName.setCustomValidity("Validation en cours");
    oName.focus ;
    
    // send request
    $.ajax({
        url: 'php/login.php',
        type: "POST",
        data: {
            username: sName,
            password: sPswd,
        },
        success: function(data, status) { //on receive of reply
            // console.log("success: " + data + " ---- " + status) ;
            if(data.trim() == "User do not exist"){
                console.log("User do not exist");
                F_setErrorValidity("uname", "Nom d'utilisateur inexistant") ;
                return ;
            } else if(data.trim() == "KO..."){
                console.log("incorrect password");
                F_setErrorValidity("psw1", "Mot de passe incorrect, avez-vous oubliez votre mot de passe?") ;
                return ;
            } else if(data.trim() == "ok!"){
                console.log("connected");
                F_floatMess("Bienvenue " + sName);
                // close modal form
                F_closeModal() ;
                
                // store cookie, and set modal form (if openned later) to user data
                F_setUserSession(sName) ;
                
                // get stored values
                F_getUserInfoFromDB() ;
                
                // if user connected after clicking on "save data", will save data :)
                if (F_getCookie("save_data") == "save_data") { F_sauv() ; }
                
                //////////////////////////////////////////OLD STUFF//////////////////////////////////////////
                
                // don't know what that is
                if (document.location.hash != "") {
                    F_insertNewRow(sName);
                    return;
                }
                // don't know what that is
                F_fillHist(sName);
            } else {
                console.log("unimplemented answer");
            }
        },
        error: function(data, status, erreur) {
            console.log("error. resultat: " + data + " status: " + status + " error: " + erreur);
        },
        complete: function(data, status, erreur) {
            console.log("complete (log). status: " + status);
        }
    });
}
// run user creation in PHP
function F_SignUP (){
    // get data
    var oName = document.getElementById("uname");
    var oPswd = document.getElementById("psw1" ) ;
    var oPsw2 = document.getElementById("psw2" ) ;
    var oMail = document.getElementById("mail" ) ;
    oName.required = true;
    oPswd.required = true;
    oPsw2.required = true;
    oMail.required = true;
    // check data
    
    F_resetErrMess();
    
    if(oName.value == "" || oPswd.value == "" || oPsw2.value == "" || oMail.value == "" ){
        // window.alert("1");
        if (oName.value == "") {F_setErrorValidity("uname", "Merci d'entrer un nom d'utilisateur") ;} else {oName.setCustomValidity("");}
        if (oPswd.value == "") {F_setErrorValidity("psw1" , "Merci d'entrer un mot de passe")      ;} else {oPswd.setCustomValidity("");}
        if (oPsw2.value == "") {F_setErrorValidity("psw2" , "Merci de répéter votre mot de passe") ;} else {oPsw2.setCustomValidity("");}
        if (oMail.value == "") {F_setErrorValidity("mail" , "Merci d'entrer une adresse mail")     ;} else {oMail.setCustomValidity("");}
        return ;
    }
    oName.setCustomValidity("");
    oPswd.setCustomValidity("");
    oPsw2.setCustomValidity("");
    oMail.setCustomValidity("");
    
    if(oPswd.value != oPsw2.value){
        F_setErrorValidity("psw2" , "Les mots de passes ne correspondent pas") ;
        return ;
    } else {
        oPsw2.setCustomValidity("") ; 
    }
    
    oName.setCustomValidity("Validation en cours");
    oName.focus ;
    
    // create user
    $.ajax({
        url: 'php/signup.php',
        type: "POST",
        data: {
            username: oName.value,
            password: oPswd.value,
            usermail: oMail.value,
        },
        success: function(data, status) { //on receive of reply
            console.log("success: " + data + " --> " + status) ;
            // console.log("typeof : " + typeof data + " - " + data.trim().length + " - " + "Username already taken".trim().length) ;
            if(data.trim() == "Username already taken"){
                console.log("Username already taken");
                F_setErrorValidity("uname", "Nom d'utilisateur déjà utilisé, avez-vous oubliez votre mot de passe?") ;
                return ;
            } else if(data.trim() == "e-mail already used"){
                console.log("e-mail already used");
                F_setErrorValidity("mail", "e-mail déjà utilisé, avez-vous oubliez votre mot de passe?") ;
                return ;
            } else if(data.trim() == "success"){
                console.log("success");
                window.alert("Félicitation! Votre compte à bien été créé") ;
                
                F_floatMess("<H2>Félicitation! Votre compte à bien été créé<br>Bienvenue " + oName.value + "</h2>");
                F_closeModal(); // close modal form
                F_setUserSession(oName.value) ;
                
                // if user connected after clicking on "save data", will save data :)
                if (F_getCookie("save_data") == "save_data") { F_sauv() ; }
                
            }
        },
        error: function(data, status, erreur) {
            console.log("error. resultat: " + data + " status: " + status + " error: " + erreur);
        },
        complete: function(data, status, erreur) {
            console.log("complete (signup). status: " + status);
        }
    });
}
// logout
function F_logout() {
    console.log("disconnect");
    document.getElementById("notLogged").style.display = "block" ;
    document.getElementById("Logged").style.display = "none" ;
    F_setCookie("username", "", 0);
    document.getElementById('connectLink').innerHTML = "Accès Connecté" ;
    document.getElementById('connectLinkmobile').innerHTML = "Accès Connecté" ;
}

// get user info from the database to load in fields
function F_getUserInfoFromDB() {
    // check if username is available
    var sLogin = F_getCookie("username") ;
    if (sLogin == "") { return }
    // refresh storage
    F_setUserSession(sLogin) ;
    
    $.ajax({
        url: 'php/userData.php',
        type: "POST",
        data: {
            type: "download",
            logon: sLogin,
        },
        dataType: 'json',
        success: function(data, status) { //on receive of reply
            // console.log("success: " + data + " ---- " + status) ;
            // will work only from the simulation page
            try {
                G_aUSERDATA = data ;
                F_updateFieldsValues();}
            catch(err) {
                console.log(err.message);
            }
        },
        error: function(data, status, erreur) {
            window.alert("There was a problem, your data weren't retrieved. Please Check your internet connection and retry.\n" + 
            "If the issue persist, please contact the administrator (contact@avenirclimatique.org)");
            console.log("error. resultat: " + data + " status: " + status + " error: " + erreur);
        },
        complete: function(data, status, erreur) {
            // console.log("complete (user dl). data  : " + data);
            // console.log("complete (user dl). status: " + status);
        }
    }) ;
}
//change modal form to Sign Up
function F_gotoSignUP (){
    // modify the connect modal form to a signUP modal form
    // remove warning for now
    document.getElementById("uname").required = false;
    document.getElementById("psw1").required = false;
    // display correct divs
    document.getElementById("login1").style.display = "none" ;
    document.getElementById("signUp1").style.display = "block" ;
    document.getElementById("signUp2").style.display = "block" ;
}
// change modal form to Sign In
function F_gotoSignIN (){
    // modify the connect modal form to a signIN modal form (original state)
    // restore required
    document.getElementById("uname").required = true;
    document.getElementById("psw1").required = true;
    // display correct divs
    document.getElementById("login1").style.display = "block" ;
    document.getElementById("signUp1").style.display = "none" ;
    document.getElementById("signUp2").style.display = "none" ;
    
}
// user is conneccted, save it
function F_setUserSession(sName){
    if (sName == "") {return ;}
    // set username in top right access link
    document.getElementById('connectLink').innerHTML = sName ;
    document.getElementById('connectLinkmobile').innerHTML = sName ;
    
    // store user connexion
    // define end date (in 10 days)
    var iDays = 10 ;
    F_setCookie("username", sName, iDays);
    
    // change modal form
    document.getElementById("notLogged").style.display = "none" ;
    document.getElementById("Logged").style.display = "block" ;
    document.getElementById('userName').innerHTML = "Bonjour " + sName ;
}

///////////////////////////// DISPLAY /////////////////////////////
// set error validity for a field
function F_setErrorValidity(sID, sMess){
    
    var oElem = document.getElementById(sID);
    oElem.setCustomValidity(sMess) ;
    oElem.focus ;
    oElem.validationMessage;
    oElem.click();
    console.log("coucou"+sID+" "+sMess);
    try {
        // chrome & opera
        oElem.reportValidity()
    }
    catch(err) {
        // rest of the browsers
        console.log("F_setErrorValidity: "+sID+" "+err.message);
        var oElem = document.getElementById(sID+"Err");
        oElem.innerHTML = sMess ;
        oElem.style.display = "block" ;
    }
}
// remove custom validations
function F_resetErrMess(){
    document.getElementById("unameErr").style.display = "none";
    document.getElementById("psw1Err").style.display = "none";
    document.getElementById("psw2Err").style.display = "none";
    document.getElementById("mailErr").style.display = "none";
}
// display the connection modal form
function F_openModal(){
    modal.style.display = "flex";
}
function F_closeModal(){
    modal.style.display = "none";
}
// display floating message on top right
function F_floatMess(sMess){
    oMess.innerHTML="<span onclick='F_closeFloat();' class=close title='Close Modal'>&times;</span><br>"+sMess;
    oMess.style.display="block";
}
function F_closeFloat(){
    oMess.style.display="none";
}

///////////////////////////// SYSTEM /////////////////////////////
// get a cookie value
function F_getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}
// set a cookie to a value
function F_setCookie(sName, sValue, iDays) {
    var sExpires = "";
    if (iDays) {
        var date = new Date();
        date.setTime(date.getTime()+(iDays*24*60*60*1000));
        sExpires = ";expires="+date.toGMTString();
    }
    document.cookie = sName + "=" + sValue + sExpires + ";path=/";
}

///////////////////////////// DEVS /////////////////////////////
// list of dev users
function F_isDev(){
    var sLogin = F_getCookie("username") ;
    if (sLogin == "Raphael" ) {return true ;}
    return false ;
}
// display alert only if user is dev
function F_devAlert(s){
    if (F_isDev()) {window.alert("dev only: " + s) ;}
}

///////////////////////////// BKP /////////////////////////////
function F_insertNewRow(login) {
    // $.ajax(api + "/sauv/" + document.location.hash.replace("#", "").replace("&", "/") + "/" + login)
        // .done(function(res) {
            // if (typeof res.error != "undefined") {
                // $("body").click();
                // F_insertNewRow(login);
                // return;
            // }
            // F_fillHist(login);
        // });
}
function F_fillHist(login) {

    return ; // crashes so far... and i'm not sure what it should do
    
    // $.ajax(api + "/hist/" + login)
        // .done(function(res) {
            // if (typeof res.error != "undefined") {
                // $("body").click();
                // F_fillHist(login);
                // return;
            // }
            // if (res.length) {
                // var $table = $("#res-table");
                // for (var i = 0; i < res.length; i++) {
                    // $table.append(
                        // "<tr>" +
                        // "<td>" + res[i].date_push.substr(0, 10) + "</td>" +
                        // "<td>" + Math.ceil(res[i].total_general) + "</td>" +
                        // "<td>" + Math.ceil(res[i].total_general * 44 / 12) + "</td>" +
                        // "<td>" + Math.ceil(res[i].total_general_SP) + "</td>" +
                        // "<td>" + Math.ceil(res[i].total_general_SP * 44 / 12) + "</td>" +
                        // "</tr>"
                    // );
                // }
            // }
        // });
}
