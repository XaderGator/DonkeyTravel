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

	$Naam = $_POST['Naam'];
	$Email = $_POST['Email'];
	$Telefoon = $_POST['Telefoon'];
	$Wachtwoord = $_POST['Wachtwoord'];
	$Gewijzigd = $_POST['Gewijzigd'];



	$sql = "INSERT INTO klanten (Naam, Email, Telefoon, Wachtwoord, Gewijzigd) 
			VALUES ('$Naam', '$Email', '$Telefoon', '$Wachtwoord', '$Gewijzigd');";
		mysqli_query($con, $sql);

	header("location: index.php?signup=success");
?>

</body>
</html>