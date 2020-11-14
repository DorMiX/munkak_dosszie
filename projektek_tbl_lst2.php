<?php
	require_once("php/konfig.php");
	require_once("php/fgv2.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php
			switch ($_GET['type']) {
				case 'projektek':
					echo '<title>Admin &rarr; Projekt</title>';
					break;
					
			}
		?>
		<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<?php
			switch ($_GET['type']) {
				case 'projektek':
					echo '<p class="cim">Adminisztráció &rarr; Projektek tábla</p>';
					break;
					
			}
		?>
	</header>
	<body>
		<table>
			<tr>
				<th>
				<?php
					switch ($_GET['type']) {
						case 'projektek':
							echo 'Projektek';
							break;
					
					}
				?>
				 <a class="button-link" href="projektek.php?action=add"> HOZZÁADÁS </a> </th>
			</tr>
			<?php tablazat_listazas2($_GET['type']); ?>
		</table>
	</body>
</html>