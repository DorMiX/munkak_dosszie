

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title> Admin &rarr; Csoportok </title>
		<link rel="stylesheet" href="css/table_list.css" />		
		<?php
			require_once("php/konfig.php");
			require_once("php/fgv.php");
		?>
	</head>
	<header>
		<p class="cim">Adminisztráció &rarr; Csoportok tábla</p>
	</header>
	<body>
		<table>
			<tr>
				<th> Csoportok <a class="button-link" href="csoportok.php?action=add"> HOZZÁADÁS </a> </th>
			</tr>
			<?php tablazat_listazas($_GET['type']); ?>
		</table>
	
	
	</body>
</html>