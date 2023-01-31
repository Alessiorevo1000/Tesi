<?php
    session_start();


    $dbconn = pg_connect("host=localhost dbname=LTW_DB
                port= 5432 user=postgres password=password");


    if (isset($_POST["submit"]) || isset($_POST["email"])) {
        $email = $_POST["email"];
        $password = $_POST["pswd"];

        $query = 'SELECT * from utente where email=$1 AND pswd=$2';
        $result = pg_query_params($dbconn, $query, array($email, $password));
        $flag = false;

        if ($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)) { //se esiste un email

            $pass = $tuple["pswd"];
            if ($pass == $password) {

                $_SESSION['cognome'] = $tuple["cognome"];
                $_SESSION['email'] = $tuple["email"];
                $_SESSION['password'] = $tuple["pswd"];
                $_SESSION['cap'] = $tuple["cap"];
                $_SESSION['cellulare'] = $tuple["cellulare"];
                $_SESSION['cf'] = $tuple["cf"];
                $_SESSION['città'] = $tuple["città"];
                $_SESSION['via'] = $tuple["via"];
                $_SESSION['regione'] = $tuple["regione"];
                $_SESSION['codice'] = $tuple["codice"];

                $_SESSION['loggato'] = 1;
                $_SESSION['nome'] = $tuple["nome"];

                if (isset($_POST['rememberMe'])) {
                    $_SESSION['ricordami'] = 1;
                    $query3 = 'INSERT INTO identificativo values ($1,$2)';
                    $result = pg_query_params($dbconn, $query3, array(session_id(), $tuple["codice"]));
                } else {


                    $querynoRem = 'SELECT * from identificativo where codcliente=$1';
                    $resultnoRem = pg_query_params($dbconn, $querynoRem, array($tuple["codice"]));

                    if ($tuplenoRem = pg_fetch_array($resultnoRem, null, PGSQL_ASSOC)) { //se esiste un email

                        $querydel = 'DELETE FROM identificativo WHERE $1=codcliente';
                        $a = pg_query_params($dbconn, $querydel, array($tuple["codice"])); //Ci prendiamo la TABELLA risultante dalla query
                    }
                }


                //session_commit();
                header("location: ../../Home_Section/index.php ");
            }
        } else {
            $flag = false;
        }
    }

    $queryRemember = 'SELECT utente.email, utente.pswd
                from utente inner join identificativo on utente.codice = identificativo.codcliente
                where identificativo.codice = $1';
    $resultRemember = pg_query_params($dbconn, $queryRemember, array(session_id()));
    $tupleRemember = pg_fetch_array($resultRemember, null, PGSQL_ASSOC);

    if ($tupleRemember) {

        $_POST["email"] = $tupleRemember["email"];
        $_POST["pswd"] = $tupleRemember["pswd"];
    }

?>


<!DOCTYPE html>
<html lang="it">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device.width,initial-scale=1">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        
    <link rel="icon" href="../../Home_Section\media\immagini\icon.png">



</head>

<body background="../media/sfondo.webp">

    <form name="myform" action="" method="POST" class="form-signin">

        <img src="../media/finito.jpg" width="190px" />

        <h5 id="login" class="h1 mb-3 mt-5">Login</h5>
        <!--Ricarichiamo i dati come value sugli InputType se avevamo detto di essere ricordati-->
        
        <input id="email" type="email" name="email" class="form-control  mt-1" value="<?php
                                                                                        if (isset($_POST['submit'])) {
                                                                                            echo $_POST["email"];
                                                                                        } else {
                                                                                            if ($tupleRemember) {

                                                                                                echo $_POST["email"];
                                                                                            }
                                                                                        }
                                                                                        ?>" required autofocus />
        <label id="labelEmail" placeholder="Email Inserita", alt=" Email " > </label>
        <div>
            <input id="password" type="password" class="form-control" name="pswd" value="<?php if (isset($_POST['submit'])) {
                                                                                                echo $_POST["pswd"];
                                                                                            } else {
                                                                                                if ($tupleRemember) {
                                                                                                    echo $_POST["pswd"];
                                                                                                }
                                                                                            } ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.]).{8,16}$" required />

            <label id="labelPass" placeholder="Password Inserita", alt=" Password " > </label>
            
        </div>
        <div class="bi bi-eye-slash " id="togglePassword"></div>

        <p id="errore"></p>


        <div id="ricordami" class="h6 mb-2 ">
            <label>Ricordami:</label>
            <input type="checkbox" name="rememberMe" id="rmb" />
        </div>

        <button id="invia" type="submit" class="btn btn-danger" name="submit">Accedi</button>

        <div class="mb-2 mt-4">
            <a id="registrati" href="../Registrazione/index.php">Registrati ora!</a>
        </div>

    </form>
    <script>
        //Piccolo Scriptino per controllare la correttezza di Password ed Email:
        var variabile = "<?php if ($tupleRemember) {
                                echo true;
                            } else {
                                echo false;
                            } ?>";
        var flagJS = "<?php echo $flag; ?>";
        if (flagJS == false) {
            $("#errore").show();
            $("#errore").text("*Email o password errati!*");
        }
    </script>
    <script src="./index.js"></script>

</body>

</html>