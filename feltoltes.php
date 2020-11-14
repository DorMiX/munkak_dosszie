<html>
<head>
<title>Felt�lt�s...</title>
</head>
<body>
<h1>A f�jl felt�lt�se...</h1>
<?php

  if ($_FILES['felhasznaloi_fajl']['error']>0)
  {
    echo 'Hiba t�rt�nt: ';
    switch ($_FILES['felhasznaloi_fajl']['error'])
    {
      case 1: echo 'A f�jlm�ret meghaladja a maxim�lisan felt�lthet� m�retet';
              break;
      case 2: echo 'a f�jlm�ret meghaladja a maxim�lis m�retet';
              break;
      case 3: echo 'A f�jl felt�lt�se csak r�szlegesen siker�lt';
              break;
      case 4: echo 'Nem lett f�jl felt�ltve';
              break;
      case 6: echo 'Nem lehet felt�lteni a f�jlt: Nincs ideiglenes mappa meghat�rozva';
              break;
      case 7: echo 'Nem siker�lt a felt�lt�s: Nem lehetett a lemezre �rni';
              break;
    }
    exit;
  }
  // Megfelel� MIME-t�pus� a f�jl?
  if ($_FILES['felhasznaloi_fajl']['type'] != 'text/plain')
  {
    echo 'Hiba: a f�jl nem egyszer� sz�veg';
    exit;
  }

  // tegy�k a f�jlt a nek�nk tetsz� helyre
  $feltoltendo_fajl = 'feltoltesek/'.$_FILES['felhasznaloi_fajl']['name'] ;

  if (is_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name']))
  {
     if (!move_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name'], $feltoltendo_fajl))
     {
        echo 'Hiba: Nem siker�lt a f�jlt a c�lmapp�ba �thelyezni';
        exit;
     }
  }
  else
  {
    echo 'Hiba: F�jlfelt�lt�si t�mad�s lehet�s�ge. F�jln�v: ';
    echo $_FILES['felhasznaloi_fajl']['name'];
    exit;
  }

  echo 'A f�jlfelt�lt�s siker�lt<br><br>';

  // t�vol�tsuk el a f�jl tartalm�b�l az esetleges HTML �s PHP c�mk�ket
  $tartalom = file_get_contents($feltoltendo_fajl);
  $tartalom = strip_tags($tartalom);
  file_put_contents($_FILES['felhasznaloi_fajl']['name'], $tartalom);

  // mutassuk meg a felt�lt�tt f�jlt
  echo '<p>A felt�lt�tt f�jl tartalm�nak el�n�zete:<br/><hr/>';
  echo nl2br($tartalom);
  echo '<br/><hr/>';
?>
</body>
</html>
