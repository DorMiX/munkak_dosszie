<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			jogok
		WHERE
			idJog = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idJog = $sor['idJog'];
		$nvJog = $sor['nvJog'];
		$allapot = $sor['allapot'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idJog 
		FROM 
			jogok 
		ORDER BY 
			idJog 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idJog = $sor['idJog'] + 1;
		$nvJog = '';
		$allapot = '';		
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Jogok 
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
		<p class="cim">Csoport
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=jogok" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idJog; ?></td>
				</tr>
				
				<tr class="sorok" >
					<td> Név:</td>
					<td> <input type="text" name="nvJog" value="<?php echo $nvJog; ?>"/> </td>
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
									allapot = idAllapot AND 
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
								while ($sor = mysqli_fetch_array($talalat)) {
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idJog" /> ';
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