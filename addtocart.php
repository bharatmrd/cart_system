<?php
	
	$mysqli = new mysqli('localhost', 'root', 'password', 'cart');

	$itemno = $_POST['postitem'];
	$quantity = $_POST['postq'];
	$size = $_POST['posts'];

	if(!$mysqli->connect_error) {
		// create insert query
		if($insert_stmt = $mysqli->prepare("INSERT INTO item_details (itemno, quantity, size) VALUES (?, ?, ?)")) {
			$insert_stmt->bind_param('dds', $itemno, $quantity, $size);
			if($insert_stmt->execute()) {
				echo "Successfully added to cart.";
			} else {
				echo "There is some error.";
			}
		} else {
			echo "Can't add to cart.";
		}
	} else {
		echo "There is some connection problem.";
	}
?>
