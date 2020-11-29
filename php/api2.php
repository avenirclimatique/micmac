<?php
    //--------------------------------------------------------------------------
    // Database info
    //--------------------------------------------------------------------------
    $host   = "avenirclsite.mysql.db";
    $user   = "avenirclsite";
    $pass   = "dztDYYmqppYC";
    $dbName = "avenirclsite";
    
    $function = $_POST['selector'] ;
    
    if($function == 'loadPage'){
        // get all info needed to load the page
        echo F_loadPage() ;
    } elseif ($function == 'logIn'){
        // check user credentials
        echo F_logIn() ;
    } elseif ($function == 'signUp'){
        // Create new user
        echo F_signUp() ;
    }
    
    return ;
    
    function F_loadPage(){
        //--------------------------------------------------------------------------
        // 1) Connect to mysql database
        //--------------------------------------------------------------------------
    global $host, $user, $pass, $dbName ;
    
        $link = mysqli_connect($host, $user, $pass, $dbName);
        if (!$link) {
        die(json_encode('Erreur de connexion :\n' . mysqli_connect_error()));
        }
        //--------------------------------------------------------------------------
        // 2) Query database for data in all tables
        //--------------------------------------------------------------------------
    $tables = array("champ", "champ_type", "domaine") ; // must keep this order
        for ($i = 0; $i <= 2; $i++){
            $tableName = $tables[$i] ;
            $query = "SELECT * FROM ".$tableName ;
            $result = mysqli_query($link, $query); 
            if (!$result) {
               return 'Impossible d\'exécuter la requête : ' . mysqli_connect_error();
            }
            $table_data= array();
            
            while($row = mysqli_fetch_row($result)){
                // utf8_encode is used to save special symbols (é, è ...) 
                // str_replace is used to save euro and œ symbol
                if ($tableName == "domaine") {
                    $row[2] = utf8_encode($row[2]) ; //commentaire
                } elseif ($tableName == "champ") {
                    // htmlspecialchars ???
                    $row[1] = utf8_encode(str_replace("€", "&euro;", str_replace("œ", "&oelig;", $row[1]))) ; //label
                    $row[3] = utf8_encode(str_replace("€", "&euro;", $row[3])) ; //unité
                }  elseif ($tableName == "champ_type") {
                    // htmlspecialchars ???
                    $row[1] = utf8_encode(str_replace("€", "&euro;", str_replace("œ", "&oelig;", $row[1]))) ; //label
                    $row[2] = utf8_encode(str_replace("€", "&euro;", str_replace("œ", "&oelig;", $row[2]))) ; //label
                } 
                $table_data[]= $row;
            }
            $returnData[] = $table_data ;
        }
        
        // add user info
        $returnData[] = F_getUserData() ;
        
        //--------------------------------------------------------------------------
        // 3) return result as json 
        //--------------------------------------------------------------------------
        return json_encode($returnData);
    }
    function F_logIn() {
        
        global $host, $user, $pass, $dbName ;
        //--------------------------------------------------------------------------
        // 1) get and check user input
        //--------------------------------------------------------------------------
        $uname = $_POST['username'];
        $pword = $_POST['password'];
        $errorMessage = "";
        if (strlen($uname) < 6) {
            $errorMessage = $errorMessage . "Username must contain at least 6 characters" . "<BR>";
        }
        if (strlen($pword) < 8) {
            $errorMessage = $errorMessage . "Password must contain at least 8 characters" . "<BR>";
        }
        if ($errorMessage != "") {
            return "error " . $errorMessage;
        }
        //--------------------------------------------------------------------------
        // 2) Connect to mysql database
        //--------------------------------------------------------------------------
        // include 'DB.php';
        $link = mysqli_connect($host, $user, $pass, $dbName);
        if (!$link) {
            die('Erreur de connexion : ' . mysqli_connect_error());
        }
        //--------------------------------------------------------------------------
        // 3) Check if user exist
        //--------------------------------------------------------------------------
        $SQL = "SELECT * FROM user WHERE login = \"$uname\"";
        $result = mysqli_query($link, $SQL);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows < 1) {
            $errorMessage = "User do not exist";
            return $errorMessage;
        }
        $row = mysqli_fetch_row($result);
        $hash = $row[2] ;
        // echo "result= " . $hash ;
        //--------------------------------------------------------------------------
        // 4) Check password
        //--------------------------------------------------------------------------
        if (password_verify($pword, $hash)) {
            // Correct, check if hash used is still up to date
            if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
                // Hash has been deprecated, re-hash and store
                $newHash = password_hash($pword, PASSWORD_DEFAULT);
                //store new hash
                $SQL = "UPDATE user SET mdp=\"$newHash\" WHERE login=\"$uname\";";
                $result = mysqli_query($link, $SQL);
            }
            // now connect user
            return "ok!";
        } else {
            return "KO...";
        }
    }
    
    function F_signUp() {
        
        global $host, $user, $pass, $dbName ;
        //--------------------------------------------------------------------------
        // 1) get and check user input
        //--------------------------------------------------------------------------
        $uname = $_POST['username'];
        $pword = $_POST['password'];
        $umail = $_POST['usermail'];
        // $uname = htmlspecialchars($uname);
        // $pword = htmlspecialchars($pword);
        
        $errorMessage = "";
        if (strlen($uname) < 6) {
            $errorMessage = $errorMessage . "Username must contain at least 6 characters" . "<BR>";
        }
        if (strlen($pword) < 8) {
            $errorMessage = $errorMessage . "Password must contain at least 8 characters" . "<BR>";
        }
        if (strlen($umail) < 1) {
            $errorMessage = $errorMessage . "Please provide e-mail adress" . "<BR>";
        }
        if ($errorMessage != "") {
            return $errorMessage;
        }
        //--------------------------------------------------------------------------
        // 2) Connect to mysql database
        //--------------------------------------------------------------------------
        // include 'DB.php';
        $link = mysqli_connect($host, $user, $pass, $dbName);
        if (!$link) {
            die('Erreur de connexion : ' . mysqli_connect_error());
        }
        //--------------------------------------------------------------------------
        // 3) Check if user or mail exist
        //--------------------------------------------------------------------------
        $SQL = "SELECT * FROM user WHERE login = \"$uname\"";
        $result = mysqli_query($link, $SQL);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $errorMessage = "Username already taken";
            return $errorMessage;
        }
        $SQL = "SELECT * FROM user WHERE mail = \"$umail\"";
        $result = mysqli_query($link, $SQL);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $errorMessage = "e-mail already used";
            return $errorMessage;
        }
        //--------------------------------------------------------------------------
        // 2) Create the user
        //--------------------------------------------------------------------------
        if(function_exists("password_hash")){
            $hash = password_hash($pword, PASSWORD_DEFAULT) ;
        } else {
            $hash = hash("sha512", $pword);
        }
        
        $SQL = "INSERT INTO user (login, mdp, mail) VALUES (\"$uname\", \"".$hash."\", \"".$umail."\")";
        $result = mysqli_query($link, $SQL);
        
        // echo "coucou" ;
        
        $error = mysqli_error($con);
        mysqli_close($con);
        
        if($error){
            return "erreur: ".$error ;
        } else {
            return "success";
        }
        
    }

    function F_getUserData () {
        
        global $host, $user, $pass, $dbName ;
        //--------------------------------------------------------------------------
        // 1) get and check user input
        //--------------------------------------------------------------------------
    $uname = $_POST['logon'];
    if ($uname == "" ) {return array();}
        
        //--------------------------------------------------------------------------
        // 2) Connect to mysql database
        //--------------------------------------------------------------------------
        // include 'DB.php';
        $link = mysqli_connect($host, $user, $pass, $dbName);
        if (!$link) {
            die(json_encode('Erreur de connexion : ' . mysqli_connect_error()));
        }
        
        //--------------------------------------------------------------------------
        // 3) Check if user exist
        //--------------------------------------------------------------------------
        $SQL = "SELECT * FROM user WHERE login = \"$uname\"";
        $result = mysqli_query($link, $SQL);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows < 1 ) {
        echo "no user " . $uname ;
            return ;
        }
    
        //--------------------------------------------------------------------------
        // 4) Get current data state
        //--------------------------------------------------------------------------
        // get columns names
        $fields = F_listColumns($result);
        // get current user data
        $userData = mysqli_fetch_row($result);
        
        while (mysqli_next_result($link)) {;} // flush multi_queries
        
    $sType = $_POST['type'];  // type: "upload" or "download"
        if ($sType == "upload") { 
        $sData = $_POST['data'];  // data:   aTab
        $sData = trim($sData) ;
        try {
            $aData = json_decode($sData);  // data:   aTab
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
            // don't do query if nothing to update
            $bQuery = false ;
            
            $query2 = "UPDATE `avenirclsite`.`user` SET " ;
            $iMax = count($aData[0]) ;
            $date = date("Y/m/d") ;
            // for ($i = 0; $i < 2; $i++) {
            for ($i = 0; $i < $iMax; $i++) {
                $value = $aData[0][$i]; // user input
                $label = $aData[1][$i]; // on field ID
                $resul = $aData[2][$i]; // carbon equivalent (for history)
                // test if column exist
                $pos = array_search($label, $fields) ;
                if (!$pos) {
                    // column doesn't exist (new field)
                    echo "_create_column_". $label." with ".$date.";".$value."\n" ; // keep this message for debug, is ignored in GUI
                    // formatted message to give user a message at the end
                    echo "_create__domaine_". $label."_domaine__new_".$value."_new_\n" ;
                    $bQuery = true ;
                    // create the column
                    $query1 .= F_createColumn($label, "user") ;
                    // update the column with data
                    $query2 .= "`".$label."`=`".$date.";".$value.";".$resul."`," ;
                } elseif (array_key_exists($pos, $userData)){
                    // column exist
                    if ($userData[$pos] == "") {
                        // column is empty
                        $bQuery = true ;
                        $query2 .= "`".$label."`=\"".$date.";".$value.";".$resul."\"," ;
                        // formatted message to give user a message at the end
                        echo "_create__domaine_". $label."_domaine__new_".$value."_new_\n" ;
                    } else {
                        // data already exist, update only if needed. criteria are:
                        //    - new value
                        //    - existing value
                        $all = explode("_", $userData[$pos]) ;
                        $last = array_slice($all, -1)[0];
                        $aLast = explode(";", $last) ;
                        $lastDate = $aLast[0] ;
                        $lastValu = $aLast[1] ;
                        $lastResu = $aLast[2] ;
                        // echo " -last:"      .$last.
                             // " -all:"       .json_encode($all) .
                             // " -userdata:"  .$userData[$pos].
                             // " -lastdate:"  .$lastDate . 
                             // " -date:"      .$date . 
                             // " -lastval:"   .$lastValu . 
                             // " -val:"       .$value . "\n";
                        
                        // update only if new value is different
                        if ($lastValu != $value or $lastResu != $resul) {
                            $bQuery = true ;
                            // if no date (1st) or (  value was 0  and   was the 1st   ) or     date equal today
                            if ($lastDate == "" or ($lastValu == 0 and count($all) == 1) or strcmp($lastDate, $date) == 0) {
                                // remove last and add new
                                $temp = array_pop($all);  // remove last
                                $all[] = "$date;$value;$resul" ; // add new
                            // if last date is older, create a new value
                            } elseif (strcmp($lastDate, $date) < 0) {
                                $all[] = "$date;$value;$resul" ; // add new
                            } else {
                                // formatted message to give user a message at the end
                                echo "WUT date lastDate:$lastDate ; lastValu:$lastValu ; date:$date ; value:$value ????\n" ;
                            }
                            $res = join('_', $all);
                            $query2 .= "`".$label."`=\"".$res."\"," ;
                            // formatted message to give user a message at the end
                            echo "_change__domaine_". $label."_domaine__was_".$lastValu."_was__new_".$value."_new_\n" ;
                        }
                    }
                } else {
                    echo $pos." - ".$value." - should not go here !!!\n" ;
                }
            }
            if ($bQuery) {
                $query2 = substr($query2, 0, -1) ; // remove last comma
                $query2 .= " WHERE `login`=\"$uname\";" ; // apply query only on one user :)
                // echo $query1 . $query2. "\n" ;
                if (mysqli_multi_query($link, $query1 . $query2)) {
                    do {
                        /* sStockage du premier résultat */
                        if ($result = mysqli_store_result($link)) {
                            while ($row = mysqli_fetch_row($result)) {
                                echo json_encode($row)."\n";
                            }
                            mysqli_free_result($result);
                        }
                        /* Affichage d'une séparation */
                        if (mysqli_more_results($link)) {
                            echo "-----------------\n";
                        }
                    } while (mysqli_next_result($link));
                } else {
                    echo "nope\n" ;
                    if($error_mess=mysqli_error($link)){echo "Error @ Query Key ",key($q),": $error_mess";}
                }
            } else {
                echo "no update needed" ;
            }
            return ;
            
        } elseif ($sType == "download") {
            for ($i = 0; $i < count($userData); $i++) {
                // remove personal data
                if ($i < 4) { $userData[$i] = "" ; } 
                // or add field ID to value
                else {$userData[$i] = $fields[$i] . ":" . $userData[$i] ;}
            }
            return $userData ;
            // echo json_encode($userData) ;
            // return ;
        } else {
            echo "unknown request" ;
            return ;
        }
        
        $row = mysqli_fetch_row($result);
        
        return ;
    }
    function F_listColumns($result) {
        while ($property = mysqli_fetch_field($result)) {
            $array[] = $property->name;
        }
        return $array ;
    }
    function F_createColumn($id, $table) {
        return "ALTER TABLE `".$table."` ADD `".$id."` LONGTEXT NOT NULL;" ;
    }
?>