<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			xproj_alkm
		WHERE
			idProjektNr = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idProjektNr = $sor['idProjektNr'];
		$idFelhasznalo = $sor['idFelhasznalo'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idProjektNr 
		FROM 
			xproj_alkm 
		ORDER BY 
			idProjektNr 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idProjektNr = '';
		$idFelhasznalo = '';	
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Projekt-Alkalmazott kereszthivatkozás
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
		<p class="cim">Projekt-Alkalmazott kereszthivatkozás
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=xproj_alkm" method="post">
			<table>
				<tr class="sorok" >
					<td> Projekt ID:</td>
					<td> <input type="text" name="idProjektNr" value="<?php echo $idProjektNr; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Felhasználó ID:</td>
					<td> <input type="text" name="idFelhasznalo" value="<?php echo $idFelhasznalo; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idMinUgyJegyzet" /> ';
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