<?php

include('../helpers/DbHelpers.php');

class forgotPassword{
   protected $db_instance;
    
    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }

    public function firstFriend($postData){
        if (isset($postData['firstFriend'])) {
            // check if email exists
            $res = $this->db_instance->CheckIfMatch('employees', ['email' => $postData['email']]);
            if (mysqli_num_rows($res->response) < 1) {
                header("Location: ../forgotpassword.php?error=empty&&email=".$postData['email']."&&answer=".json_encode($postData['password']));
            }else{
                // fetch the data first from the response $res
                $associativeArray = mysqli_fetch_assoc($res->response);
                // var_dump($associativeArray); exit();
                // check if the answer matches
                $result = password_verify($postData['question'], $associativeArray['question']);
                if (!$result) {
                    // if it doesn't match redirect to page and try again
                    header("Location: ../forgotpassword.php?error=wrong&&email=".$postData['email']."&&answer=".password_hash($postData['password'],null));
                }else{
                    // if it does, redirect to updating password page
                    // var_dump($associativeArray); exit();
                    $_SESSION['id'] = $associativeArray['empID'];               
                    header('Location: ../updatepassword.php?id='.$associativeArray['empID']);
                }
            }
            // var_dump($res);
        }
    }
}
$forgotPassword = new forgotPassword($db_helpers);
$forgotPassword->firstFriend($_POST);