<?php 
    //--------------------------------------------------------------------------
    // 0) Database info
    //--------------------------------------------------------------------------
    $host = "avenirclsite.mysql.db";
    $user = "avenirclsite";
    $pass = "dztDYYmqppYC";
    $databaseName = "avenirclsite";
    
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
        echo $errorMessage;
        return ;
    }
    //--------------------------------------------------------------------------
    // 2) Connect to mysql database
    //--------------------------------------------------------------------------
    // include 'DB.php';
    $link = mysqli_connect($host, $user, $pass, $databaseName);
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
        echo $errorMessage;
        return ;
    }
    $SQL = "SELECT * FROM user WHERE mail = \"$umail\"";
    $result = mysqli_query($link, $SQL);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        $errorMessage = "e-mail already used";
        echo $errorMessage;
        return ;
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
        echo "erreur: ".$error ;
    } else {
        echo "success";
    }
    
?>