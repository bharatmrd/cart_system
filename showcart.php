
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav navbar-right">
		<li style="padding-right: 20px;"><button class="btn btn-success" onclick="window.location.href='index.php'">Go to main page</button></li>
		</ul>
	</nav>
<?php
	$mysqli = new mysqli('localhost', 'secure_user', 'hello', 'cart');

	$prep_stmt = "SELECT itemno, quantity, size FROM item_details";
	$stmt = $mysqli->prepare($prep_stmt);

	if($stmt) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($item, $q, $s);

		if($stmt->num_rows == 0) {
			echo "<p class='text-center'>There is no item in your cart.</p>";
		} else {
			?>
			<div class="container">
			<div class="row" style='padding-bottom: 20px'>
				<div class="col-md-2"></div>
				<div class="col-md-3"><strong>Item</strong></div>
				<div class="col-md-2"><strong>Quantity</strong></div>
				<div class="col-md-2"><strong>Size</strong></div>
			</div>
			</div>
			<?php
		}

		while($stmt->fetch()) { 
			echo "<div class='container'> <div class='row' id='o-c" . $item . "'><div class='col-md-2'></div>";
			echo "<div class='col-md-3'> <img src='images/" . $item . ".jpg' class='img-thumbnail' alt='photo not available' height='100px' width='100px'>Price: 1499 </div>";
			echo "<div class='col-md-2 quantity'>" . $q . "</div>";
			echo "<div class='col-md-2 size'>" . $s . "</div>";
			echo "<div class='col-md-2 button'> <button class='btn btn-success' id='c" . $item . "' onclick='edit(this.id, ". $item . ")'>Edit this item</button><br><br>";
			echo "<button class='btn btn-danger'onclick='del(". $item . ")'>Delete this item</button></div>";
			echo "</div> </div><div style='padding: 20px'></div>";
		}
	}

?>
<script>
	function del(itemno) {
		// ask the user again to delete the item
		if(confirm("Are you sure to delete this?")) {
			$.post('delete.php', {postitem: itemno},
				function(data)
				{
					alert(data);
				});
			window.location.reload();
		}
	}
	// function to edit the item.
	function edit(c, itemno) {
		// get the id of item that has to be edited
		var cl = "o-" + c;
		var x = document.getElementById(cl);
		var childrens = x.children;
		var qu = null;
		var si = null;
		var a = 0;
		for(var i = 0; i < childrens.length; i++)
		{
			if(childrens[i].className == "col-md-2 button") {
				// selected button div
				button = childrens[i];
				a++;
			}
			if(childrens[i].className == "col-md-2 quantity") {
				// selected quantity div
				qu = childrens[i];
				a++;
			}
			if(childrens[i].className == "col-md-2 size") {
				// selected size div
				si = childrens[i];
				a++;
			}
			if(a == 3) {
				break;
			}
		}
		// make button 'update' after clicking on edit
		button.innerHTML = "";
		var up = "<button class='btn btn-success' id='c" + itemno + "' onclick='update(this.id,  " + itemno + ")'>Update</button>";
		// insert update button
		button.innerHTML = up;
		qu.innerHTML = "";
		si.innerHTML = "";
// Create array of options to be added
var array1 = [1, 2, 3, 4, 5, 6, 7, 8, 9];
var array2 = ['S', 'M', 'L'];
// Create and append select list
var quantityList = document.createElement("select");
quantityList.id = "q";
qu.appendChild(quantityList);

var sizeList = document.createElement("select");
sizeList.id = "s";
si.appendChild(sizeList);

// add quantity list to quantity div when user clicks on edit button.
for (var i = 0; i < array1.length; i++) {
    var option = document.createElement("option");
    option.value = array1[i];
    option.text = array1[i];
    quantityList.appendChild(option);
}

// add size list to size div when user clicks on edit button.
for (var i = 0; i < array2.length; i++) {
    var option = document.createElement("option");
    option.value = array2[i];
    option.text = array2[i];
    sizeList.appendChild(option);
}
}
	// function to update edited list
	function update(c, itemno) {
		// get id of item that has to be updated.
		var cl = "o-" + c;
		var x = document.getElementById(cl);
		var childrens = x.children;
		var it = null;
		var qu = null;
		var si = null;
		var a = 0;
		for(var i = 0; i < childrens.length; i++)
		{
			if(childrens[i].className == "col-md-2 quantity") {
				// get quantity div
				qu = childrens[i];
				a++;
			}
			if(childrens[i].className == "col-md-2 size") {
				// get quantity div
				si = childrens[i];
				a++;
			}
			if(a == 2) {
				break;
			}
		}
		var b = qu.children;
		var q = b[0];
		var c = si.children;
		var s = c[0];
		// get value of quantity
		var quantity = q.options[q.selectedIndex].value;
		// get value of size
		var size = s.options[s.selectedIndex].value;
		// send data to update.php file to update the values.
		$.post('update.php', {postitem: itemno, postq: quantity, posts: size},
			function(data)
			{
				alert(data);
			});
		window.location.reload();
	}
</script>
</body>
</html>