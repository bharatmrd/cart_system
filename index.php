<!DOCTYPE html>
<html>
<head>
<title>Title</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<body>
	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav navbar-right">
		<li style="padding-right: 20px;"><button class="btn btn-success" onclick="window.location.href='showcart.php'">Your cart</button></li>
		</ul>
	</nav>
	<?php 
		for($x = 1; $x <= 10; $x++)
		{
			echo "<div class='container'>
				  <div class='row' id='o-c" . $x . "'>
				  	<div class='col-md-2'></div>
					<div class='col-md-3' id='item' value='" . $x . "'>
					<img src='images/" . $x . ".jpg' class='img-thumbnail' alt='photo not available' height='100px' width='100px'>
					Price: 1499
					</div>
					<div class='col-md-2 quantity'>
						Quantity: 
						<select id='q'>
							<option value='quantity'>Quantity</option>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
							<option value='6'>6</option>
							<option value='7'>7</option>
							<option value='8'>8</option>
							<option value='9'>9</option>
						</select>
					</div>
					<div class='col-md-2 size'>
						Size: 
						<select id='s'>
							<option value='size'>Size</option>
							<option value='S'>S</option>
							<option value='M'>M</option>
							<option value='L'>L</option>
						</select>
					</div>
					<div class='col-md-2'>
						<button class='btn btn-success' id='c" . $x . "' onclick='addtocart(this.id)'>Add to my cart</button>
					</div>
				  </div>
				  </div><div style='padding: 20px'></div>";
		}
	?>
	<footer>
			<p class="text-center">&copy <?php echo date("Y"); ?>-Bhartendu Marodia</p>
	</footer>
	<script>

	function addtocart(c) {
		// Get the id of selected div element
		var cl = "o-" + c;
		var x = document.getElementById(cl);
		// Get children of selected div
		var childrens = x.children;
		var it = null;
		var qu = null;
		var si = null;
		var a = 0;
		for(var i = 0; i < childrens.length; i++)
		{
				if(childrens[i].className == "col-md-3") {
				// selected item div
				it = childrens[i];
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
		var b = qu.children;
		var q = b[0];
		var c = si.children;
		var s = c[0];
		// get the value of item
		var itemno = it.getAttribute('value');
		// get the quantity of selected item
		var quantity = q.options[q.selectedIndex].value;
		// get the size of selected item
		var size = s.options[s.selectedIndex].value;
		// check if quantity or size is valid or not
		if(quantity != 'quantity' && size != 'size') {
			save(itemno, quantity, size);
		} else {
			alert("Provide correct quantity and size.");
		}
	}
	// function to insert details into our database.
	function save(itemno, quantity, size) {
		$.post('addtocart.php', {postitem: itemno, postq: quantity, posts: size},
			function(data)
			{
				alert(data);
			});
	}
	</script>
</body>
</html>