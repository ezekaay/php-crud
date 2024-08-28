<?php
require_once 'function.php';
$err = [];
if (isset($_GET['delid']) && is_numeric($_GET['delid'])) {
    if (getStudentById($_GET['delid'])) {
        if(deleteStudent($_GET['delid'])){
            $err['success'] =  'Category deleted success';
        } else {
            $err['failed'] = 'Category delete Failed';
        }
    } else {
        $err['failed'] = 'Category not found';
    }
}
$records = getAllStudent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <style>
        .error{
            color:red;
            border-bottom: 1px red dashed;
        }
        .success{
            color:green;
            border-bottom: 1px green dashed;
        }
    </style>
    </style>
</head>
<body>
    <button> <a href="add.php">Add Student</a></button>
    
    <h1 align="center">list of students</h1>
    <?php  echo displayErrorMessage($err,'failed')?>
    <?php  echo displaySuccessMessage($err,'success')?>
    <table width="100%" border="1">
        <tr>
            <th>Sn</th>
            <th>Name</th>
            <th>Course</th>
            <th>Roll No.</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
        <?php foreach ($records as $key => $record) { ?>
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $record['name']?></td>
                <td><?php echo $record['course']?></td>
                <td><?php echo $record['rollno']?></td>
                <td><?php echo printStatus($record['status'])?></td>
                <td><?php echo $record['created_at']?></td>
                <td><?php echo $record['updated_at']?></td>
                <td>
                    <a href="update.php?id=<?php echo $record['id'] ?>">Update</a>
                    <a href="delete.php?id=<?php echo $record['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>