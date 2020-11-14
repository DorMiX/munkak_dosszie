<?php
	switch ($_GET['type']) {
						case 'projektek':
							echo 'Projektek';
							break;
						case 'bejegyzesek':
							echo 'Bejegyzések';
							break;	
						case 'minugyjegyzetek':
							echo 'Minőségügyi jegyzetek';
							break;
						case 'prjtipusok':
							echo 'Projekt típusok';
							break;
						case 'xproj_alkm':
							echo 'Projektek X Alkalmazottak';
							break;
						case 'ajanlatok':
							echo 'Ajánaltok';
							break;
						case 'atadasatvetelik':
							echo 'Átadás-Átvételi';
							break;
						case 'dokumentek':
							echo 'Dokumentumok';
							break;
						case 'megrendelesek':
							echo 'Megrendelések';
							break;
						case 'szamlak':
							echo 'Számlák';
							break;
						case 'tibek':
							echo 'Teljesítés Igazolási Bizonylatok';
							break;
						case 'agazatok':
							echo 'Ágazatok';
							break;
						case 'cegek':
							echo 'Cégek';
							break;
						case 'partnerek':
							echo 'Partnerek';
							break;
						case 'felhasznalok':
							echo 'Felhasználók';
							break;
						case 'munkakorok':
							echo 'Munkakörök';
							break;
						case 'csoportok':
							echo 'Csoportok';
							break;
						case 'jogok':
							echo 'Jogok';
							break;
						case 'xcsop_jog':
							echo 'Csoprtok X Jogok';
							break;
						case 'eszkozok':
							echo 'Eszközök';
							break;
						case 'muszerek':
							echo 'Műszerek';
							break;
						case 'allapotok':
							echo 'Állapotok';
							break;
						case 'igennem':
							echo 'Igen/Nem';
							break;
	}
?>					