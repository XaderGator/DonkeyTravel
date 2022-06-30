<!DOCTYPE html>
<html lang="nl">
<head>
        <title>Registratie </title>
		<meta charset=utf-8>
		<meta name=description content="beschrijving">
		<meta name=keywords content="trefword, trefword">
        <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script><title>Ingelogd</title>

	
</head>
<body>

<?php


	include_once 'dbh.php';
	
	
	if(isset($_POST['Annuleer']))
	{
		header("location: index.php");
	}

	if(isset($_POST['toevoegen']))
	{

		//todo check systeem of persoon er al in zit


		$Vandaag = date("Y-m-d H:i:s");

		$Naam = $_POST['Naam'];
		$Email = $_POST['Email'];
		$Telefoon = $_POST['Telefoon'];
		$Wachtwoord = password_hash($_POST['Wachtwoord'], PASSWORD_DEFAULT);
		$Gewijzigd = $Vandaag;

		$QueryInsertKlant = "INSERT INTO klanten (Naam, Email, Telefoon, Wachtwoord, Gewijzigd) 
				VALUES ('$Naam', '$Email', '$Telefoon', '$Wachtwoord', '$Gewijzigd');";
			mysqli_query($conn, $QueryInsertKlant);

		header("location: index.php");

	}
?>

<html>
    <head>
    <link rel="stylesheet" href="css/style.css">
    <title> De Elstar </title>
		<meta charset=utf-8>
		<meta name=description content="beschrijving">
		<meta name=keywords content="trefword, trefword">
		<link rel="stylesheet" href="index.css">
    <link rel="icon" href="donkey.jpg" type="image/jpg">

    </head>
    <body class = "Rbody">
        <div class ="container">
            <div class ="center">
                <div class ="box">
                    <legend class="legend">Registratie</legend>
                    <form action="registratie.php" method="post" autocomplete="off">

                    
                        <div class="row"> 
                            <div class="col-lg-1">
                                <label class ="labels">Naam</label>
                            </div>
                            <div class="col-lg-11">
                                <input type="text" placeholder="Naam" name="Naam">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-lg-1">
                                <label class ="labels5">Email</label>
                            </div>
                            <div class="col-lg-11">
                                <input type="text" placeholder="Email" value="" name="Email">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-lg-1">
                                 <label class ="labels2">Wachtwoord</label>
                            </div>
                            <div class="col-lg-11">
                                 <input type="password" placeholder="Wachtwoord" name="Wachtwoord">
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-lg-1">
                                <label class ="labels4">Telefoon</label>
                            </div>
                            <div class="col-lg-11">
                                <input type="text" placeholder="Telefoon" name="Telefoon">
                            </div>
                        </div>

                        <div class="Bcontainer">
                            <div class="toevoegenR"><input type="submit" value="toevoegen" name="toevoegen"></div>
                            <div class="annuleerR"><input type="submit" value="Annuleer" name="Annuleer"></div>
                        </div>

                    </form>    
                </div>
            </div> 
        </div>    
    </body>
</html>