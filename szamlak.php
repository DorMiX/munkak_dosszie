<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			szamlak
		WHERE
			idSzamlaNr = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idSzamlaNr = $sor['idSzamlaNr'];
		$idSzamla = $sor['idSzamla'];
		$idProjektNr = $sor['idProjektNr'];
		$eutvonal = $sor['eutvonal'];
		$efajlnev = $sor['efajlnev'];
		$tutvonal = $sor['tutvonal'];
		$tfajlnev = $sor['tfajlnev'];
		$tlink = $sor['tlink'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idSzamlaNr 
		FROM 
			szamlak 
		ORDER BY 
			idSzamlaNr 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idSzamlaNr = $sor['idSzamlaNr'] + 1;
		$idSzamla = '';
		$idProjektNr = '';
		$eutvonal = '';
		$efajlnev = '';
		$tutvonal ='';
		$tfajlnev = '';
		$tlink = '';
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title>Ajánlat 
			<?php 
				switch ($_GET['action']) { //lapfül kiírása
					case 'add':
						echo " hozzáadása";
						break;
					case 'edit':
						echo " módosítása";
						break;
				}
			?>
		</title>
		<link rel="stylesheet" href="css/table_list.css" />
	</head>
	<header>
		<p class="cim">Ajánlat
			<?php 
				switch ($_GET['action']) { //fejléc
					case 'add':
						echo " hozzáadása";
						break;
					case 'edit':
						echo " módosítása";
						break;
				}
			?>
		</p>
	</header>
	
	<body>
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=szamlak" method="post">
			<table>
				<tr class="sorok" >
					<td> Ajánlat sorszáma:</td>
					<td> <?php echo $idSzamlaNr; ?></td>
				</tr>
				
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <input type="text" name="idSzamla" value="<?php echo $idSzamla; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td> Projekt sorszáma:</td>
					<td> <input type="text" name="idProjektNr" value="<?php echo $idProjektNr; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td> Eredeti útvonal:</td>
					<td> <input type="text" name="eutvonal" value="<?php echo $eutvonal; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td> Eredeti fájlnév:</td>
					<td> <input type="text" name="efajlnev" value="<?php echo $efajlnev; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td>Tárolt útvonal:</td>
					<td> <input type="text" name="tutvonal" value="<?php echo $tutvonal; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td>Tárolt fájlnév:</td>
					<td> <input type="text" name="tfajlnev" value="<?php echo $tfajlnev; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td> Teljes link:</td>
					<td> <input type="text" name="tlink" value="<?php echo $tlink; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idSzamlaNr" /> ';
							}
						?>
						<input type="submit" name="submit" value="
							<?php 
								switch ($_GET['action']) {
									case 'add':
										echo "Hozzáadás";
										break;
									case 'edit':
										echo "Módosítás";
										break;
								}
							?> "/>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>