<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {
		//felhasználók tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			munkakorok
		WHERE
			idMunkakor = ' . $_GET['id'];
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idMunkakor = $sor['idMunkakor'];
		$nvMunkakor = $sor['nvMunkakor'];
		$allapot = $sor['allapot'];
	}
	else {
		//üres lap beállítása
		$lekerdezes = 'SELECT 
			idMunkakor 
		FROM 
			munkakorok 
		ORDER BY 
			idMunkakor 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idMunkakor = $sor['idMunkakor'] + 1;
		$nvMunkakor = '';
		$allapot = '';		
	}
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Munkakör
			<?php 
				switch ($_GET['action'])
				{
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
		<p class="cim">Munkakör
			<?php 
				switch ($_GET['action'])
				{
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=munkakorok" method="post">
			<table>
				<tr class="sorok" >
					<td> Azonosító:</td>
					<td> <?php echo $idMunkakor; ?></td>
				</tr>
				
				<tr class="sorok" >
					<td> Név:</td>
					<td> <input type="text" name="nvMunkakor" value="<?php echo $nvMunkakor; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >	
					<td> Állapot:</td>
					<td> 
						<?php
							if ($_GET['action'] == 'edit') {
								$lekerdezes = 'SELECT
									nvAllapot
								FROM
									munkakorok, allapotok
								WHERE
									allapot = idAllapot AND 
									idMunkakor =' . $_GET['id'];
							
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = $sor['nvAllapot'];
								echo $allapot; 
							}
							else {	
								echo '<select name="allapot">';
								
								// 
									$lekerdezes = 'SELECT
										idAllapot, nvAllapot
									FROM
										allapotok
									ORDER BY
										idAllapot';
									$talalat = $adatbazis->query($lekerdezes);
								// 
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
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idMunkakor" /> ';
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