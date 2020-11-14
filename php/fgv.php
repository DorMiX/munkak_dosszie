<?php
	//----------------------------------------------//
	//deklarációk									//
	//----------------------------------------------//
	require("php/konfig.php");
	
	//----------------------------------------------//
	//függvények									//
	//----------------------------------------------//
	
	function tabla_mezok($tablanev) { //visszatér egy tömbbel, ami a paraméterben megadott tábla mezőneveit tárolja
		require("php/konfig.php");
		$eredmeny = array();
		$eredmeny[0] = $tablanev;
		$lekerdezes = 'SHOW COLUMNS FROM ' . $tablanev ;
		$talalat = $adatbazis -> query($lekerdezes);
		$i = 1;
		foreach ($talalat as $sor => $ertek) {
			$eredmeny[$i] = $ertek['Field'];
			$i++;
		}
		return $eredmeny;
	}
	
	
	function oszlop_nev_kiiras($rekord) { //a táblázat oszlopaihoz társítja az xml-ben lévő nevet és kiírja a képernyőre azt 
		$xmldom_doc = new DOMDocument();
		$xmldom_doc -> load('xml/oszlop_nevek.xml');
		$rek = $xmldom_doc -> getElementsByTagName($rekord);
		foreach ($rek as $rk) {
			echo $rk -> nodeValue, PHP_EOL;
		}
	}
	
	function tabla_nev_kiiras($rekord) { //a táblázat oszlopaihoz társítja az xml-ben lévő nevet és kiírja a képernyőre azt 
		$xmldom_doc = new DOMDocument();
		$xmldom_doc -> load('xml/tabla_nevek.xml');
		$rek = $xmldom_doc -> getElementsByTagName($rekord);
		foreach ($rek as $rk) {
			echo $rk -> nodeValue;
		}
	}
	
	function tabla_index_rekordnev($tablanev) { //visszatér a táblázat PRIMARY_KEY index rekord nevével
		
		require("php/konfig.php");
		
		$lekerdezes = 'SHOW COLUMNS FROM ' . $tablanev ;
		$talalat = $adatbazis -> query($lekerdezes);
		//$sor = $talalat->fetch_assoc();
		$i = 1;
		foreach ($talalat as $sor => $ertek) {
			$eredmeny[$i] = $ertek['Field'];
			//echo $eredmeny[$i]; 
			$i++;
		}
		return $eredmeny[1];
	}

	function mysql_get_prim_key($table) { //visszatér a táblázat PRIMARY_KEY index oszlopnevével
		
		require("php/konfig.php");
		
		$sql = "SHOW INDEX FROM $table WHERE Key_name = 'PRIMARY'";
		$gp = $adatbazis -> query($sql);
		$cgp = $gp -> num_rows;
		if($cgp > 0) {
			// Note I'm not using a while loop because I never use more than one prim key column
			$agp = $gp -> fetch_array(MYSQLI_ASSOC);
			
			return $agp['Column_name'];
		} else {
			return(false);
		}
	}
	
	function egy_mezo_ertek_index($tablanev, $idx, $mezonev) { //a táblázatból visszatér 1 konkrét mező értékével
		
		require("php/konfig.php");
		
		$idx_name = tabla_index_rekordnev($tablanev);
		
		$lekerdezes = "SELECT * FROM $tablanev WHERE  $idx_name = $idx";
		$talalat = $adatbazis -> query($lekerdezes);
		$talalatok_szama = $talalat -> num_rows;
		$sor = $talalat->fetch_assoc();
		return $sor[$mezonev];
	}
	
	function tablazat_listazas($tablanev) {
		
		require("php/konfig.php");
		
		$tomb = tabla_mezok($tablanev); //visszatér egy tömbbel, ami a paraméterben megadott tábla mezőneveit tárolja
		echo '<tr>';
		for($i = 1; $i <= (count($tomb) - 1); $i++) {
			echo "<th>";
			oszlop_nev_kiiras($tomb[$i]); //a táblázat mezőneveihez társítja az xml-ben megadott nevet és kiírja a képernyőre azt
			echo "</th>";
		}
		echo '</tr>';
		
		switch ($tablanev) {
			case 'projektek':
				$lekerdezes = '
					SELECT 
						idProjektNr, idProjekt, nvProjekt, prjtipus, projektek.allapot, projektek.letrehozas, letrehozo, leiras, ceg, kezdete, vege, ajanlatkell, megrendelve, dokukesz, advekesz, tibkesz, szamlazva, projektek.last_update, ellenorzojel, idPrjTipus, nvPrjTipus, idAllapot, nvAllapot, idFelhasznalo, nvFelhasznalo, idCeg, nvCeg
					FROM 
						projektek, prjtipusok, allapotok, felhasznalok, cegek
					WHERE 
						prjtipus = idPrjTipus AND 
						projektek.allapot = idAllapot AND
						letrehozo = idFelhasznalo AND
						ceg = idCeg
					ORDER BY idProjektNr';
			break;
			case 'prjtipusok':
				$lekerdezes = '
					SELECT
						idPrjTipus, nvPrjTipus, allapot, prjtipusok.letrehozas, prjtipusok.last_update, idAllapot, nvAllapot
					FROM 
						prjtipusok, allapotok
					WHERE 
						allapot = idAllapot
					ORDER BY idPrjTipus';
			break;
			case 'cegek':
				$lekerdezes = '
					SELECT
						idCeg, nvCeg, cegteljesnev, irsz, telepules, cim, agazat, cegek.letrehozas, cegek.last_update, idAgazat, nvAgazat
					FROM 
						cegek, agazatok
					WHERE 
						agazat = idAgazat
					ORDER BY idCeg';
			break;
			case 'partnerek':
				$lekerdezes = "
					SELECT 
						idPartner, ceg, teljesnev, beosztas, reszleg, email, mobil, partnerek.allapot, partnerek.letrehozas, partnerek.last_update, idAllapot, nvAllapot, idCeg, nvCeg 
					FROM 
						partnerek, allapotok, cegek 
					WHERE 
						allapot = idAllapot AND
						ceg = idCeg
					ORDER BY 
						idPartner";
			break;
			case 'felhasznalok':
				$lekerdezes = '
					SELECT
						idFelhasznalo, nvFelhasznalo, nvEmail, felhasznalok.csoport, jelszo, teljesnev, felhasznalok.munkakor, mobil, felhasznalok.allapot, felhasznalok.letrehozas, felhasznalok.last_update, idAllapot, nvAllapot, idCsoport, nvCsoport, idMunkakor, nvMunkakor
					FROM 
						felhasznalok, allapotok, csoportok, munkakorok
					WHERE
						felhasznalok.allapot = idAllapot AND
						felhasznalok.csoport = idCsoport AND
						felhasznalok.munkakor = idMunkakor
					ORDER BY idFelhasznalo';
			break;
			case 'munkakorok':
				$lekerdezes = '
					SELECT
						idMunkakor, nvMunkakor, allapot, munkakorok.letrehozas, munkakorok.last_update, idAllapot, nvAllapot
					FROM
						munkakorok, allapotok
					WHERE
						allapot = idAllapot
					ORDER BY idMunkakor';
			break;
			case 'csoportok':
				$lekerdezes = '
					SELECT
						idCsoport, nvCsoport, csoportok.allapot, csoportok.letrehozas, csoportok.last_update, idAllapot, nvAllapot
					FROM
						csoportok, allapotok
					WHERE
						csoportok.allapot = idAllapot
					ORDER BY idCsoport';
			break;
			case 'jogok':
				$lekerdezes = '
					SELECT
						idJog, nvJog, jogok.allapot, jogok.letrehozas, jogok.last_update, idAllapot, nvAllapot
					FROM
						jogok, allapotok
					WHERE
						jogok.allapot = idAllapot
					ORDER BY idJog';
			break;
			case 'eszkozok':
				$lekerdezes = '
					SELECT
						idEszkozNr, idEszkoz, nvEszkoz, gyarto, tipus, gysz, eszkozok.allapot, eszkozok.letrehozas, eszkozok.last_update, idAllapot, nvAllapot
					FROM
						eszkozok, allapotok
					WHERE
						eszkozok.allapot = idAllapot
					ORDER BY idEszkozNr';
			break;
			case 'muszerek':
				$lekerdezes = '
					SELECT
						idMuszerNr, idMuszer, nvMuszer, gyarto, tipus, gysz, kalbiz, kaldatum, kalerv, muszerek.allapot, muszerek.letrehozas, muszerek.last_update, idAllapot, nvAllapot
					FROM
						muszerek, allapotok
					WHERE
						muszerek.allapot = idAllapot
					ORDER BY idMuszerNr';
			break;
			case 'agazatok':
				$lekerdezes = '
					SELECT
						idAgazat, nvAgazat, agazatok.allapot, agazatok.letrehozas, agazatok.last_update, idAllapot, nvAllapot
					FROM
						agazatok, allapotok
					WHERE
						agazatok.allapot = idAllapot
					ORDER BY idAgazat';
			break;
			case 'bejegyzesek':
				$lekerdezes = '
					SELECT
						idBejegyzes, idProjektNrX, idFelhasznaloX, bejegyzes, bejegyzesek.letrehozas, bejegyzesek.last_update, felhasznalok.idFelhasznalo, felhasznalok.teljesnev, projektek.idProjektNr, projektek.idProjekt, projektek.nvProjekt
					FROM 
						bejegyzesek, felhasznalok, projektek
					WHERE
						idProjektNrX = idProjektNr AND
						idFelhasznaloX = idFelhasznalo
					ORDER BY idBejegyzes';
			break;
			case 'minugyjegyzetek':
				$lekerdezes = '
					SELECT
						idMinUgyJegyzet, idProjektNrX, idFelhasznaloX, jegyzet, minugyjegyzetek.letrehozas, minugyjegyzetek.last_update, felhasznalok.idFelhasznalo, felhasznalok.teljesnev, projektek.idProjektNr, projektek.idProjekt, projektek.nvProjekt
					FROM 
						minugyjegyzetek, felhasznalok, projektek
					WHERE
						idProjektNrX = idProjektNr AND
						idFelhasznaloX = idFelhasznalo
					ORDER BY idMinUgyJegyzet';
			break;
			case 'xcsop_jog':
				$lekerdezes = '
					SELECT
						idCsoport, nvCsoport, idJog, nvJog, xcsop_jog.letrehozas, xcsop_jog.last_update, idCsoportX, idJogX
					FROM 
						csoportok, jogok, xcsop_jog
					WHERE
						idCsoportX = idCsoport AND
						idJogX = idJog 
					ORDER BY idCsoportX';
			break;
			case 'xproj_alkm':
				$lekerdezes = '
					SELECT
						idProjektNrX, idFelhasznaloX, xproj_alkm.letrehozas, xproj_alkm.last_update, idProjektNr, idProjekt, nvProjekt,  idFelhasznalo, teljesnev
					FROM 
						projektek, felhasznalok, xproj_alkm
					WHERE
						idProjektNrX = idProjektNr AND
						idFelhasznalox = idFelhasznalo
					ORDER BY idProjektNrX';
			break;
			case 'xproj_eszk':
				$lekerdezes = '
					SELECT
						idProjektNrX, idEszkozNrX, xproj_eszk.letrehozas, xproj_eszk.last_update, idProjektNr, idProjekt, nvProjekt,  idEszkoz, nvEszkoz
					FROM 
						projektek, eszkozok, xproj_eszk
					WHERE
						idProjektNrX = idProjektNr AND
						idEszkozNrX = idEszkozNr
					ORDER BY idProjektNrX';
			break;
			case 'xproj_musz':
				$lekerdezes = '
					SELECT
						idProjektNrX, idMuszerNrX, xproj_musz.letrehozas, xproj_musz.last_update, idProjektNr, idProjekt, nvProjekt,  idMuszer, nvMuszer
					FROM 
						projektek, muszerek, xproj_musz
					WHERE
						idProjektNrX = idProjektNr AND
						idMuszerNrX = idMuszerNr
					ORDER BY idProjektNrX';
			break;
			case 'ajanlatok':
				$lekerdezes = '
					SELECT
						idAjanlatNr, idAjanlat, rleiras, idProjektNrX, eutvonal, efajlnev, tutvonal, tfajlnev, tlink, ajanlatok.letrehozas, ajanlatok.last_update, idProjektNr, idProjekt, nvProjekt
					FROM 
						ajanlatok, projektek
					WHERE
						idProjektNrX = idProjektNr
					ORDER BY idAjanlatNr';
			break;	
			
			default:
				$lekerdezes = 'SELECT * FROM ' . $tablanev;
		}
		
		$talalat = $adatbazis -> query($lekerdezes);
		$talalatok_szama = $talalat -> num_rows;
				
		$i=0;
		$odd = true;
		
		while ($i != $talalatok_szama) {
			echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
			$odd = !$odd;
			
			$sor = $talalat->fetch_assoc();
			for( $j = 1; $j <= (count($tomb) - 1); $j++) {
				echo '<td>';	
				switch ($tomb[$j]) {
					case 'prjtipus':
						echo $sor['nvPrjTipus'];
						break;
					case 'allapot':
						echo $sor['nvAllapot'];
						break;
					case 'letrehozo':
						echo $sor['nvFelhasznalo'];
						break;
					case 'ceg':
						echo $sor['nvCeg'];
						break;
					case 'agazat':
						echo $sor['nvAgazat'];
						break;
					case 'ajanlatkell':
						($sor['ajanlatkell'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 2, 'nvIN');
						echo $er;
						break;
					case 'megrendelve':
						($sor['megrendelve'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 2, 'nvIN');
						echo $er;
						break;
					case 'dokukesz':
						($sor['dokukesz'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 2, 'nvIN');
						echo $er;
						break;
					case 'advekesz':
						($sor['advekesz'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 2, 'nvIN');
						echo $er;
						break;
					case 'tibkesz':
						($sor['tibkesz'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 2, 'nvIN');
						echo $er;
						break;
					case 'szamlazva':
						($sor['szamlazva'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 2, 'nvIN');
						echo $er;
						break;
					case 'csoport':
						echo $sor['nvCsoport'];
						break;
					case 'munkakor':
						echo $sor['nvMunkakor'];
						break;
					case 'idProjektNrX':
						echo $sor['idProjekt'] . " -- " . $sor['nvProjekt'];
						break;
					case 'idFelhasznaloX':
						echo $sor['teljesnev'];
						break;
					case 'idCsoportX':
						echo $sor['nvCsoport'];
						break;
					case 'idJogX':
						echo $sor['nvJog'];
						break;
					case 'idEszkozNrX':
						echo $sor['idEszkoz'] . ' -- ' . $sor['nvEszkoz'];
						break;
					case 'idMuszerNrX':
						echo $sor['idMuszer'] . ' -- ' . $sor['nvMuszer'];
						break;
					default: 
						echo $sor[$tomb[$j]];	
				}
				echo '</td>';
			}
			switch ($tablanev) {
				case "allapotok":
				case "igennem":
					break;
				case "xproj_alkm":
				case "xcsop_jog":
				case "xproj_eszk":
				case "xproj_musz":
					if (in_array('allapot', $tomb)) {
						echo '<td>';
						echo '<a class="button-link" href="commit.php?action=stateonoff&type=' .$tablanev . '&id=' . $sor[$tomb[1]] . '">';
					
						if ($sor['allapot'] == 0)
							echo 'AKTIVÁLÁS';
						else						
							echo 'INAKTIVÁLÁS';
						echo '</a>';
						echo '</td>';
					}
					else {
						echo '<td>';
						echo '<a class="button-link" href="commit.php?action=delete&type=' . $tablanev . '&id=' . $sor[$tomb[1]] . '&other=' . $sor[$tomb[2]] . '"> TÖRLÉS </a>';
						echo '<td>';
					}
					break;
				default:
					echo '<td>';
					echo '<a class="button-link" href="visualization.php?action=edit&type=' . $tablanev . '&id=' . $sor[$tomb[1]] . '"> MÓDOSÍTÁS </a>';
					echo '<td>';
					if ($tablanev == "ajanlatok") {
						echo '<td>';
						echo '<a class="button-link" href="visualization.php?action=fajlmod&type=' . $tablanev . '&id=' . $sor[$tomb[1]] . '"> FÁJLMÓDOSÍTÁS </a>';
						echo '<td>';
					}
					if (in_array('allapot', $tomb)) {
						echo '<td>';
						echo '<a class="button-link" href="commit.php?action=stateonoff&type=' .$tablanev . '&id=' . $sor[$tomb[1]] . '">';
					
						if ($sor['allapot'] == 0)
							echo 'AKTIVÁLÁS';
						else						
							echo 'INAKTIVÁLÁS';
						echo '</a>';
						echo '</td>';
					}
					else {
						echo '<td>';
						echo '<a class="button-link" href="commit.php?action=delete&type=' . $tablanev . '&id=' . $sor[$tomb[1]] . '&other=' . $sor[$tomb[2]] . '"> TÖRLÉS </a>';
						echo '<td>';
					}
			}
					
				
			
			
			echo '</tr>';
			$i++;
		}
	}
	
	

?>