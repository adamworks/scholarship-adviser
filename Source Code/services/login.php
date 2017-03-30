<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';
    
    // $u = "pasti";
    // $p = "pasti";
    
    $username   = mysql_real_escape_string($_POST['username']);
    $pass = htmlentities(md5($_POST['password']));
    $query = "SELECT password FROM db_user WHERE username ='$username'";
    $q= mysql_query($query);
    $q2 = mysql_fetch_array($q);
    $q3 = $q2["password"];
    if($q3==$pass){
        $output = array('status' => true);
        echo json_encode($output);
    }
    else{
        $output = array('status' => false);
        echo json_encode($output);
    }
        //echo $q;
    //$q3 = mysql_num_rows($q2);
    //echo $query;
    // //foreach ($q2 as $c){
    // if($p==$)
    //     if (preg_match_all("/$p/",$c,$d)){
    //         echo $d;
    //     //}
    //}

    //$q= mysql_query ("SELECT * FROM db_user WHERE username = '$username' AND password = '$passwordn' ");
    // $data = mysql_fetch_array($q);
    // if($pass == $data['password']){
    
            
    // if(mysql_num_rows($q2)=1){
    //     //while ($row = mysql_fetch_array($result)) {
    //         $output = array('status' => true);
    //     echo json_encode($output);
    // }
    // else{
    //     $output = array('status' => false);
    //     echo json_encode($output);
    // }

?>