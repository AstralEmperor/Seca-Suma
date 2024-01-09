<meta charset="UTF-8">
<link href="/SECA-SUMA/style.css" type="text/css" rel="stylesheet">
<link href="/SECA-SUMA/FrontEnd/src/Partials/Login/login.css" type="text/css" rel="stylesheet">
        <form id="login" action="/SECA-SUMA/FrontEnd/src/Modali/LoginProvera/loginProvera.php" method="POST">
            <div class="login__cancelWrap">
                <button class="login__cancel"><img src="/SECA-SUMA/FrontEnd/Assets/cancel_icon.png" alt="cancel.png"></button>
            </div>
            <div class="login__inputField">
                <div class="login__usernameWrap">
                    <label for="korisnickoIme">Korisnicko ime:</label>
                    <input id="korisnickoIme" name="korisnickoIme" type="text" placeholder="Korisnicko ime" pattern="[A-Za-z]{3,15}" oninvalid="this.setCustomValidity('Molimo vas unesi 3 do 15 slova(A-z)')" oninput="setCustomValidity('')" required>
                </div>
                <div class="login__passwordWrap">
                    <label for="sifra">Šifra:</label>
                    <input id="sifra" name="sifra" type="password" placeholder="Šifra" pattern="[A-Za-z0-9]{3,12}" oninvalid="this.setCustomValidity('Molimo vas unesi 3 do 15 slova(A-z, 0-9)')" oninput="setCustomValidity('')" required>
                </div>
            </div>
            <button class="login__btn" type="submit">Prijavi se</button>
        </form>
<script src="/SECA-SUMA/FrontEnd/src/Partials/Login/login.js"></script>