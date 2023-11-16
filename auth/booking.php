<?php
require_once('../helpers/DbHelpers.php');
// session_start();

class Book {
    protected $db_instance;

    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }

    public function book($postData) {
        if (isset($postData['booking_submit'])) {
            // var_dump($postData);
            // exit();
            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                header("Location: ../Attendees/event.php?event=".$postData['event_id']."error=invalidemail&name=".$postData['name']);
                exit();
            }
            elseif (empty($postData['name'])) {
                header("Location: ../Attendees/event.php?event=".$postData['event_id']."&error=emptyName&email=".$postData['email']);
                exit();
            }
            elseif ($postData['available_tickets'] < $postData['tickets_purchased'] || $postData['tickets_purchased'] === 0) {
                header("Location: ../Attendees/event.php?event=".$postData['event_id']."&error=validAmount&name=".$postData['name']."&email=".$postData['email']);
                exit();
            }else{
                $saveUser = $this->db_instance->insertData(/** table name */'bookings', [
                    'name' => $postData['name'],
                    'email' => $postData['email'],
                    'tickets_purchased' => $postData['tickets_purchased'],
                ], $postData['event_id'], $postData['user_id']);
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

$book = new Book($db_helpers);
$book->book($_POST);

?>