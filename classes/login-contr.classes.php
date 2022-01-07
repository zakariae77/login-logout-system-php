<?php

class LoginContr extends Login
{
    private $uid;
    private $pwd;

    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }
    //allow to signup only if there is no error 
    public function loginUser()
    {
        // echo " input is empty"
        if($this->emptyInput() == false)
        {
            header("location: ../index.php?error=emptyInput");
            exit();
        }
       
        // signup the user after pass all error handler above
        $this->getUser($this->uid, $this->pwd );

    }


    //   Error handlers
    private function emptyInput()
    {
        $result;
        if(empty($this->uid) || empty($this->pwd) )
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

}