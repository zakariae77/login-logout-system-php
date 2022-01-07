<?php

class Signup extends Dbh
{
    protected function setUser($uid, $pwd, $email)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (user_uid, user_pwd, user_email) VALUES(?, ?, ?);');
       $hashedPwd = password_hash ($pwd, PASSWORD_DEFAULT);



        if(!$stmt->execute(array($uid, $hashedPwd, $email)))
        {
            $stmt = null;
            header("location: ../index.php?error=stmtFailed001");
            exit();
        }

        $stmt = null;
    }


    protected function checkUser($uid, $email)
    {
        //send sql code to the DB and prepare it
        $stmt = $this->connect()->prepare('SELECT user_uid FROM users WHERE user_uid = ? OR user_email = ?;');
       // Error handling: if the query didn't execute
        if(!$stmt->execute(array($uid, $email)))
        {
            $stmt = null;
            header("location: ../index.php?error=stmtFailed002");
            exit();
        }
        // check if we get any rows result return from the query
        $resultCheck;
        ($stmt->rowcount() > 0)? $resultCheck = false : $resultCheck = true;
        return $resultCheck;
    }
}