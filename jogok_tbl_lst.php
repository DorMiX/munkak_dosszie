<!DOCTYPE html>

<html lang="hu">
	<head>
		<?php
			require_once("php/konfig.php");
			require_once("php/fgv.php");
		?>
		<meta charset="UTF-8">
		<title> Admin &rarr; Jogok </title>
		<link rel="stylesheet" href="css/table_list.css" />	
	</head>
	<header>
		<p class="cim">Adminisztráció &rarr; Jogok tábla</p>
	</header>
	<body>
		
		<table>
			<tr>
				<th> Jogok <a class="button-link" href="jogok.php?action=add"> HOZZÁADÁS </a> </th>
			</tr>
			<?php tablazat_listazas($_GET['type']); ?>
		</table>
	</body>
</html>