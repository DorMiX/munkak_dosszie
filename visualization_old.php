<!DOCTYPE html>
<?php
	require("php/konfig.php");
	require("php/fgv.php");
?>
<html lang="hu">
	<head>
		<meta charset="utf-8">
		
		<title>  
			<?php //title beállítása
				tabla_nev_kiiras($_GET['type']);
				
				switch ($_GET['action']) { //title típusa (add or edit)
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
		<p class="cim">
			<?php //header beállítása
				tabla_nev_kiiras($_GET['type']);
				
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
		<form action="commit.php?action=<?php echo $_GET['action']; ?>&type=<?php echo $_GET['type']; ?>" method="post">
			<table>
				<?php
					$idee = mysql_get_prim_key($_GET['type']);
					//echo $idee;
					switch ($_GET['type']) {//
						case 'xcsop_jog':
						case 'xproj_alkm':
							{
								;//üres
							}						
						default:
							if ($_GET['action'] == 'edit') {// tábla lekérdezése szerkesztésre
								$lekerdezes = "
									SELECT 
										* 
									FROM " 
										. $_GET['type'] . " 
									WHERE " 
										. $idee . " = " . $_GET['id'];
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
							}
							else { //üres lap beállítása hozzáadásra
								$lekerdezes = "
									SELECT 
										* 
									FROM " 
										. $_GET['type'] . " 
									ORDER BY " 
										. $idee . " DESC LIMIT 1";
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
							}
					}
					
					$vmi = tabla_mezok($_GET['type']); //visszatér egy tömbbel, ami a paraméterben megadott tábla mezőneveit tárolja
					for($i = 1; $i < (count($vmi)); $i++) {?>
					<tr class="sorok">
						<td>
							<?php oszlop_nev_kiiras($vmi[$i]); echo ":"; //a táblázat mezőneveihez társítja az xml-ben megadott nevet és kiírja a képernyőre azt ?>
						</td>
						<td>
							<?php 
								switch ($vmi[$i]) { //megnézi hogy az aktuális mező melyik / milyen típusú -->
									case $idee: //pl. ha az aktuális mező az PRIMARY_KEY (továbbiakban: PK) mező akkor -->
										switch ($_GET['type']) { //megnézi melyik tábláról van szó -->
											case 'xcsop_jog': //Csoportok Jogok keresztlista tábláról --#
												$leker = "
													SELECT
														idCsoport, nvCsoport
													FROM
														csoportok
													ORDER BY 
														idCsoport"; //lekérdezés létrehozása -->
												$talal = $adatbazis -> query($leker); //végrehajtja -->
												echo '<select name="idCsoportX">'; //legördülő menű nyit -->
												while ($sorok = $talal -> fetch_assoc()) { //popularize (LOL) -->
													echo '<option value="' . $sorok['idCsoport'] . '">';
													echo $sorok['nvCsoport']; //értelmezhető név
													echo '</option>';
												}
													echo '</select>'; //legördülő menű zár --#
											break; //ITT A VÉGE
											case 'xproj_alkm'://Projektek Alkalmazottak keresztlista tábláról --#
												$leker = "
													SELECT
														idProjektNr, idProjekt, nvProjekt
													FROM
														projektek
													ORDER BY 
														idProjektNr";
													$talal = $adatbazis -> query($leker);
												echo '<select name="idProjektNrX">';
												while ($sorok = $talal -> fetch_assoc()) { 
													echo '<option value="' . $sorok['idProjektNr'] . '">';
													echo $sorok['idProjekt'];
													echo '</option>';
												}
												echo '</select>';
											break; //ITT A VÉGE
											default: //minden egyéb táblánál a PK így jön létre -->
												//HA tábla hozzáadás megnézi a legutolsó sorszámot és hozzáad 1-et, kb ez lesz a következő ID, 
												//de a valódi ID-t a mySQL AUTO_INCREMENT-je adja és írja be a táblába. Ez csak valószínűsíthető érték ;)
												//No Para ha a kettő nem egyezik az SQL tudja mit csinál, különben a júzer ezt az ID-t nem is fogja látni :)
												//HA tábla szerkesztés beírja az akt értéket és kész, amúgy meg nem is szerkeszthető ez az adat!!!
												($_GET['action'] == 'add') ? $a = ($sor[$vmi[$i]] + 1) : $a = $sor[$vmi[$i]]; 
												echo $a;
										}
									break;//VÉGE A PK VIZSGÁLATÁNAK
									case 'idProjekt':
										if ($_GET['action'] == 'edit') {
											echo $sor['idProjekt'];
										}
										else {
											date_default_timezone_set('Europe/Budapest');
											$idprj = date('YmWdB');
											echo 'M' . $idprj;
											echo '<input type="hidden" value="M' . $idprj . '" name="idProjekt" /> ';
										}
									break;
									case 'letrehozas':
										if ($_GET['action'] == 'edit') {
											echo $sor['letrehozas'];
										}
										else {
											date_default_timezone_set('Europe/Budapest');
											$creat = date('Y.m.d H:i:s');
											echo $creat;
										}
									break;
									case 'last_update':
										if ($_GET['action'] == 'edit') {
											echo $sor['last_update'];
										}
										else {
											date_default_timezone_set('Europe/Budapest');
											$lud = date('Y.m.d H:i:s');
											echo $lud;
										}
									break;
									case 'ellenorzojel':
										if ($_GET['action'] == 'edit') {
											echo $sor['ellenorzojel'];
										}
										else {
											$cs = date('B');
											$elljel = $idprj % $cs;
											echo $elljel;
											echo '<input type="hidden" value="' . $elljel . '" name="ellenorzojel" /> ';
										}
									break;
									case 'prjtipus':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idProjektNr, idPrjTipus, nvPrjTipus
													FROM
														projektek, prjtipusok
													WHERE
														idProjektNr = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="prjtipus">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['prjtipus'] == $sorok['idPrjTipus']) {
													echo '<option value="' . $sorok['idPrjTipus'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idPrjTipus'] . '">';
												}
												echo $sorok['nvPrjTipus'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idPrjTipus, nvPrjTipus
													FROM
														prjtipusok
													ORDER BY 
														idPrjTipus";
											$talal = $adatbazis -> query($leker);
											echo '<select name="prjtipus">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idPrjTipus'] . '">';
												echo $sorok['nvPrjTipus'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'letrehozo':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idProjektNr, idFelhasznalo, nvFelhasznalo
													FROM
														projektek, felhasznalok
													WHERE
														idProjektNr = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="letrehozo">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['letrehozo'] == $sorok['idFelhasznalo']) {
													echo '<option value="' . $sorok['idFelhasznalo'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idFelhasznalo'] . '">';
												}
												echo $sorok['nvFelhasznalo'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idFelhasznalo, nvFelhasznalo
													FROM
														felhasznalok
													ORDER BY 
														idFelhasznalo";
											$talal = $adatbazis -> query($leker);
											echo '<select name="letrehozo">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idFelhasznalo'] . '">';
												echo $sorok['nvFelhasznalo'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'ceg':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idProjektNr, idCeg, nvCeg
													FROM
														projektek, cegek
													WHERE
														idProjektNr = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="ceg">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['ceg'] == $sorok['idCeg']) {
													echo '<option value="' . $sorok['idCeg'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idCeg'] . '">';
												}
												echo $sorok['nvCeg'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idCeg, nvCeg
													FROM
														cegek
													ORDER BY 
														idCeg";
											$talal = $adatbazis -> query($leker);
											echo '<select name="ceg">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idCeg'] . '">';
												echo $sorok['nvCeg'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'agazat':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idCeg, idAgazat, nvAgazat
													FROM
														agazatok, cegek
													WHERE
														idCeg = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="agazat">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['agazat'] == $sorok['idAgazat']) {
													echo '<option value="' . $sorok['idAgazat'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idAgazat'] . '">';
												}
												echo $sorok['nvAgazat'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idAgazat, nvAgazat
													FROM
														agazatok
													ORDER BY 
														idAgazat";
											$talal = $adatbazis -> query($leker);
											echo '<select name="agazat">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idAgazat'] . '">';
												echo $sorok['nvAgazat'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'csoport':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idFelhasznalo, idCsoport, nvCsoport
													FROM
														felhasznalok, csoportok
													WHERE
														idFelhasznalo = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="csoport">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['agazat'] == $sorok['idCsoport']) {
													echo '<option value="' . $sorok['idCsoport'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idCsoport'] . '">';
												}
												echo $sorok['nvCsoport'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idCsoport, nvCsoport
													FROM
														csoportok
													ORDER BY 
														idCsoport";
											$talal = $adatbazis -> query($leker);
											echo '<select name="csoport">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idCsoport'] . '">';
												echo $sorok['nvCsoport'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'munkakor':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idFelhasznalo, idMunkakor, nvMunkakor
													FROM
														felhasznalok, munkakorok
													WHERE
														idFelhasznalo = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="munkakor">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['agazat'] == $sorok['idMunkakor']) {
													echo '<option value="' . $sorok['idMunkakor'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idMunkakor'] . '">';
												}
												echo $sorok['nvMunkakor'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idMunkakor, nvMunkakor
													FROM
														munkakorok
													ORDER BY 
														idMunkakor";
											$talal = $adatbazis -> query($leker);
											echo '<select name="munkakor">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idMunkakor'] . '">';
												echo $sorok['nvMunkakor'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'ajanlatkell':
									case 'megrendelve':
									case 'dokukesz':
									case 'advekesz':
									case 'tibkesz':
									case 'szamlazva':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT
														idProjektNr, idIN, nvIN
													FROM
														projektek, igennem
													WHERE
														idProjektNr = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											echo '<select name="' . $vmi[$i] . '">';
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor[$vmi[$i]] == $sorok['idIN']) {
													echo '<option value="' . $sorok['idIN'] . '" selected="selected">';
												}
												else {
													echo '<option value="' . $sorok['idIN'] . '">';
												}
												echo $sorok['nvIN'];
											}
											echo '</select>';
										}
										else {
											$leker = "SELECT
														idIN, nvIN
													FROM
														igennem
													ORDER BY 
														idIN";
											$talal = $adatbazis -> query($leker);
											echo '<select name="' . $vmi[$i] . '">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idIN'] . '">';
												echo $sorok['nvIN'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'allapot':
										if ($_GET['action'] == 'edit') {
											$leker = "SELECT 
														" . $idee . " , idAllapot, nvAllapot
													FROM 
														" . $_GET['type'] . " , allapotok
													WHERE 
														allapot = idAllapot AND
														" . $idee . " = " . $_GET['id'];
											$talal = $adatbazis -> query($leker);
											while ($sorok = $talal -> fetch_assoc()) { 
												if ($sor['allapot'] == $sorok['idAllapot'])
													echo $sorok['nvAllapot'];
											}
											
										}
										else {
											$leker = "SELECT
														idAllapot, nvAllapot
													FROM
														allapotok
													ORDER BY 
														idAllapot";
											$talal = $adatbazis -> query($leker);
											echo '<select name="allapot">';
											while ($sorok = $talal -> fetch_assoc()) { 
												echo '<option value="' . $sorok['idAllapot'] . '">';
												echo $sorok['nvAllapot'];
												echo '</option>';
											}
											echo '</select>';
										}
									break;
									case 'idProjektNrX':
										//echo $idee;
										switch ($_GET['type']) {
											case 'bejegyzesek':
												if ($_GET['action'] == 'edit') {
													$leker = "SELECT 
															projektek.idProjekt, projektek.nvProjekt
														FROM
															projektek, bejegyzesek
														WHERE
															bejegyzesek.idProjektNrX = projektek.idProjektNr AND
															" . $idee . " = " . $_GET['id'];
													$talal = $adatbazis -> query($leker);
													$sorok = $talal -> fetch_assoc();
													echo $sorok['idProjekt'] . " -- " . $sorok['nvProjekt'];
												}
												else {
													$leker = "SELECT
															idProjekt, nvProjekt, idProjektNr
														FROM
															projektek
														ORDER BY 
															idProjektNr";
													$talal = $adatbazis ->query($leker);
													echo '<select name="idProjektNrX">';
													while ($sorok = $talal -> fetch_assoc()) { 
														echo '<option value="' . $sorok['idProjektNr'] . '">';
														echo $sorok['idProjekt'] . " -- " . $sorok['nvProjekt'];
														echo '</option>';
													}
													echo '</select>';
												}
											break;
											case 'minugyjegyzetek':
												if ($_GET['action'] == 'edit') {
													$leker = "SELECT 
															projektek.idProjekt, projektek.nvProjekt
														FROM
															projektek, minugyjegyzetek
														WHERE
															minugyjegyzetek.idProjektNrX = projektek.idProjektNr AND
															" . $idee . " = " . $_GET['id'];
													$talal = $adatbazis -> query($leker);
													$sorok = $talal -> fetch_assoc();
													echo $sorok['idProjekt'] . " -- " . $sorok['nvProjekt'];
												}
												else {
													$leker = "SELECT
															idProjekt, nvProjekt, idProjektNr
														FROM
															projektek
														ORDER BY 
															idProjektNr";
													$talal = $adatbazis ->query($leker);
													echo '<select name="idProjektNrX">';
													while ($sorok = $talal -> fetch_assoc()) { 
														echo '<option value="' . $sorok['idProjektNr'] . '">';
														echo $sorok['idProjekt'] . " -- " . $sorok['nvProjekt'];
														echo '</option>';
													}
													echo '</select>';
												}
											break;
										}
									break;
									case 'idFelhasznaloX':
										//echo $idee;
										switch ($_GET['type']) {
											case 'bejegyzesek':
												if ($_GET['action'] == 'edit') {
													$leker = "SELECT 
															felhasznalok.idFelhasznalo, felhasznalok.teljesnev
														FROM
															felhasznalok, bejegyzesek
														WHERE
															bejegyzesek.idFelhasznaloX = felhasznalok.idFelhasznalo AND
															" . $idee . " = " . $_GET['id'];
													$talal = $adatbazis -> query($leker);
													$sorok = $talal -> fetch_assoc();
													echo $sorok['teljesnev'];
												}
												else {
													$leker = "SELECT 
															idFelhasznalo, teljesnev 
														FROM 
															felhasznalok 
														ORDER BY 
															idFelhasznalo";
													$talal = $adatbazis ->query($leker);
													echo '<select name="idFelhasznaloX">';
													while ($sorok = $talal -> fetch_assoc()) { 
														echo '<option value="' . $sorok['idFelhasznalo'] . '">';
														echo $sorok['teljesnev'];
														echo '</option>';
													}
													echo '</select>';
												}
											break;
											case 'minugyjegyzetek':
												if ($_GET['action'] == 'edit') {
													$leker = "SELECT 
															felhasznalok.idFelhasznalo, felhasznalok.teljesnev
														FROM
															felhasznalok, minugyjegyzetek
														WHERE
															minugyjegyzetek.idFelhasznaloX = felhasznalok.idFelhasznalo AND
															" . $idee . " = " . $_GET['id'];
													$talal = $adatbazis -> query($leker);
													$sorok = $talal -> fetch_assoc();
													echo $sorok['teljesnev'];
												}
												else {
													$leker = "SELECT 
															idFelhasznalo, teljesnev 
														FROM 
															felhasznalok 
														ORDER BY 
															idFelhasznalo";
													$talal = $adatbazis ->query($leker);
													echo '<select name="idFelhasznaloX">';
													while ($sorok = $talal -> fetch_assoc()) { 
														echo '<option value="' . $sorok['idFelhasznalo'] . '">';
														echo $sorok['teljesnev'];
														echo '</option>';
													}
													echo '</select>';
												}
											break;
											case 'xproj_alkm':
												if ($_GET['action'] == 'edit') {
													$leker = "SELECT 
															felhasznalok.idFelhasznalo, felhasznalok.teljesnev
														FROM
															felhasznalok, xproj_alkm
														WHERE
															xproj_alkm.idFelhasznaloX = felhasznalok.idFelhasznalo AND
															" . $idee . " = " . $_GET['id'];
													$talal = $adatbazis -> query($leker);
													$sorok = $talal -> fetch_assoc();
													echo $sorok['teljesnev'];
												}
												else {
													$leker = "SELECT 
															idFelhasznalo, teljesnev 
														FROM 
															felhasznalok 
														ORDER BY 
															idFelhasznalo";
													$talal = $adatbazis ->query($leker);
													echo '<select name="idFelhasznaloX">';
													while ($sorok = $talal -> fetch_assoc()) { 
														echo '<option value="' . $sorok['idFelhasznalo'] . '">';
														echo $sorok['teljesnev'];
														echo '</option>';
													}
													echo '</select>';
												}
											break;
										}
									break;
									case 'idJogX':
										//echo $idee;
										switch ($_GET['type']) {
											case 'xcsop_jog':
												if ($_GET['action'] == 'edit') {
													$leker = "SELECT 
															jogok.idJog, jogok.nvJog
														FROM
															jogok, xcsop_jog
														WHERE
															xcsop_jog.idJogX = jogok.idJog AND
															" . $idee . " = " . $_GET['id'];
													$talal = $adatbazis -> query($leker);
													$sorok = $talal -> fetch_assoc();
													echo $sorok['nvJog'];
												}
												else {
													$leker = "SELECT
															idJog, nvJog
														FROM
															jogok
														ORDER BY 
															idJog";
													$talal = $adatbazis ->query($leker);
													echo '<select name="idJogX">';
													while ($sorok = $talal -> fetch_assoc()) { 
														echo '<option value="' . $sorok['idJog'] . '">';
														echo $sorok['nvJog'];
														echo '</option>';
													}
													echo '</select>';
												}
											break;
										}
									break;
									default:
										echo '<input type="text" name="';
										echo $vmi[$i]; 
										echo '" value="';
										($_GET['action'] == 'add') ? $a = '' : $a = $sor[$vmi[$i]]; 
										echo $a;
										echo '"';
								} //end of switch ($vmi[$i])
							?>
						</td>
					</tr>
				<?php 
					} //end of for($i = 1; $i < (count($vmi)); $i++)
				?>
			
				<tr class="sorok" >
					<td colspan="2" style="text">
						<?php
							if ($_GET['action'] == 'edit') {
								echo '<input type="hidden" value="' . $_GET['id'] . '" name="' . $idee . '" /> ';
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