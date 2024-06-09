<?php
    session_start();

    $korisnik=$_SESSION["korisnik"];

        if(!isset($korisnik)){
            header ('Location:/Seca-Suma/index.php');
        }

        $StaraPovrsinaID = $_POST['povrsinaID'];

        // ostvaruje konekciju
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaKonekcija.php";
        $KonekcijaObject = new Konekcija($_SERVER['DOCUMENT_ROOT'] . '/SECA-SUMA/BackEnd/Klase/BazniParamKonekcije.xml');
        $KonekcijaObject->connect();
        $db_handle = $KonekcijaObject->konekcijaMYSQL;
        $bazapodataka = $KonekcijaObject->KompletanNazivBazePodataka;
        $UspehKonekcijeNaBazu = $KonekcijaObject -> konekcijaDB;

        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/BaznaTabela.php";

        // Preuzima stare vrednosti iz izabranu Povrsinu
        require $_SERVER['DOCUMENT_ROOT'] . "/SECA-SUMA/BackEnd/Klase/DBPovrsina.php";
        $PovrsinaObject = new DBPovrsina($KonekcijaObject, 'povrsina');
        $PovrsinaObject-> UcitajSecuPoId($StaraPovrsinaID);
        $KolekcijaZapisaZakazanihSeca = $PovrsinaObject->Kolekcija;
        $UkupanBrojZapisaZakazanihSeca = $PovrsinaObject->BrojZapisa;

        if($UkupanBrojZapisaZakazanihSeca > 0){
            $row=0;
            $StaraPovrsinaID=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row, 0);
            $StaraPovrsinaZaSecu=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,1);
            $StaraUkupnaPovrsina=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,2);
            $StareMladice=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,3);
            $StaraPraznina=$PovrsinaObject->DajVrednostPoRednomBrojuZapisaPoRBPolja($KolekcijaZapisaZakazanihSeca, $row,4);

        }
?>

<meta charset="UTF-8">
    <head>
        <link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SECA-SUMA/FrontEnd/src/Modali/Izmena/editovanjeSeca.css" type="text/css" rel="stylesheet">
    </head>
    <section class="edituj">
        <form class="edituj__form" action="/Seca-Suma/FrontEnd/src/Modali/Izmena/izmenaPovrsina.php" method="POST">
        <input type="hidden" name="povrsinaID" value="<?php echo $StaraPovrsinaID;?>">
         <input type="hidden" name="staraPovrsinaID" value="<?php echo $StaraPovrsinaID;?>">
            <!-- CANCEL FORM -->
            <div class="edituj__cancelWrap">
                <button class="edituj__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <div class="edituj__h3Wrap">
                 <h3>Promeni Površinu seče</h1>
            </div>
            <!-- INPUT FIELD -->
            <div class="edituj__inputContainer">
                <div class="edituj__inputWrap">
                    <label for="ukupanTrosak" class="label">Površina za Seču(m2)*</label>
                    <input name="ukupanTrosak" id="ukupanTrosak" type="number" class="input" placeholder="Površina za Seču" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')"  required value="<?php echo $StaraPovrsinaZaSecu; ?>">
                </div>
                <div class="edituj__inputWrap">
                    <label for="ukupnaPovrsina" class="label">Ukupna Površina(m2)*</label>
                    <input name="ukupnaPovrsina" id="ukupnaPovrsina" class="input" type="number" placeholder="Ukupna Površina" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StaraUkupnaPovrsina; ?>">                  
                </div>
                <div class="edituj__inputWrap">
                    <label for="mladice" class="label">Mladice(m2)*</label>                    
                    <input name="mladice" id="mladice" class="input" type="number" placeholder="Mladice" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StareMladice; ?>">
                </div>
                <div class="edituj__inputWrap">
                    <label for="praznina" class="label">Praznina(m2)*</label>                  
                    <input name="praznina" id="praznina" class="input" type="number" placeholder="Praznina" pattern="[0-9]{1,10}" oninvalid="this.setCustomValidity('Molimo vas unesite 1 do 10 brojeva')" oninput="setCustomValidity('')" required value="<?php echo $StaraPraznina; ?>">                    
                </div>
            </div>
            <div class="edituj__addBtnWrap">
              <button class="button edituj__snimiBtn" name="submit" type="submit" enctype="multipart/form-data">SNIMI IZMENU</button>
            </div>
        </form>
    </section>
