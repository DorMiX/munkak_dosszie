<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			partnerek
		WHERE
			idPartner = ' . $_GET['id'];
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idPartner = $sor['idPartner'];
		$nvCeg = $sor['nvCeg'];
		$teljesnev = $sor['teljesnev'];
		$beosztas = $sor['beosztas'];
		$reszleg = $sor['reszleg'];
		$email = $sor['email'];
		$mobil = $sor['mobil'];
		$allapot = $sor['allapot'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idPartner 
		FROM 
			partnerek 
		ORDER BY 
			idPartner 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idPartner = $sor['idPartner'] + 1;
		$nvCeg = '';
		$teljesnev = '';
		$beosztas = '';
		$reszleg = '';
		$email = '';
		$mobil = '';
		$allapot = '';		
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Partner 
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
		<p class="cim">Partner
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=partnerek" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idPartner; ?> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Cég kódnév:</td>
					<td> <input type="text" name="nvCeg" value="<?php echo $nvCeg; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Teljesnév:</td>
					<td> <input type="text" name="teljesnev" value="<?php echo $teljesnev; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Beosztás:</td>
					<td> <input type="text" name="beosztas" value="<?php echo $beosztas; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Részleg:</td>
					<td> <input type="text" name="reszleg" value="<?php echo $reszleg; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> E-mail:</td>
					<td> <input type="text" name="email" value="<?php echo $email; ?>"/> </td>
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
									jogok, allapotok
								WHERE
									jogok.allapot = idAllapot AND 
									idJog =' . $_GET['id'];
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idPartner" /> ';
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