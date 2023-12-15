<?php
require_once "database/database.php";

$db = db();
$id = isset($_GET['id']) ? $_GET['id'] : "";
if ($id == '') {
    header('location: index.php');
} else {
    deleteStudent($id);
    header('location: index.php');
}
//deleteStudent();