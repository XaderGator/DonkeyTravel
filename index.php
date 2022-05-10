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

	$voornaam = $_POST['Voornaam'];
	$achternaam = $_POST['Achternaam'];
	$email = $_POST['Email'];
	$adres = $_POST['Adres'];
	$postcode = $_POST['Postcode'];
	$plaats = $_POST['Plaats'];
	$telefoonnummer = $_POST['Telefoonnummer'];



	$sql = "INSERT INTO customer (Voornaam, Achternaam, Email, Adres, Postcode, Plaats, Telefoonnummer) 
			VALUES ('$voornaam', '$achternaam', '$email', '$adres', '$postcode', '$plaats', '$telefoonnummer');";
		mysqli_query($con, $sql);

	header("location: index.php?signup=success");
?>

</body>
</html>




