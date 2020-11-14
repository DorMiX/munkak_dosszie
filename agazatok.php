<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			agazatok
		WHERE
			idAgazat = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idAgazat = $sor['idAgazat'];
		$nvAgazat = $sor['nvAgazat'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idAgazat 
		FROM 
			agazatok 
		ORDER BY 
			idAgazat 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idAgazat = $sor['idAgazat'] + 1;
		$nvAgazat = '';
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Ágazatok 
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
		<p class="cim">Csoport
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=agazatok" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idAgazat; ?></td>
				</tr>
				
				<tr class="sorok" >
					<td> Név:</td>
					<td> <input type="text" name="nvAgazat" value="<?php echo $nvAgazat; ?>"/> </td>
				</tr>
				
				 
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idAgazat" /> ';
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