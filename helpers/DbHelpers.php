<?php
// function to replace all double backslashes to slash
function GetRelativePath($path)
{
  $npath = str_replace('\\', '/', $path);
  return str_replace('DOCUMENT_ROOT', '', $npath);
}
// _file_  return the full path of the executed file with the name of the file.
// _dir_  return the directory of the executed file.
// use the dirname to redirect to the root directory
require(GetRelativePath(dirname(__FILE__))."../../config/db.conf.php");

class DbHelpers {
  public $db;
  // always run this before any method in this file
  public function __construct($conn) {
    $this->db = $conn;
  }
    
  // method to check whether two fields match
  public function CheckIfMatch ($tableName, $field) {
    // sql query to get the table and the two fields and comparison
    $result = mysqli_query($this->db,"SELECT * FROM $tableName WHERE ".array_key_first($field)." = '".$field[array_key_first($field)]."'");
    if (!$result) {
    // if the two fields do not match return the following array
      return (object)[
        "response" => 'Field not found',
        "message" => mysqli_error($this->db)
      ];
    } else {
      // if they do return a success object
      return (object)[
        "response" => $result,
        "message" => "success"
      ];
    }
  }
  
  // method to check the password using php function preg_match
  public function PasswordChecker ($password) {
    // password variables
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    // return if either is false
    return !$uppercase || !$number ||!$lowercase || !$specialChars || strlen($password)<8;
  }
  
  // method to add data to the db
  public function postData ($table, $data) {
    // with the passed in data (implode) separate the data with a comma
    $fields = implode(", ", array_keys($data));
    $values  = "'".implode("', '", array_values($data))."'";
    // sql query to insert the data into the passed in variable table
    $result = mysqli_query($this->db, "INSERT INTO `".$table."` ($fields) VALUES ($values)");
    // mysqli_close($this->db);
    if (!$result) {
      return (object)[
        "response" => $result,
        "message" => 'error message'
      ];
    } else {
      return (object)[
        "response" => $result,
        "message" => "success"
      ];
    }
  }

  // method to update data in the db
  public function updateData ($table, $data) {
    $values = '';
    // loop through the data so as to compare the keys
    foreach($data as $key => $value) {
      $values .= $key.' = "'.$value.'", ';
    }
    // the result is then passed to the sql query where trailing commas are removed and id compared to get the correct value
    $result = mysqli_query($this->db, "UPDATE `".$table."` SET ".rtrim($values, ", ")." WHERE empID = ".$data['empID']);
    // mysqli_close($this->db);
    if (!$result) {
      return (object)[
        "response" => $result,
        "message" => 'error message'
      ];
    } else {
      return (object)[
        "response" => $result,
        "message" => "success"
      ];
    }
  }
  
  // method to fetch all data from table
  public function getAll ($table) {
    $result = mysqli_query($this->db, "SELECT * FROM " . $table);
    if ($result) {
      $data = [];
      while ($row = mysqli_fetch_assoc($result)) {
          $data[] = $row;
      }
      return $data;
    } else {
      return 'table not found';
    }
  }

  public function countData ($table) {
    $result = mysqli_query($this->db, "SELECT COUNT(*) as count FROM $table");
    if ($result) {
      return $result;
    } else {
      return 'table not found';
    }
  }
  
  // method to fetch specific data from a table
  public function getSpecifics ($table, $id) {
    $result = mysqli_query($this->db, "SELECT * FROM $table WHERE id = '$id'");
    if ($result) {
      return $result;
    } else {
      return 'table not found';
    }
  }

  public function fetchBookings($userID) {
    $result = mysqli_query($this->db, "SELECT bookings.*,events.*
    FROM bookings
    JOIN events ON bookings.event_id = events.id
    WHERE bookings.user_id = '$userID'
    ");
    if ($result) {
      return $result;
    } else {
      return 'table not found';
    }
  }

  public function errorFunction ($page, $errorMessage) {
    header("Location: ../$page?error=$errorMessage");
    exit();
  }

  public function sumRevenue(){
    $result  = mysqli_query($this->db, "SELECT sum(total_amount) from bookings;");
    if($result){
      return $result;
    }else{
      return (object)[
        "response" => $result,
        "message" => "success"
      ];
    }
  }

  public function countUsers ($account_type) {
    $result = mysqli_query($this->db, "SELECT COUNT(*) as count FROM users");
    if ($result) {
      return $result;
    } else {
      return 'table not found';
    }
  }
  
  public function ordering(){
    $result = mysqli_query($this->db, "SELECT animals.breed,animals.type, sum(quantity)from orders,animals where orders.product_id=animals.id group by breed order by sum(quantity) desc limit 4  ");
    // var_dump(mysqli_fetch_assoc($result));die();
    if($result){
      return $result;
    }else{
      return 'table not found';
    }
  }
}

// create the new objectDEL17713
$db_helpers = new DbHelpers($conn);

?>