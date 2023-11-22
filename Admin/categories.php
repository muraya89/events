<?php
require_once('../helpers/DbHelpers.php');
session_start();

class Category {
    protected $db_instance;

    public function __construct($db_helpers) {
        $this->db_instance = $db_helpers;
    }

    public function category ($postData) {
        if (isset($postData['supply_submit'])) {
            // data validation
            if (empty($postData['name'])) {
                header("Location: ../../admin/addCategories.php?error=emptyfields&name=".$postData['name']."&type=".$postData['type']);
                exit();
            }elseif (empty($postData['type'])) {
                header("Location: ../../admin/addCategories.php?error=emptyfield&name=".$postData['name']."&type=".$postData['type']);
                exit();
            }else{
                $saveCategory = $this->db_instance->postData(/** table name */'categories', [
                    'name' => $postData['name'],
                    'type' => $postData['type'],
                ]);
                if (!$saveCategory->response) {
                    header("Location: ../../admin/addCategories.php");
                    exit();
                } else {
                    header("Location: categories_report.php");
                    exit();
                }
            } 
        }else{
            header("Location: ../../admin/addCategories.php");
        }
    }
    public function EditCategories ($data) {
        if (isset($data['supply_submit'])) {
            //new arrays
            $newDataArray = [];
            unset($data['supply_submit']);
            unset($data['submitType']);
            $keys = array_keys($data);
            
            // check for empty values
            for ($i=0; $i < count($keys); $i++) { 
                if (empty($data[$keys[$i]])) {
                    // if there are empty values then the error function is called
                    $this->db_instance->errorFunction('emptyfields');
                    break;
                } else {
                    $newDataArray[$keys[$i]] = $data[$keys[$i]];
                }
            }
            // call function to update the values to the database
            $saveAnimal = $this->db_instance->updateData('categories', $newDataArray);
            if (!$saveAnimal->response) {
                $this->db_instance->errorFunction('notsaved');
                exit();
            } else {
                header("Location: categories_report.php");
                exit();
            }
        }
    }
}

$category = new Category($db_helpers);
// $category->category($_POST);
if (isset($_POST['supply_submit'])) {
    $_POST['submitType'] == 'edit' ? $category->EditCategories($_POST) : $category->category($_POST);
}

?>