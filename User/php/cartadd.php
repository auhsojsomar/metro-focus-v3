<?php 
	include '../includes/db.php';
	$num = $_POST['cart_count'];
	$email = $_COOKIE['email'];
	date_default_timezone_set('Asia/Manila');
	$datee = date('m/d/Y h:i A');
	$d = $_POST['rdate'];
	$itemid = $_POST['item_id'];
	$category = $_POST['categ'];
	$quan = $_POST['qquantity'];
	for ($i=0; $i < $num; $i++) { 
		mysqli_query($con,"INSERT INTO reservation (username,reservationdate,itemid,category,itemquantity)VALUES('$email','$d',$itemid[$i],'$category[$i]',$quan[$i])");
		mysqli_query($con,"DELETE FROM cart WHERE user = '$email'");
		mysqli_query($con,"INSERT INTO notifications (user,type,date_time)VALUES('$user','Reservation','$datee')");
		if($category[$i] == 'Parts'){
			mysqli_query($con,"UPDATE parts SET quantity = quantity - $quan[$i] WHERE id = $itemid[$i]");
		}
		if($category[$i] == 'Accessories'){
			mysqli_query($con,"UPDATE accessories SET quantity = quantity - $quan[$i] WHERE id = $itemid[$i]");
		}
	}
 ?>