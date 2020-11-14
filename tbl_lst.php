<!DOCTYPE html>
<?php
	require_once("php/konfig.php");
	require_once("php/fgv.php");
?>


<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title> 
			<?php 
				//title beállítása
				//include("title.php"); 
				tabla_nev_kiiras($_GET['type']);
				echo ' lista';
			?>
		</title>
		<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<p>
			<?php 
				//fejléc beállítása
				//require("header.php"); 
				tabla_nev_kiiras($_GET['type']);
				echo ' lista';
			?>
		</p>
	</header>
	<body>
		<table>
			<tr>
				<th>
				<?php 
					//táblázat fejléc beállítása
					//require("tbl_header.php");
				?>
				</th>
				<th> 
					<?php //lehet-e hozzáadni?
						if (($_GET['type'] != "allapotok") and ($_GET['type'] != "igennem")) {
							echo '<a class="button-link" href="visualization.php?type=';
							echo $_GET['type'];
							echo '&action=add"> HOZZÁADÁS </a>';
						}
					?>
				</th>
			</tr>
			<?php tablazat_listazas($_GET['type']); ?>
		</table>
	</body>
</html>