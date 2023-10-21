<?php
require('../helpers/DbHelpers.php');

class Login {
    
    protected $db_instance;
    
    public function __construct ($db_helpers) {
        $this->db_instance = $db_helpers;
    }
    
    public function login ($postData) {
        // login logic
        if (isset($postData['login_submit'])) {
            // check if the email match
            $res = $this->db_instance->CheckIfMatch(/* table name */'users',/* field name */ ['email' => $postData['email']]);
            if (mysqli_num_rows($res->response) < 1) {
                // no email found
                header('Location: ../index.php?error=emptyEmail');
                echo "email not found $res";
            } else {
                // check if the password matches
                $associativeArray = mysqli_fetch_assoc($res->response);
                $result = password_verify($postData['pass'], $associativeArray['password']);
                if (!$result) {
                    header("Location: ../index.php?error=403");
                } else {
                    /** start session */
                    $_SESSION['id'] = $associativeArray['id'];
                    $_SESSION['name'] = $associativeArray['name'];
                    $_SESSION['role'] = $associativeArray['role'];
                    $associativeArray['role'] === '0'? header('Location: ../Attendees/leaveApphis.php') : header('Location: ../Organizers/leaveStatus.php');
                }
            }
        }else {
                header('Location:', '../signup.php');
            }
        }
    }
    session_start();
    $login = new Login($db_helpers);
    $login->login($_POST);
    
    ?>
