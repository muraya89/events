<?php

include('../helpers/DbHelpers.php');

class changeProfile{
   protected $db_instance;
    
    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }
    public function Profile($postData){
        if (isset($postData['save'])) {
            $result = $this->db_instance->updatedata('employees', 
                [
                    'natid' => $postData['nationalid'],
                    'empID' => $postData['empid'],
                ]);
            if (!$result->response) {
                $this->db_instance->errorFunction('profile.php','notsaved');
                exit();
            }else{
                header("Location: ../profile.php");
                exit();
            }
        }
    }
}
//
$changeProfile = new changeProfile($db_helpers);
$changeProfile->Profile($_POST);