<?php
	
	include 'config.php';

	#  if everything is set
	if (isset($_POST['name'], $_POST['surname'], $_POST['email'],
		$_POST['addr'], $_POST['color'], $_POST['ram'], $_POST['ssd'],
		$_POST['hdd'], $_POST['gpu'], $_POST['cpu'])) {
		
		# connect to db
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error){
			die("Duombazes klaida: ". $conn->connect_error);
		}
		
		# i dislike how long the queries are, but i cannot do much about 
		# it, not unless i decide to switch to multiple tables.
		
		
		# secure insertion
		$stmt = $conn->prepare( 'INSERT INTO `orders` 
								(`name`, `surname`, `email`, `address`,
								`color`, `ram`, `ssd`, `hdd`, `gpu`, `cpu`)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
		
		if ($stmt == false){
			die("Nepavyko uzsakyti: ".$conn->error);
		}

		$stmt->bind_param("ssssssssss", 
						$_POST['name'], $_POST['surname'], $_POST['email'],
						$_POST['addr'], $_POST['color'], $_POST['ram'],
						$_POST['ssd'], $_POST['hdd'], $_POST['gpu'], $_POST['cpu']);
		
		$check = $stmt->execute();
		
		if ($check == false){
			die("Nepavyko uzsakyti: ".$stmt->error);
		}
		
		$stmt->close();
		$conn->close();
		echo "Užsakymas išsiųstas";
	}
	header("Location: http://192.168.1.130:2015/?noinit=true");
	die();
?>
