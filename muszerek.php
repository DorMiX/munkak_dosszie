<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			muszerek
		WHERE
			idMuszerNr = ' . $_GET['id'];
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idMuszerNr = $sor['idMuszerNr'];
		$idMuszer = $sor['idMuszer'];
		$nvMuszer = $sor['nvMuszer'];
		$gyarto = $sor['gyarto'];
		$tipus = $sor['tipus'];
		$gysz = $sor['gysz'];
		$kalbiz = $sor['kalbiz'];
		$kaldatum = $sor['kaldatum'];
		$kalerv = $sor['kalerv'];
		$allapot = $sor['allapot'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idMuszerNr 
		FROM 
			muszerek 
		ORDER BY 
			idMuszerNr 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idMuszerNr = $sor['idMuszerNr'] + 1;
		$idMuszer = '';
		$nvMuszer = '';
		$gyarto = '';
		$tipus = '';
		$gysz = '';
		$kalbiz = '';
		$kaldatum = '';
		$kalerv = '';
		$allapot = '';		
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Műszer 
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
		<p class="cim">Műszer
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=muszerek" method="post">
			<table>
				<tr class="sorok" >
					<td> Műszer Sorszám:</td>
					<td> <?php echo $idMuszerNr; ?> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <input type="text" name="idMuszer" value="<?php echo $idMuszer; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Műszer név:</td>
					<td> <input type="text" name="nvMuszer" value="<?php echo $nvMuszer; ?>"/> </td>
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
					<td> Kalibrálási bizonyítvány:</td>
					<td> <input type="text" name="kalbiz" value="<?php echo $kalbiz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Kalibrálási dátum:</td>
					<td> <input type="text" name="kaldatum" value="<?php echo $kaldatum; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Kalibrálás érvényessége:</td>
					<td> <input type="text" name="kalerv" value="<?php echo $kalerv; ?>"/> </td>
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
									idEszkoz =' . $_GET['id'];
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idMuszerNr" /> ';
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