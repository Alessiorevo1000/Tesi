<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>Modifica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device.width,initial-scale=1">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="modifica.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="icon" href="../../Home_Section\media\immagini\icon.png">

</head>

<body class="text-center" background="../media/sfondo.webp">
    <?php
    /*Se si entra in questa pagina senza passare dal LOGIN (quindi se il $_SESSION su loggatto non è settato), si viene ributtati sulla Home Page.
        -->La quale a sua volta gestirà gli utenti loggati e non (che vedranno in alto a destra il bottone d'accesso).*/
        
    if (!isset($_SESSION["loggato"])  && !isset($_COOKIE["nome"]) ) {
        header("location: ../../Home_Section/index.php");
        return;
    }
    
    if (isset($_SESSION["nome"])){
        $nome=$_SESSION["nome"];

        $cognome=$_SESSION['cognome'];
        $email=$_SESSION['email'];
        $password=$_SESSION['password'];
        $cap=$_SESSION['cap'];
        $cellulare=$_SESSION['cellulare'];
        $cf=$_SESSION['cf'];
        $città=$_SESSION['città'];
        $via=$_SESSION['via'] ;
        $regione=$_SESSION['regione'];
        $codice=$_SESSION['codice'];

        
     
    }
    if (isset($_COOKIE["nome"])){

        $nome=$_COOKIE["nome"];
        $cognome=$_COOKIE['cognome'];
        $email=$_COOKIE['email'];
        $password=$_COOKIE['password'];
        $cap=$_COOKIE['cap'];
        $cellulare=$_COOKIE['cellulare'];
        $cf=$_COOKIE['cf'];
        $città=$_COOKIE['città'];
        $via=$_COOKIE['via'] ;
        $regione=$_COOKIE['regione'];
        $codice=$_COOKIE['codice'];

        
     
    }

    ?>
    <form action="modifica.php" method="POST" class="form-update" name="myForm">
        <img src="../media/finito.jpg" width="190px" />
        <h1 id="modifica" class="h1 mb-3 mt-5">Modifica</h1>

        <p class="Explain">Nome e Cognome:</p>
        <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" pattern="^[a-zA-Z]+$" required />
        <input type="text" name="cognome" class="form-control margine" value="<?php echo $cognome; ?>" pattern="^[a-zA-Z]+$" required />

        <p class="Explain">Cellulare:</p>
        <input type="text" name="cell" class="form-control margine" value="<?php echo $cellulare;  ?>" maxlength="10" pattern="[0-9]{10}$" required />
        
        <p class="Explain">Codice Fiscale:</p>
        <input type="text" name="cf" class="form-control margine" value="<?php echo $cf;  ?>" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$" required />

        <p class="Explain">Email e Password:</p>
        <input type="email" name="email" class="form-control margine" value="<?php echo $email;  ?>" required />
        <div>
            <input type="password" class="form-control margine" name="pswd" id="pass" value="<?php echo $password  ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" required />
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>

        <p class="Explain">Regione:</p>
        <input class="box margine" id="boxRegione" list="Regione" name="regione" value="<?php echo $regione; ?>">
        <datalist id="Regione">
            <option value="Abruzzo">
            <option value="Basilicata">
            <option value="Calabria">
            <option value="Emilia-Romagna">
            <option value="Friuli Venezia Giulia">
            <option value="Lazio">
            <option value="Liguria">
            <option value="Lombardia">
            <option value="Marche">
            <option value="Molise">
            <option value="Piemonte">
            <option value="Puglia">
            <option value="Sardegna">
            <option value="Sicilia">
            <option value="Toscana">
            <option value="Trentino-Alto Adige">
            <option value="Umbria">
            <option value="Valle d'Aosta">
            <option value="Veneto">
        </datalist>

        <script src="./index.js"></script>

        <p class="Explain">Indirizzo Domicilio:</p>
        <input type="text" class="form-control" name="città" value="<?php echo $città;  ?>" pattern="^[a-zA-Z]+$" required>
        <input type="text" class="form-control margine" name="via" value="<?php echo $via;  ?>" pattern="^[a-zA-Z\s]+[0-9]*" required>



        <div id="divCap" class="mb-3">
            <label for="cap" class="Explain">CAP (5 cifre):</label>
            <input type="text" name="cap" maxlength=5 size=5 value="<?php echo $cap;  ?>" pattern="^[0-9]{5}" required />
        </div>


        <button type="submit" id="modify" name="registrationButton">Modifica</button>

    </form>

</body>

</html>