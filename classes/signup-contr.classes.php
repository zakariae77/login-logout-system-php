<?php

class SignupContr extends Signup
{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }
    //allow to signup only if there is no error 
    public function signupUser()
    {
        // echo " input is empty"
        if($this->emptyInput() == false)
        {
            header("location: ../index.php?error=emptyInput");
            exit();
        }
        if($this->invalidUid() == false)
        {
            header("location: ../index.php?error=userName");
            exit();
        }
        if($this->invalidEmail() == false)
        {
            header("location: ../index.php?error=email");
            exit();
        }
        if($this->pwdMatch() == false)
        {
            header("location: ../index.php?error=passwordMatch");
            exit();
        }
        if($this->uidTakenCheck() == false)
        {
            // echo "Username or email taken"
            header("location: ../index.php?error=userOrEmailTaken");
            exit();
        }
        // signup the user after pass all error handler above
        $this->setUser($this->uid, $this->pwd, $this->email);

    }


    //   Error handlers
    private function emptyInput()
    {
        $result;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidUid()
    {
        $result;
        if( !preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL) )
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch()
    {
        $result;
        if( $this->pwd !== $this->pwdRepeat )
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    //return false if user ID already exist in the DB
    private function uidTakenCheck()
    {
        $result;
        if( !$this->checkUser($this->uid, $this->email))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}