<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			xcsop_jog
		WHERE
			idCsoport = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idCsoport = $sor['idCsoport'];
		$idJog = $sor['idJog'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idCsoport 
		FROM 
			xcsop_jog 
		ORDER BY 
			idCsoport 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idCsoport = '';
		$idJog = '';	
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Csoport-Jog kereszthivatkozás
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
		<p class="cim">Csoport-Jog kereszthivatkozás
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=xcsop_jog" method="post">
			<table>
				<tr class="sorok" >
					<td> Csoport ID:</td>
					<td> <input type="text" name="idCsoport" value="<?php echo $idCsoport; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Jog ID:</td>
					<td> <input type="text" name="idJog" value="<?php echo $idJog; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idCsoport" /> ';
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