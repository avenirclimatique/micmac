
<?php 
    // header("charset=utf-8"); 
    // mb_internal_encoding("UTF-8");
    
    //--------------------------------------------------------------------------
    // Dataabase info
    //--------------------------------------------------------------------------
    $host = "avenirclsite.mysql.db";
    $user = "avenirclsite";
    $pass = "dztDYYmqppYC";
    $databaseName = "avenirclsite";
    
    // get the requested table
    if(isset($_POST['tableID'])) {
        $tableName = $_POST['tableID'];
    } else {
        echo json_encode("no table name");
        // echo "no table name";
        return ;
    }
    
    //--------------------------------------------------------------------------
    // 1) Connect to mysql database
    //--------------------------------------------------------------------------
    // include 'DB.php';
    $link = mysqli_connect($host, $user, $pass, $databaseName);
    if (!$link) {
        die(json_encode('Erreur de connexion : ' . mysqli_connect_error()));
    }
    //--------------------------------------------------------------------------
    // 2) Query database for data
    //--------------------------------------------------------------------------
    $query = "SELECT * FROM ".$tableName ;
    $result = mysqli_query($link, $query); 
    if (!$result) {
       echo 'Impossible d\'exécuter la requête : ' . mysqli_connect_error();
       exit;
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
    //--------------------------------------------------------------------------
    // 3) echo result as json 
    //--------------------------------------------------------------------------
    echo json_encode($table_data);
    
?>