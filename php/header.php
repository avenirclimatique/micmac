
<!-- header start -->
<header>
    <div id="sticker" class="header-area">
        <div class="container">
            <div class="row">
                <!-- logo start -->
                <div class="col-md-12">
                    <div class="logo">
                        <a style="float:left;" href="index.php"><img src="images/micmac.png" style="width: 45%;height: 45%;margin-top: -25px;" alt="MicMac"></a>
                          <h3 style="float: right; padding: 20px 0px; ">Mon Impact Carbone, Mes Actions Concrètes</h3>
                    </div>

                </div>
                <!-- logo end -->
                <!-- mainmenu start -->
                <div class="col-md-10">
                    <div class="mainmenu">
                        <nav>
                            <ul id="nav">
                                <li><a href="index.php">Accueil</a></li>
                                <li><a href="simulationCarbone.php">Faire le test</a></li>
                                <li><a href="sources.php">Sources</a></li>
                                <li><a href="faq.php">FAQ</a></li>
                                <li><a href="contact-us.php">Contact</a></li>
                                <li><a href="#" onclick="F_openModal();" id=connectLink>Accès connecté</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- mainmenu end -->
            </div>
        </div>
    </div>
    <!-- mobile-menu-area start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <div class="logo">
                            <a href="index.php"><img src="images/micmac.png" style="width: 25%;height: 25%;margin-top: -17px;" alt="MicMac"></a>
                        </div>
                        <nav id="dropdown">
                            <ul>
                                <li><a href="simulationCarbone.php">Faire le test</a></li>
                                <li><a href="sources.php">Sources des données</a></li>
                                <li><a href="faq.php">FAQ</a></li>
                                <li><a href="contact-us.php">Contact</a></li>
                                <li><a href="#" onclick="F_openModal();" id=connectLinkmobile>Accès connecté</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile-menu-area end -->
</header>
<!-- header end -->

<!-- Div to display messages when needed -->
<div id="floatMessage" class=floatMessage></div>

<!-- modal form for signin signup  start -->
<div id="modalForm" class=modal>
    <form class="modal-content animate">
        <div class="imgcontainer">
            <span onclick="F_closeModal();" class="close" title="Close Modal">&times;</span><!-- close -->
            <img src="images/micmac.png" alt="micmac" class="avatar"><!-- picture -->
        </div>
        <div class="container">
            <div id=notLogged>
                <!-- Login & signup -->
                <label><b>Nom d'utilisateur</b></label><br>
                <input type="text" placeholder="Entrer votre nom d'utilisateur" id="uname" class=loginInput><br>
                <span id=unameErr class=validErr></span>
                <label><b>Mot de passe</b></label><br>
                <input type="password" placeholder="Entrer le mot de passse" id="psw1" class=loginInput><br>
                <span id=psw1Err class=validErr></span>
                
                <!-- signup only -->
                <div id="signUp1">
                    <label><b>Répéter le mot de passse</b></label><br>
                    <input type="password" placeholder="Répéter le mot de passse" id="psw2" class=loginInput ><br>
                    <span id=psw2Err class=validErr></span>
                    <label><b>e-mail</b></label><br>
                    <input type="user_email" placeholder="Enter votre e-mail" id="mail" class=loginInput pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="merci d'entrer une adresse email valide">
                    <span id=mailErr class=validErr></span>
                </div>
                <!-- Login only -->
                <div id="login1">
                    <button type="submit" class="loginBtn" id=loginBtn onclick="F_connect();" name=connect>Se connecter</button>
                    <!-- not implemented yet, today always remember -->
                    <!--<span><input type="checkbox" checked="checked" id=rememberMe> Se souvenir de moi</span> -->
                    <br>
                    <button type="button"  class="changeBtn" onclick="F_gotoSignUP();" id=createAccount1 name=signup>Pas encore de compte? le créer!</button>
                </div>
                <!-- signup only -->
                <div id="signUp2">
                    <button type="submit"  class="loginBtn" onclick="F_SignUP();" id=createAccount2 name=signup2>Créer le compte</button><br>
                    <button type="button"  class="changeBtn" onclick="F_gotoSignIN();" id=createAccount3 name=return>Retour au Login</button>
                </div>
                <!-- Login & signup -->
                <br>
                <button type=button onclick="F_closeModal();" class=cancelbtn name=return2>Cancel</button>
                <br>
                <span class="psw"><a href="#">Forgot password?</a></span>
            </div>
            <div id=Logged>
                <label id=userName><b>Bonjour </b></label><br>
                
                <label id=lastChanges><br></label>
                <button type="button" onclick="F_closeModal();" class="changeBtn">Fermer</button>
                <br>
                <button type="button" onclick="F_logout();" class="cancelbtn">Se déconnecter</button>
                
            </div>
        </div>
    </form>
</div>
<!-- modal form for signin signup end -->
