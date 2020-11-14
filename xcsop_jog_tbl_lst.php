<?php
	require_once("php/konfig.php");
	require_once("php/fgv.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Admin &rarr; Projekt Típus</title>
		<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<p class="cim">Adminisztráció &rarr; Projekt típusok tábla</p>
	</header>
	<body>
		<table>
			<tr>
				<th>Projekt típusok <a class="button-link" href="xcsop_jog.php?action=add"> HOZZÁADÁS </a> </th>
			</tr>
			<?php tablazat_listazas($_GET['type']);	?>
		</table>
	</body>
</html>