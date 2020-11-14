<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			prjtipusok
		WHERE
			idPrjTipus = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idPrjTipus = $sor['idPrjTipus'];
		$nvPrjTipus = $sor['nvPrjTipus'];
		$allapot = $sor['allapot'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idPrjTipus 
		FROM 
			prjtipusok 
		ORDER BY 
			idPrjTipus 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = mysqli_fetch_array($talalat);
		$idPrjTipus = $sor['idPrjTipus'] + 1;
		$nvPrjTipus = '';
		$allapot = '';	
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Projekt típus 
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
		<p class="cim">Projekt típus
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=prjtipusok" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idPrjTipus; ?></td>
				</tr>
				
				<tr class="sorok" >
					<td> Név:</td>
					<td> <input type="text" name="nvPrjTipus" value="<?php echo $nvPrjTipus; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >	
					<td> Állapot:</td>
					<td> 
						<?php
							if ($_GET['action'] == 'edit') {
								$lekerdezes = 'SELECT
									nvAllapot
								FROM
									prjtipusok, allapotok
								WHERE
									allapot = idAllapot AND 
									idPrjTipus =' . $_GET['id'];
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idPrjTipus" /> ';
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