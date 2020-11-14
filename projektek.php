<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			projektek
		WHERE
			idProjektNr = ' . $_GET['id'];
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idProjektNr = $sor['idProjektNr'];
		$idProjekt = $sor['idProjekt'];
		$nvProjekt = $sor['nvProjekt'];
		$prjtipus = $sor['prjtipus'];
		$letrehozas = $sor['letrehozas'];
		$letrehozo = $sor['letrehozo'];
		$leiras = $sor['leiras'];
		$ceg = $sor['ceg'];
		$kezdete = $sor['kezdete'];
		$vege = $sor['vege'];
		$ajanlatkell = $sor['ajanlatkell'];
		$megrendelve = $sor['megrendelve'];
		$dokukesz = $sor['dokukesz'];
		$advekesz = $sor['advekesz'];
		$tibkesz = $sor['tibkesz'];
		$szamlazva = $sor['szamlazva'];
		$utoelet = $sor['utoelet'];
		$ellenorzojel = $sor['ellenorzojel'];
		$allapot = $sor['allapot'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idProjektNr 
		FROM 
			projektek 
		ORDER BY 
			idProjektNr 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idProjektNr = $sor['idProjektNr'] + 1;
		$idProjekt = '';
		$nvProjekt = '';
		$prjtipus = '';
		$letrehozas = '';
		$letrehozo = '';
		$leiras = '';
		$ceg = '';
		$kezdete = '';
		$vege = '';
		$ajanlatkell = '';
		$megrendelve = '';
		$dokukesz = '';
		$advekesz = '';
		$tibkesz = '';
		$szamlazva = '';
		$utoelet = '';
		$ellenorzojel = '';	
		$allapot = '';
		
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Projekt 
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
		<p class="cim">Projekt
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=projektek" method="post">
			<table>
				<tr class="sorok" >
					<td> Projekt Sorszám:</td>
					<td> <?php echo $idProjektNr; ?> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <input type="text" name="idProjekt" value="<?php echo $idProjekt; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Projekt név:</td>
					<td> <input type="text" name="nvProjekt" value="<?php echo $nvProjekt; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Projekt típus:</td>
					<td> <input type="text" name="prjtipus" value="<?php echo $prjtipus; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Létrehozás:</td>
					<td> <input type="text" name="letrehozas" value="<?php echo $letrehozas; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Létrehozó:</td>
					<td> <input type="text" name="letrehozo" value="<?php echo $letrehozo; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td>Leírás:</td>
					<td> <input type="text" name="leiras" value="<?php echo $leiras; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Cég:</td>
					<td> <input type="text" name="ceg" value="<?php echo $ceg; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Kezdés:</td>
					<td> <input type="text" name="kezdete" value="<?php echo $kezdete; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Határidő:</td>
					<td> <input type="text" name="vege" value="<?php echo $vege; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Ajánlat kell?</td>
					<td> <input type="text" name="ajanlatkell" value="<?php echo $ajanlatkell; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Megrendelve?</td>
					<td> <input type="text" name="megrendelve" value="<?php echo $megrendelve; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Dokumentum kész?</td>
					<td> <input type="text" name="dokukesz" value="<?php echo $dokukesz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Átadás-Átvételi kész?</td>
					<td> <input type="text" name="advekesz" value="<?php echo $advekesz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> TIB kész?</td>
					<td> <input type="text" name="tibkesz" value="<?php echo $tibkesz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Számlázva?</td>
					<td> <input type="text" name="szamlazva" value="<?php echo $szamlazva; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Utóélet:</td>
					<td> <input type="text" name="utoelet" value="<?php echo $utoelet; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Ellenőrző jel:</td>
					<td> <input type="text" name="ellenorzojel" value="<?php echo $ellenorzojel; ?>"/> </td>
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idProjektNr" /> ';
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