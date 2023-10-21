<?php 
include('../helpers/DbHelpers.php');

class LeaveApplication {
    protected $db_instance;
    
    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }

    public function LeaveApplication ($postData) {
        if (isset($postData['confirmNsend'])) {
          //new arrays
          $newDataArray = [];
          unset($postData['confirmNsend']);
          // unset($postData['submitType']);
          // unset($postData['id']);
          $keys = array_keys($postData);
          
          // check for empty values
          for ($i=0; $i < count($keys); $i++) { 
              if (empty($postData[$keys[$i]])) {
                  $this->db_instance->errorFunction('emptyfields');
                  break;
              } else {
                  $newDataArray[$keys[$i]] = $postData[$keys[$i]];
              }
          }
  
          $newDataArray['processingStatus'] = 'pending';
          $saveApplication = $this->db_instance->postData('leaveapplications', $newDataArray);
          if (!$saveApplication->response) {
              $this->db_instance->errorFunction('forgotPassword.php','notsaved');
              exit();
          } else {
              header("Location: ../leaveApphis.php");
              exit();
          }
        }
      }
}

$leaveApplication = new LeaveApplication($db_helpers);
// $_post super global variable used to collect data from the HTML form after submitting it.
$leaveApplication->LeaveApplication($_POST);

?>