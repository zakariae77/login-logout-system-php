<?php

if(isset($_POST["submit"]))
{
    // Grabbing the data
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwRepeat = $_POST["pwdRepeat"];
    $email = $_POST["email"];
   
    // Instantiate SingUpcontr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";

    $signup = new SignupContr( $uid, $pwd, $pwRepeat, $email );
    
    // Running error handlers and user signup
    $signup->signupUser();


    // Going back to front page
    header("location: ../index.php?error=null");
}