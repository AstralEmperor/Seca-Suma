<?php
    $connection = mysqli_connect("localhost","root","","sume");
    if($connection->connect_error){
        die("Connection failed". $connection_error);
    }
// INSERTS NEW DATA 

    if(isset($_POST['submit'])){
       $VrstaDrveta = $_POST['vrstadrveta'];
       $PovršinaSume = $_POST['povrsina'];
       $Datum = $_POST['datum'];
       $Neto = $_POST['zarada'];

    $sql = "INSERT into `SUME`.`PRETHODNESECE` (VrstaDrveta, PovršinaSume, Datum, Neto) values ('$VrstaDrveta', $PovršinaSume, '$Datum', $Neto)";
    $result = mysqli_connect($connection, $sql);
    if($result){
        echo "Uspešno uneti podaci";
    }else{
        die(mysqli_connect($connection));
    }
}
$connection-> close();
?>

<meta charset="UTF-8">
    <head>
        <link href="/SEČA-ŠUMA/style.css" type="text/css" rel="stylesheet">
        <link href="/SEČA-ŠUMA/FrontEnd/src/Modals/PredhSece_noveSece/predhSece_dodajNovo.css" type="text/css" rel="stylesheet">
    </head>
    <section class="addNew">
        <form class="addNew__form" method="POST">
            <div class="addNew__h3Wrap">
                 <h3>Unesi Odradjenu Seču</h1>
            </div>
            <!-- CANCEL FORM -->
            <div class="addNew__cancelWrap">
                <button class="addNew__cancel"><img src="/SEČA-ŠUMA/FrontEnd/Assets/cancel_icon.png" alt="Exit_form.jpg"></button>
            </div>
            <!-- INPUT FIELD -->
            <div class="addNew__inputContainer">
                <div class="addNew__inputWrap">
                    <label for="vrstadrveta" class="label">Vrsta Drveta</label>
                    <input name="vrstadrveta" class="input" id="vrstadrveta" type="text" require placeholder="Naziv">
                </div>
                <div class="addNew__inputWrap">
                    <label for="povrsina" class="label">Površina Šume(m3)</label>
                    <input name="povrsina" id="povrsina" class="input" type="text" require placeholder="Površina">
                </div>
                <div class="addNew__inputWrap">
                    <label for="datum" class="label">Datum</label>
                    <input name="datum" id="datum" class="input" type="date" require>
                </div>
                <div class="addNew__inputWrap">
                    <label for="zarada" class="label">Ukupna zarada</label>
                    <input name="zarada" id="zarada" class="input" type="text" require placeholder="Zarada">
                </div>
            </div>
            <div class="addNew__addBtnWrap">
              <button class="button addNew__addBtn" type="submit">UPIŠI</button>
            </div>
        </form>
    </section>