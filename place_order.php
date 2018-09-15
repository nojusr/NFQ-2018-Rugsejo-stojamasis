<?php
	
	include 'config.php';

	#  if everything is set
	if (isset($_POST['name'], $_POST['surname'], $_POST['email'],
		$_POST['addr'], $_POST['color'], $_POST['ram'], $_POST['ssd'],
		$_POST['hdd'], $_POST['gpu'], $_POST['cpu'])) {
		
		# connect to db
		try {
			$conn = new pdo($dsn, $dbuser, $dbpass, $dboptions);
		}catch (PDOException $e){
			die("Duombazes klaida: ".$e->getMessage());
		}
		
		# i dislike how long the query is, but i cannot do much about 
		# it, not unless i decide to switch to multiple tables.
		
		
		# secure insertion
		$stmt = $conn->prepare( 'INSERT INTO `orders` 
								(`name`, `surname`, `email`, `address`,
								`color`, `ram`, `ssd`, `hdd`, `gpu`, `cpu`)
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
		
		if ($stmt == false){
			die("Nepavyko uzsakyti: ".$conn->error);
		}

		$stmt->bindParam(1, $_POST['name']);
		$stmt->bindParam(2, $_POST['surname']);
		$stmt->bindParam(3, $_POST['email']);
		$stmt->bindParam(4, $_POST['addr']);
		$stmt->bindParam(5, $_POST['color']);
		$stmt->bindParam(6, $_POST['ram']);
		$stmt->bindParam(7, $_POST['ssd']);
		$stmt->bindParam(8, $_POST['hdd']);
		$stmt->bindParam(9, $_POST['gpu']);
		$stmt->bindParam(10, $_POST['cpu']);
		$check = $stmt->execute();
		
		if ($check == false){
			die("Nepavyko uzsakyti: ".$stmt->error);
		}
		
		$stmt=null;
		$conn=null;
		echo "Užsakymas išsiųstas";
	}
	header("Location: http://submission.kelp.ml/?noinit=true");
	die();
?>
