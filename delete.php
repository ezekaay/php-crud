<?php
require_once 'function.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    if (getStudentById($id)) {
        if (deleteStudent($id)) {
            header("Location: display.php");
        }
    }
}
?>
