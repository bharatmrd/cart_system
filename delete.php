<?php
	
	$mysqli = new mysqli('localhost', 'root', 'password', 'cart');

	$itemno = $_POST['postitem'];

	if(!$mysqli->connect_error) {
		// delete query for selected item.
		if($insert_stmt = $mysqli->prepare("DELETE FROM item_details WHERE itemno = ?")) {
			$insert_stmt->bind_param('d', $itemno);
			if($insert_stmt->execute()) {
				echo "Successfully deleted";
			} else {
				echo "There is some error.";
			}
		} else {
			echo "Can't delete";
		}
	} else {
		echo "There is some connection problem.";
	}
?>
