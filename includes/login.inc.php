<?php

if(isset($_POST["submit"]))
{
    // Grabbing the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
   
    // Instantiate SingUpcontr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new LoginContr( $uid, $pwd );
    
    // Running error handlers and user signup
    $login->LoginUser();


    // Going back to front page
    header("location: ../index.php?error=null");
}