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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST["register"]))
{
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

<form method="POST">
    <input type="text" name="name" placeholder="Enter name" required />
    <input type="email" name="email" placeholder="Enter email" required />
    <input type="password" name="password" placeholder="Enter password" required />

    <input type="submit" name="register" value="Register" required />
</form>


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
    <body>
        <div class="container">
            <div class="card my-4">
                <div class="card-header">
                    <div class="card-title">
                        <h1>
                        Registratie
                        </h1>
                    </div>
                </div>
                <div class="card-body">
                    <form action="registratie.php" method="post" autocomplete="off">
                        <div class="mb-3">
                            <label class="label" for="Naam">Naam</label>
                            <input type="text" placeholder="Naam" name="Naam" id="Naam" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="label" for="Email">Email</label>
                            <input type="email" placeholder="Email" name="Email" id="Email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="label" for="Wachtwoord">Wachtwoord</label>
                            <input type="password" placeholder="Wachtwoord" name="Wachtwoord" id="Wachtwoord" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="label" for="Telefoon">Telefoon</label>
                            <input type="text" placeholder="Telefoon" name="Telefoon" id="Telefoon" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Toevoegen" name="toevoegen" class="btn btn-success">
                            <input type="submit" value="Annuleer" name="Annuleer" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </body>
</html>