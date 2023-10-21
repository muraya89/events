<?php
require_once('../helpers/DbHelpers.php');
// session_start();

class Register {
    protected $db_instance;

    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }

    public function register ($postData) {
        if (isset($postData['signup_submit'])) {
            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?error=invalidemail&name=".$postData['name'].
                "&address=".$postData['address']."&phoneno=".$postData['phone']);
                exit();
            }
            elseif (empty($postData['newpass'])) {
                header("Location: ../signup.php?error=invalidpassword&fname=".$postData['fname']."&email=".$postData['email']."&address=".$postData['address']."&phoneno=".$postData['phone']);
                exit();
            }
            elseif ($this->db_instance->PasswordChecker($postData['newpass'])) {
                header("Location: ../signup.php?error=invalidPassword&fname=".$postData['fname']."&email=".$postData['email']."&address=".$postData['address']."&phoneno=".$postData['phone']);
                exit();
            }
            elseif ($postData['newpass'] !== $postData['confpass']) {
                header("Location: ../signup.php?error=passwordCheck&cname=".$postData['fname']."&email=".$postData['email']."&address=".$postData['address']."&phoneno=".$postData['phoneno']);
                exit();
            }else{
                // var_dump($postData['role']);
                $saveUser = $this->db_instance->postData(/** table name */'users', [
                    'name' => $postData['name'],
                    'email' => $postData['email'],
                    'address' => $postData['address'],
                    'phone' => $postData['phone'],
                    'gender' => $postData['gender'],
                    'dob' => $postData['dob'],
                    'natid' => $postData['natid'],
                    'role' => $postData['role'],
                    'password' => password_hash($postData['newpass'], null)
                ]);
                if (!$saveUser->response) {
                    header("Location: ".$postData['redirect_to']);
                    exit();
                } else {
                    header("Location: ".$postData['redirect_to']);
                    exit();
                }
            } 
        }else{
            header("Location: ".$postData['redirect_to']);
        }
    }
}

$register = new Register($db_helpers);
$register->register($_POST);

?>