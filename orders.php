<html>
	<?php
	# init
	include 'config.php';
	
		# connect to db
		try {
			$conn = new pdo($dsn, $dbuser, $dbpass, $dboptions);
		}catch (PDOException $e){
			die("Duombazes klaida: ".$e->getMessage());
		}
	
	?>
	
	
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php 
			# check if no init animation is needed
			if(isset($_GET['noinit'])) {
				echo "<link rel='stylesheet' href='css/global_noanim.css'>";
			}else{
				echo "<link rel='stylesheet' href='css/global.css'>";
			}
		?>
		<title>NR-Kompiuteriai</title>
	</head>
	<body>
		<?php
			# unset noinit since we don't want our URL to be full of the same variable
			unset($_GET['noinit']);
			
			# variables for indicating sorting type
			$orderby_info = "Rikiuojama pagal ";
		
			# URL parsing into prepared SQL statement
			
			$query = "SELECT * FROM orders ";#starting query
			
			# search
			if (isset($_GET['squery'], $_GET['stype']) && $_GET['squery'] != "") {
				$squery = $_GET["squery"];
				switch ($_GET['stype']) {
					case 'all':
						$query .= "WHERE CONCAT(name, '', surname, '', address, '', email, '', color, '', ram, '', ssd, '', hdd, '', gpu, '', cpu) LIKE :s ";
						break;
					case 'name':
						$query .= "WHERE name LIKE :s ";
						break;
					case 'surname':
						$query .= "WHERE surname LIKE :s ";
						break;
					case 'location':
						$query .= "WHERE address LIKE :s ";
						break;
					case 'email':
						$query .= "WHERE email LIKE :s ";
						break;
					case 'color':
						$query .= "WHERE color LIKE :s ";
						break;
					case 'ram':
						$query .= "WHERE ram LIKE :s ";
						break;
					case 'ssd':
						$query .= "WHERE ssd LIKE :s ";
						break;
					case 'hdd':
						$query .= "WHERE hdd LIKE :s ";
						break;
					case 'gpu':
						$query .= "WHERE gpu LIKE :s ";
						break;
					case 'cpu':
						$query .= "WHERE cpu LIKE :s ";
						break;
				}
				
				
			}
			
			# sorting
			if (isset ($_GET['orderby'])) {
				switch($_GET['orderby']) {
					case 'name':
						$query .= "ORDER BY name ";
						$orderby_info .= "vardą ";
						break;
						
					case 'surname':
						$query .= "ORDER BY surname ";
						$orderby_info .= "pavardę ";
						break;
					case 'location':
						$query .= "ORDER BY address ";
						$orderby_info .= "gyvenvietę ";
						break;
					case 'email':
						$query .= "ORDER BY email ";
						$orderby_info .= "e. paštą ";
						break;
					case 'color':
						$query .= "ORDER BY color ";
						$orderby_info .= "spalvą ";
						break;
					case 'ram':
						$query .= "ORDER BY ram ";
						$orderby_info .= "RAM ";
						break;
					case 'ssd':
						$query .= "ORDER BY ssd ";
						$orderby_info .= "SSD ";
						break;
					case 'hdd':
						$query .= "ORDER BY hdd ";
						$orderby_info .= "HDD ";
						break;
					case 'gpu':
						$query .= "ORDER BY gpu ";
						$orderby_info .= "vaizdo plokštę ";
						break;
					case 'cpu':
						$query .= "ORDER BY cpu ";
						$orderby_info .= "procesorių ";
						break;
				}
			}
			
			
			# descending/ascending
			if (isset ($_GET['da'])) {
				if ($_GET['da']=='desc'){
					$query .= "DESC ";
					$orderby_info .= "mažėjančia tvarka";
				}else if ($_GET['da']=='asc') {
					$query .= "ASC ";
					$orderby_info .= "didėjančia tvarka";
				}
			}
			
			# paging (TEST THIS)
			
			# execute query with no limit in order to get full length
			$nolimit = $query.";";
			$stmt = $conn->prepare($nolimit);
			if (isset($_GET['squery'])) {
				$tmp = "%".$_GET['squery']."%";
				$stmt->bindParam(":s", $tmp);
			}
			$stmt->execute();
			
			# get full row count of query
			$count = $stmt->rowCount();
			
			#get final page count
			$pageamount = $count/$pagelength;
			
			# finish query assembly with correct paging
			$p1 = 0;
			if (isset ($_GET['page'])) {
				$p1 = $_GET['page']*$pagelength;
			}
			$query .="LIMIT ".$p1.",".$pagelength.";";
			
		?>
		
		<div class="order-init">
		
		</div>
		
		<div class="order-wrapper">
			<form class="search">
				<input name="squery" type="text" placeholder="Paieška..." <?php if(isset($_GET['squery'])) {echo "value='".$_GET['squery']."'";};?>>
				<select name="stype">
					<?php
						# this would've been much, MUCH cleaner if javascript was allowed
						$test = isset($_GET['stype']);
					?>
					<option value="all" disabled selected>Ieškoti pagal</option>
					<option <?php if($test==true && $_GET['stype']=="all"){ echo "selected"; }?> value="all">Viską</option>
					<option <?php if($test==true && $_GET['stype']=="name"){ echo "selected"; }?>  value="name">Vardą</option>
					<option <?php if($test==true && $_GET['stype']=="surname"){ echo "selected"; }?>  value="surname">Pavardę</option>
					<option <?php if($test==true && $_GET['stype']=="location"){ echo "selected"; }?>  value="location">Gyvenvietę</option>
					<option <?php if($test==true && $_GET['stype']=="email"){ echo "selected"; }?>  value="email">E. paštą</option>
					<option <?php if($test==true && $_GET['stype']=="ram"){ echo "selected"; }?>  value="ram">RAM</option>
					<option <?php if($test==true && $_GET['stype']=="ssd"){ echo "selected"; }?>  value="ssd">SSD</option>
					<option <?php if($test==true && $_GET['stype']=="hdd"){ echo "selected"; }?>  value="hdd">HDD</option>
					<option <?php if($test==true && $_GET['stype']=="gpu"){ echo "selected"; }?>  value="gpu">GPU</option>
					<option <?php if($test==true && $_GET['stype']=="cpu"){ echo "selected"; }?>  value="cpu">CPU</option>
				</select>
				
				<!--this makes the page animations dissapear upon submitting a search form -->
				<input type="checkbox" name="noinit" value="true" style="display: none;" checked>
				<input type="submit" value="Ieškoti">
			</form>
			<div class="order-seperator"></div>
			<div class="pages">
				<a href="/">Atgal</a>
				<p>Puslapiai:
				<?php
					# page output
					for ($i = 0; $i < $pageamount; $i++){
						echo "<a href='orders.php?noinit=true&".http_build_query($_GET)."&page=".$i."'>".($i+1)."</a> ";
					}
					
					# sorting info
					if (!isset($_GET['da']) && !isset($_GET['orderby'])){
						echo "<p>Spauskite ant bet kokios duomenų kolonos pavadinimo, jeigu norite rikiuoti</p>";
					}else{
						echo "<p>".$orderby_info."</p>";
					}
				?>
				</p>
			</div>
			<div class="data-container">
				<table class="data">
					<thead>
						<tr>
							<?php
								# preserve order settings
								if (isset($_GET['da'])) {
									$da = $_GET['da'];
								}
								if (isset($_GET['orderby'])) {
									$orderby = $_GET['orderby'];
								}
								unset($_GET['orderby'], $_GET['da']);
								
							?>
							
							<!--personally, i'm ashamed of this piece of code, but, right now, i don't know of a way it-->
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=name<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>Vardas</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=surname<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>Pavardė</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=location<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>Gyvenvietė</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=email<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>E. Paštas</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=color<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>Spalva</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=ram<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>RAM</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=ssd<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>SSD</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=hdd<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>HDD</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=gpu<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>GPU</a></td>
							<td><a href='/orders.php?noinit=true&<?php  echo http_build_query($_GET);?>&orderby=cpu<?php if (isset($da) && $da=='desc'){echo"&da=asc";}else{echo"&da=desc";}?>'>CPU</a></td>
							
							
							
						</tr>
					</thead>
					<?php
						
						# finish query assembly and output into table
						
						
						$stmt = $conn->prepare($query);
						if (isset($_GET['squery'])){
							$tmp = "%".$_GET['squery']."%";
							$stmt->bindParam(':s', $tmp);
						}
						$check = $stmt->execute();
						
						if ($check == false){
							die("išvesti nepavyko :( ".$stmt->error);
						}else if ($check == true){
							$output = $stmt->fetchAll();
							foreach($output as $row) {
								echo "<tr>
								<td>".$row['name']."</td>
								<td>".$row['surname']."</td>
								<td>".$row['address']."</td>
								<td>".$row['email']."</td>
								<td>".$row['color']."</td>
								<td>".$row['ram']."</td>
								<td>".$row['ssd']."</td>
								<td>".$row['hdd']."</td>
								<td>".$row['gpu']."</td>
								<td>".$row['cpu']."</td>
								</tr>";
							}
						}
						
						$stmt=null;
						$conn=null;
					?>
					
					
				</table>
			</div>
			
		</div>
		

	</body>
	
	

</html>
