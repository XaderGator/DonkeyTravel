<!DOCTYPE html>
<html lang="nl">
<head>
        <title> Donkey Travel </title>
		<meta charset=utf-8>
		<meta name=description content="beschrijving">
		<meta name=keywords content="trefword, trefword">
		<link rel="stylesheet" href="styles.css">
	
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


<div class="container-fluid containerklant">
            <form action="registratie.php" method="post">
                <table class="table table-bordered tableclass" >
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td>Naam</td>
                            <td><input type="text" placeholder="Naam" name="Naam"></td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td> Email</td>
                            <td><input type="text" placeholder="Email" value="" name="Email"></td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Telefoon</td>
                            <td><input type="text" placeholder="Telefoon" name="Telefoon"></td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Wachtwoord</td>
                            <td><input type="password" placeholder="Wachtwoord" name="Wachtwoord"></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="right"><input type="submit" value="toevoegen" name="toevoegen"></td>
                        </tr>
						<tr>
                            <td colspan="4" align="right"><input type="submit" value="Annuleer" name="Annuleer"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

</body>
</html>