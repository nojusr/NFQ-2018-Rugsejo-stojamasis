<html>
	<?php
		# prisijungimas prie duombazes
		include 'config.php';
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	?>
	
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/global.css">
		<title>NR-Kompiuteriai</title>
	</head>
	<body>
		<div class="init">
			<h1 class="init-title">NR-Kompiuteriai</h1>
		</div>
		
		<div class = "wrapper">
			<div class="left">
			<p>Sveiki atvykę i NR Kompiuterių svetainę. Mes statome kompiuterius iš geriausių įmanomų komponentų. Kiekviena dalis yra atsargiai parinkta, kad jums niekada nekiltų problemų su kompiuterio jėga bei stabilumu.</p>
			<p>Išsiuntus užsakymą mes susisieksime su jumis paštu. Jeigu norite specialaus užsakymo arba turite klausimų, galite kreiptis <a href="mailto::nojusr@gmail.com">į šį pašto adresą</a>.</p>
			</div>
			<div class="seperator"></div>
			<div class="right">
				<b>Užsakymai:</b>
				<form class="order">
					<p class="underline">Asmeninė informacija:</p>
					<p>Vardas: <input class="order-option" type="text"></p>
					<p>Pavardė: <input class="order-option" type="text"></p>
					<p>E. Paštas: <input class="order-option" type="text"></p>
					<p>Gyvenamoji vieta: <input class="order-option" type="text"></p>
					<p class="underline">Užsakymo informacija:</p>
					<p>
						Spalva:
						<select class="order-option" name="spalva">
							<option value="juoda">Juoda</option>
							<option value="balta">Balta</option>
						</select>
					</p>
					<p>
						Operatyvinė atmintis (RAM):
						<select class="order-option" name="ram">
							<option value="16gb">16 GB</option>
							<option value="32gb">32 GB</option>
							<option value="64gb">64 GB</option>
							<option value="128gb">128 GB</option>
						</select>
					</p>
					<p>
						SSD diskas:
						<select class="order-option" name="ssd">
							<option value="128 GB">128 GB</option>
							<option value="256 GB">256 GB</option>
							<option value="512 GB">512 GB</option>
							<option value="1 TB">1 TB</option>
							<option value="2 TB">2 TB</option>
						</select>
					</p>
					<p>
						Standusis diskas:
						<select class="order-option" name="hdd">
							<option value="1 TB">1 TB</option>
							<option value="2 TB">2 TB</option>
							<option value="4 TB">4 TB</option>
							<option value="8 TB">8 TB</option>
						</select>
					</p>
					
					<p>
						Vaizdo plokštė:
						<select class="order-option" name="gpu">
								<option value="GTX 1080">GTX 1080</option>
								<option value="GTX 1080Ti">GTX 1080Ti</option>
								<option value="TITAN Xp">TITAN Xp</option>
								<option value="RTX 2080">RTX 2080</option>
								<option value="RTX 2080Ti">RTX 2080Ti</option>
								<option value="AMD RX 580X">AMD RX 580X</option>
								<option value="AMD RX 570X">AMD RX 570X</option>
						</select>
					</p>
					<p>
						Procesorius:
						<select class="order-option" name="cpu">
								<option value="Ryzen 7 2700X">Ryzen 7 2700X</option>
								<option value="Threadripper 2950X">Threadripper 2950X</option>
								<option value="Intel Core i5-7600K">Intel Core i5-7600K</option>
								<option value="Intel Core i7-7820X">Intel Core i7-7820X</option>
								<option value="Intel Core i9-7980XE">Intel Core i9-7980XE</option>
						</select>
					</p>
					<input class="order-option" type="submit" value="Siūsti užsakymą">
				</form>
			</div>
		</div>
	</body>
	
	

</html>
