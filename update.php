<?php
require_once 'function.php';
$err = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    if (checkRequiredField('name')) {
        $name = $_POST['name'];
    } else {
        $err['name'] = 'Enter name';
    }
    if (checkRequiredField('course')) {
        $course = $_POST['course'];
    } else {
        $err['course'] = 'Enter course';
    }
    if (checkRequiredField('fee')) {
        $fee = $_POST['fee'];
    } else {
        $err['fee'] = 'Enter fee';
    }
    if (checkRequiredField('rollno')) {
        $rollno = $_POST['rollno'];
    } else {
        $err['rollno'] = 'Enter rollno';
    }
    if (checkRequiredField('phone')) {
        $phone = $_POST['phone'];
        if(matchPattern($phone,'/^(98|97)\d{8}$/')){
            $phone = $_POST['phone'];
        } else{
            $err['phone'] = 'Enter a valie  phone number';
        }
    } else {
        $err['phone'] = 'Enter phone';
    }
    if (checkRequiredField('address')) {
        $address = $_POST['address'];
    } else {
        $err['address'] = 'Enter address';
    }
    if (checkRequiredField('dob')) {
        $dob = $_POST['dob'];
    } else {
        $err['dob'] = 'Enter dob';
    }
    
    $status = $_POST['status'];

    if (count($err) == 0) {
        if (updateStudent($id,$name,$course,$fee,$rollno,$phone,$address,$dob,$status)) {
              $err['success'] =  'student update success';
              header("Location: display.php");
        } else {
              $err['failed'] = 'student updated Failed';
        }
      }
  }
  
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $record = getStudentById($_GET['id']);
      if (!$record) {
          die('student not found');
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title> Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1>update student</h1>   
 <?php  echo displayErrorMessage($err,'failed')?>
 <?php  echo displaySuccessMessage($err,'success')?>
 <form action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>update Student Information</legend>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $record['name']?>">
            <?php  echo displayErrorMessage($err,'name')?>
        </div>
        <div class="form-group">
            <label for="course">Course</label>
            <input type="text" name="course" class="form-control" value="<?php echo $record['course']?>">
            <?php  echo displayErrorMessage($err,'course')?>
        </div>
        <div class="form-group">
            <label for="fee">Fee</label>
            <input type="number" name="fee" class="form-control" value="<?php echo $record['fee']?>">
            <?php  echo displayErrorMessage($err,'fee')?>
        </div>
        <div class="form-group">
            <label for="rollno">Rollno</label>
            <input type="text" name="rollno" class="form-control" value="<?php echo $record['rollno']?>">
            <?php  echo displayErrorMessage($err,'rollno')?>
        </div>
        <div class="form-group">
            <label for="phone">phone</label>
            <input type="number" name="phone" class="form-control"  value="<?php echo $record['phone']?>">
            <?php  echo displayErrorMessage($err,'phone')?>
        </div>
        <div class="form-group">
            <label for="address">address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $record['address']?>">
            <?php  echo displayErrorMessage($err,'address')?>
        </div>
        <div class="form-group">
            <label for="dob">dob</label>
            <input type="date" name="dob" class="form-control" value="<?php echo $record['dob']?>">
            <?php  echo displayErrorMessage($err,'dob')?>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <?php if($record['status']==1) {?>
                <input type="radio" name="status" value="1" class="form-control" checked>Active
                <input type="radio" name="status" value="0" class="form-control" >De-Active
         <?php   } else {?>

            <input type="radio" name="status" value="1" class="form-control">Active
            <input type="radio" name="status" value="0" class="form-control" checked>De-Active
            <?php }?>
            <?php  echo displayErrorMessage($err,'status')?>
        </div>
        <div class="form-group">
            <input type="submit" name="save" value="update student" class="form-control">
        </div>
    </fieldset>
 </form>
</body>
</html>