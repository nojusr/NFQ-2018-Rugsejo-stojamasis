<html>
	
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php 
			if(isset($_GET['noinit'])) {
				echo "<link rel='stylesheet' href='css/global_noanim.css'>";
			}else{
				echo "<link rel='stylesheet' href='css/global.css'>";
			}
		?>
		<title>NR-Kompiuteriai</title>
	</head>
	<body>
		
		<div class="order-init">
		
		</div>
		
		<div class="order-wrapper" method="post">
			<form class="search">
				<input name="squery" type="text" placeholder="Paieška..." >
				<select name="stype">
					<option value="all" disabled selected>Ieškoti pagal</option>
					<option value="all">Viską</option>
					<option value="name">Vardą</option>
					<option value="surname">Pavardę</option>
					<option value="location">Gyvenvietę</option>
					<option value="email">E. paštą</option>
					<option value="ram">RAM</option>
					<option value="ssd">SSD</option>
					<option value="hdd">HDD</option>
					<option value="gpu">GPU</option>
					<option value="cpu">CPU</option>
				</select>
				<input type="submit" value="Ieškoti">
			</form>
			<div class="order-seperator"></div>
			<div class="pages"></div>
			<table class="data">
			
			</table>
		</div>
		

	</body>
	
	

</html>
