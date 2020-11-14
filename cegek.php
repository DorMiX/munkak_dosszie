<?php
	require_once("php/konfig.php");
	
	if ($_GET['action'] == 'edit') {//cégek tábla lekérdezése
		$lekerdezes = 'SELECT
			*
		FROM
			cegek
		WHERE
			idCeg = "' . $_GET['id'] . '"';
			
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idCeg = $sor['idCeg'];
		$nvCeg = $sor['nvCeg'];
		$cegteljesnev = $sor['cegteljesnev'];
		$irsz = $sor['irsz'];
		$telepules = $sor['telepules'];
		$cim = $sor['cim'];
		$agazat = $sor['agazat'];
	}
	else {//üres lap beállítása
		$lekerdezes = 'SELECT 
			idCeg 
		FROM 
			cegek 
		ORDER BY 
			idCeg 
		DESC LIMIT 1';
		$talalat = $adatbazis->query($lekerdezes);
		$sor = $talalat->fetch_assoc();
		$idCeg = $sor['idCeg'] + 1;
		$nvCeg = '';
		$cegteljesnev = '';
		$irsz = '';
		$telepules = '';
		$cim = '';
		$agazat = '';
	}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" lang="hu"/>
		
		<title> Cég 
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
		<p class="cim">Cég
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=cegek" method="post">
			<table>
				<tr class="sorok" >
					<td> Cég ID:</td>
					<td> <?php echo $idCeg; ?> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Cég rövid neve:</td>
					<td> <input type="text" name="nvCeg" value="<?php echo $nvCeg; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Cég teljesneve:</td>
					<td> <input type="text" name="cegteljesnev" value="<?php echo $cegteljesnev; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Irsz:</td>
					<td> <input type="text" name="irsz" value="<?php echo $irsz; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Település:</td>
					<td> <input type="text" name="telepules" value="<?php echo $telepules; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Cím:</td>
					<td> <input type="text" name="cim" value="<?php echo $cim; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td> Ágazat:</td>
					<td> <input type="text" name="agazat" value="<?php echo $agazat; ?>"/> </td>
				</tr>
				
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="idCeg" /> ';
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