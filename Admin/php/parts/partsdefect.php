<?php
    include '../../../User/includes/db.php';
    $id = $_POST['user_id3'];
    $user = $_COOKIE['email'];
    $desc = $_POST['problem'];
    $quan = $_POST['defect'];
    date_default_timezone_set('Asia/Manila');
    $date = date('n/j/Y g:i A');
    $sql = mysqli_query($con,"SELECT * FROM parts WHERE id = $id");
    $row = mysqli_fetch_array($sql);
    mysqli_query($con,"INSERT INTO activitylogs (name,action,datemod,type,user,description)VALUES('$row[2]','Defect','$date','Parts','$user','$desc')");
    mysqli_query($con,"UPDATE parts SET quantity = quantity - $quan");
?>