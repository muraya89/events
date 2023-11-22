<?php

require('../helpers/DbHelpers.php');
// define the class 
class AdminClass {

    protected $db_instance;
    // first run the db_helpers file before the method
    public function __construct ($db_helpers) {
        $this->db_instance = $db_helpers;
    }

    public function deleteRecord ($data) {
        if (isset($data['deleteSubmit'])) {
            $res = $this->db_instance->deleteData($data['table'], $data['id']);
            if (!$res->response) {
                header("Location: ".$data['redirect_to']);
                exit();
            } else {
                header("Location: ".$data['redirect_to']);
                exit();
            }
        }
    }


    
}

$admin = new AdminClass($db_helpers);
$admin->deleteRecord($_POST);

?>