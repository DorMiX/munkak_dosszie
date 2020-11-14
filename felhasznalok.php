<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			felhasznalok
		WHERE
			idFelhasznalo = ' . $_GET['id'];
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idFelhasznalo = $sor['idFelhasznalo'];
		$nvFelhasznalo = $sor['nvFelhasznalo'];
		$nvEmail = $sor['nvEmail'];
		$csoport = $sor['csoport'];
		$jelszo = $sor['jelszo'];
		$teljesnev = $sor['teljesnev'];
		$munkakor = $sor['munkakor'];
		$mobil = $sor['mobil'];
		$allapot = $sor['allapot'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idFelhasznalo 
		FROM 
			felhasznalok 
		ORDER BY 
			idFelhasznalo 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idFelhasznalo = $sor['idFelhasznalo'] + 1;
		$nvFelhasznalo = '';
		$nvEmail = '';
		$csoport = '';
		$jelszo = '';
		$teljesnev = '';
		$munkakor = '';
		$mobil = '';
		$allapot = '';		
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Felhasználó 
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
		<p class="cim">Felhasználó
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=felhasznalok" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idFelhasznalo; ?> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Felhasználó név:</td>
					<td> <input type="text" name="nvFelhasznalo" value="<?php echo $nvFelhasznalo; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> E-mail:</td>
					<td> <input type="text" name="nvEmail" value="<?php echo $nvEmail; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td>Csoport:</td>
					<td> <input type="text" name="csoport" value="<?php echo $csoport; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Jelszó:</td>
					<td> <input type="text" name="jelszo" value="<?php echo $jelszo; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Teljesnév:</td>
					<td> <input type="text" name="teljesnev" value="<?php echo $teljesnev; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Munkakör:</td>
					<td> <input type="text" name="munkakor" value="<?php echo $munkakor; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Mobil:</td>
					<td> <input type="text" name="mobil" value="<?php echo $mobil; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >	
					<td> Állapot:</td>
					<td> 
						<?php
							if ($_GET['action'] == 'edit') {
								$lekerdezes = 'SELECT
									nvAllapot
								FROM
									felhasznalok, allapotok
								WHERE
									allapot = idAllapot AND 
									idFelhasznalo =' . $_GET['id'];
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idFelhasznalo" /> ';
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