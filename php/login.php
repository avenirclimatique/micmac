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
    $errorMessage = "";
    if (strlen($uname) < 6) {
        $errorMessage = $errorMessage . "Username must contain at least 6 characters" . "<BR>";
    }
    if (strlen($pword) < 8) {
        $errorMessage = $errorMessage . "Password must contain at least 8 characters" . "<BR>";
    }
    if ($errorMessage != "") {
        echo "error " . $errorMessage;
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
    // 3) Check if user exist
    //--------------------------------------------------------------------------
    $SQL = "SELECT * FROM user WHERE login = \"$uname\"";
    $result = mysqli_query($link, $SQL);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows < 1) {
        $errorMessage = "User do not exist";
        echo $errorMessage;
        return ;
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
        echo "ok!";
    } else {
        echo "KO...";
    }
?>