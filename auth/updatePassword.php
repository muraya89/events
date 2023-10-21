<?php

include('../helpers/DbHelpers.php');

class updatePassword{
   protected $db_instance;
    
    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }
    public function newPassword($postData){
        if (isset($postData['update'])) {
            $result = $this->db_instance->updatedata('employees', 
                [
                    'password' => password_hash($postData['newpassword'], null),
                    'empID' => $postData['id'],
                ]);
            if (!$result->response) {
                $this->db_instance->errorFunction('updatePassword.php','notsaved');
                exit();
            }else{
                header("Location: ../index.php");
                exit();
            }
        }
    }
}
//
$updatePassword = new updatePassword($db_helpers);
$updatePassword->newPassword($_POST);