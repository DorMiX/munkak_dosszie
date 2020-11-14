<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			eszkozok
		WHERE
			idEszkozNr = ' . $_GET['id'];
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idEszkozNr = $sor['idEszkozNr'];
		$idEszkoz = $sor['idEszkoz'];
		$nvEszkoz = $sor['nvEszkoz'];
		$gyarto = $sor['gyarto'];
		$tipus = $sor['tipus'];
		$gysz = $sor['gysz'];
		$allapot = $sor['allapot'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idEszkozNr 
		FROM 
			eszkozok 
		ORDER BY 
			idEszkozNr 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idEszkozNr = $sor['idEszkozNr'] + 1;
		$idEszkoz = '';
		$nvEszkoz = '';
		$gyarto = '';
		$tipus = '';
		$gysz = '';
		$allapot = '';		
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Eszköz 
			<?php 
				switch ($_GET['action']) {
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
		<p class="cim">Eszköz
			<?php 
				switch ($_GET['action']) {
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=eszkozok" method="post">
			<table>
				<tr class="sorok" >
					<td> Eszköz Sorszám:</td>
					<td> <?php echo $idEszkozNr; ?> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <input type="text" name="idEszkoz" value="<?php echo $idEszkoz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Eszköz név:</td>
					<td> <input type="text" name="nvEszkoz" value="<?php echo $nvEszkoz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Gyártó:</td>
					<td> <input type="text" name="gyarto" value="<?php echo $gyarto; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Típus:</td>
					<td> <input type="text" name="tipus" value="<?php echo $tipus; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td>Gyári szám:</td>
					<td> <input type="text" name="gysz" value="<?php echo $gysz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >	
					<td> Állapot:</td>
					<td> 
						<?php
							if ($_GET['action'] == 'edit') {
								$lekerdezes = 'SELECT
									nvAllapot
								FROM
									eszkozok, allapotok
								WHERE
									allapot = idAllapot AND 
									idEszkozNr =' . $_GET['id'];
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = $sor['nvAllapot'];
								echo $allapot; 
							}
							else {	
								echo '<select name="allapot">';
								$lekerdezes = 'SELECT
									idAllapot, nvAllapot
								FROM
									allapotok
								ORDER BY
									idAllapot';
								$talalat = $adatbazis->query($lekerdezes);
								while ($sor = $talalat->fetch_assoc()) {
									if ($sor['idAllapot'] == $allapot) {
										echo '<option value="' . $sor['idAllapot'] . '" selected="selected"> ';
									} 
									else {
										echo '<option value="' . $sor['idAllapot'] . '">';
									}
									echo $sor['nvAllapot'] . '</option>';
								}
								echo '</select>';
							}
						?>
					</td>
				</tr> 
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idEszkozNr" /> ';
							}
						?>
						<input type="submit" name="submit" value="<?php 
								switch ($_GET['action']) {
									case 'add':
										echo "Hozzáadás";
										break;
									case 'edit':
										echo "Módosítás";
										break;
								}
							?> " />
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>