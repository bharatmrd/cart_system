<?php
	
	$mysqli = new mysqli('localhost', 'root', 'password', 'cart');

	$itemno = $_POST['postitem'];
	$quantity = $_POST['postq'];
	$size = $_POST['posts'];

	if(!$mysqli->connect_error) {
		// update query for slected item
		if($insert_stmt = $mysqli->prepare("UPDATE item_details SET quantity = ?, size = ?  WHERE itemno = ?")) {
			$insert_stmt->bind_param('dsd', $quantity, $size, $itemno);
			if($insert_stmt->execute()) {
				echo "Successfully updated";
			} else {
				echo "There is some error.";
			}
		} else {
			echo "Can't update";
		}
	} else {
		echo "There is some connection problem.";
	}
?>
