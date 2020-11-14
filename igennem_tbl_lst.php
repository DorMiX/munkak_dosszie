<?php
	require_once("php/konfig.php");
	require_once("php/fgv.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Admin &rarr; Igen/Nem</title>
		<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<p class="cim">Adminisztráció &rarr; Igen/Nem tábla</p>
	</header>
	<body>
		<table>
			<tr>
				<th>Igen/Nem <!--<a class="button-link" href="allapot.php?action=add"> HOZZÁADÁS </a>--> </th>
			</tr>
			<?php tablazat_listazas($_GET['type']);	?>
		</table>
	</body>
</html>