<?php
	require_once("php/konfig.php");
	require_once("php/fgv.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Admin &rarr; Ajánlat </title>
		<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<p class="cim">Adminisztráció &rarr; Ajánlatok tábla</p>
	</header>
	<body>
		<table>
			<tr>
				<th>Ajánlatok <a class="button-link" href="ajanlatok.php?action=add"> HOZZÁADÁS </a> </th>
			</tr>
			<?php tablazat_listazas($_GET['type']);	?>
		</table>
	</body>
</html>