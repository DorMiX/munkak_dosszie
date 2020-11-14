<?php
	require_once("php/konfig.php");
	require_once("php/fgv.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Admin &rarr; TIB-k</title>
		<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<p class="cim">Adminisztráció &rarr; <b>T</b>eljesítés<b>I</b>gazolási <b>B</b>izonylatok tábla</p>
	</header>
	<body>
		<table>
			<tr>
				<th>TeljesítésIgazolási Bizonylatok <a class="button-link" href="tibek.php?action=add"> HOZZÁADÁS </a> </th>
			</tr>
			<?php tablazat_listazas($_GET['type']);	?>
		</table>
	</body>
</html>