<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			bejegyzesek
		WHERE
			idBejegyzes = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idBejegyzes = $sor['idBejegyzes'];
		$idProjektNr = $sor['idProjektNr'];
		$bejegyzes = $sor['bejegyzes'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idBejegyzes 
		FROM 
			bejegyzesek 
		ORDER BY 
			idBejegyzes 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idBejegyzes = $sor['idBejegyzes'] + 1;
		$idProjektNr = '';
		$bejegyzes = '';	
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Bejegyzés
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
		<p class="cim">Bejegyzés
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=bejegyzesek" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idBejegyzes; ?></td>
				</tr>
				
				<tr class="sorok" >
					<td> Projekt Sorszám:</td>
					<td> <input type="text" name="idProjektNr" value="<?php echo $idProjektNr; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Bejegyzés:</td>
					<td> <input type="text" name="bejegyzes" value="<?php echo $bejegyzes; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idBejegyzes" /> ';
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