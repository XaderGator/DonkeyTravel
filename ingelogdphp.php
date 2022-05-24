<?php

if(isset($_POST['BewarenHerberg']))
{
    $Vandaag = date("Y-m-d H:i:s");

    $herbergNaam = $_POST['naam'];
    $herbergAdres = $_POST['Adres'];
    $herbergEmail = $_POST['Email'];
    $herbergTelefoon = $_POST['Telefoon'];
    $herbergCoördinaten = $_POST['Coördinaten'];

        $Gewijzigd = $Vandaag;

        $QueryInsertHerberg = "INSERT INTO herbergen (Naam, Adres, Email, Telefoon, Coordinaten, Gewijzigd) 
                VALUES ('$herbergNaam', '$herbergAdres', '$herbergEmail', '$herbergTelefoon', '$herbergCoördinaten', '$Gewijzigd');";
        mysqli_query($conn, $QueryInsertHerberg);

        header("location: ingelogd.php");
    
}

if(isset($_POST['BewarenRestaurant']))
{
    $Vandaag = date("Y-m-d H:i:s");

    $restaurantsNaam = $_POST['naam'];
    $restaurantsAdres = $_POST['Adres'];
    $restaurantsEmail = $_POST['Email'];
    $restaurantsTelefoon = $_POST['Telefoon'];
    $restaurantsCoördinaten = $_POST['Coördinaten'];

        $Gewijzigd = $Vandaag;

        $QueryInsertrestaurants = "INSERT INTO restaurants (Naam, Adres, Email, Telefoon, Coordinaten, Gewijzigd) 
                VALUES ('$restaurantsNaam', '$restaurantsAdres', '$restaurantsEmail', '$restaurantsTelefoon', '$restaurantsCoördinaten', '$Gewijzigd');";
        mysqli_query($conn, $QueryInsertrestaurants);

        header("location: ingelogd.php");
    
}

if(isset($_POST['BewarenTocht']))
{

    $TochtOmschrijving = $_POST['Omschrijving'];
    $TochtRouteNaam = $_POST['RouteNaam'];
    $TochtAantalDagen = $_POST['AantalDagen'];

        $QueryInsertTocht = "INSERT INTO tochten (Omschrijving, Route, AantalDagen) 
                VALUES ('$TochtOmschrijving', '$TochtRouteNaam', '$TochtAantalDagen');";
        mysqli_query($conn, $QueryInsertTocht);

        header("location: ingelogd.php");
    
}

if(isset($_POST['BewarenStatus']))
{

    $StatusCode = $_POST['StatusCode'];
    $StatusOmschrijving = $_POST['StatusOmschrijving'];

    if (isset($_POST['Verwijderbaar'])) {
        $StatusVerwijderbaar = $_POST['Verwijderbaar'];
    } else {
        $StatusVerwijderbaar = '0';
    }

    if (isset($_POST['PinToekennen'])) {
        $StatusPinToekennen = $_POST['PinToekennen'];
    } else {
        $StatusPinToekennen = '0';
    }

        $QueryInsertStatus = "INSERT INTO statussen (StatusCode, Status, Verwijderbaar, PINtoekennen) 
                VALUES ('$StatusCode', '$StatusOmschrijving', '$StatusVerwijderbaar', '$StatusPinToekennen');";
        mysqli_query($conn, $QueryInsertStatus);

        // header("location: ingelogd.php");
    
}

$QueryGasten = "SELECT Naam, Email, Telefoon FROM klanten";
$resultgasten=$conn->query($QueryGasten);
 $GastenTable = '';
 while ($Gastenrow = $resultgasten->fetch_assoc())  {
    $GastenTable .="<tr>";
    $GastenTable .="<td>";
    $GastenTable .=$Gastenrow['Naam'] . " "; // Naam
    $GastenTable .="</td>";
    $GastenTable .="<td>";
    $GastenTable .=$Gastenrow['Email'] . " "; // Email
    $GastenTable .="</td>";
    $GastenTable .="<td>";
    $GastenTable .=$Gastenrow['Telefoon']; // Telefoon
    $GastenTable .="</td>";
    $GastenTable .="</tr>";   
}

$QueryHerberg = "SELECT Naam, Adres, Email, Telefoon, Coordinaten FROM herbergen";
$resultHerberg=$conn->query($QueryHerberg);
 $HerbergTable = '';
 while ($Herbergrow = $resultHerberg->fetch_assoc())  {
    $HerbergTable .="<tr>";
    $HerbergTable .="<td>";
    $HerbergTable .=$Herbergrow['Naam'] . " "; // Naam
    $HerbergTable .="</td>";
    $HerbergTable .="<td>";
    $HerbergTable .=$Herbergrow['Adres'] . " "; // Adres
    $HerbergTable .="</td>";
    $HerbergTable .="<td>";
    $HerbergTable .=$Herbergrow['Email'] . " "; // Email
    $HerbergTable .="</td>";
    $HerbergTable .="<td>";
    $HerbergTable .=$Herbergrow['Telefoon']; // Telefoon
    $HerbergTable .="</td>";
    $HerbergTable .="<td>";
    $HerbergTable .=$Herbergrow['Coordinaten']; // Coordinaten
    $HerbergTable .="</td>";
    $HerbergTable .="<td>";
    $HerbergTable .= ""; // Extra
    $HerbergTable .="</td>";
    $HerbergTable .="</tr>";   
}

$Queryrestaurants = "SELECT Naam, Adres, Email, Telefoon, Coordinaten FROM restaurants";
$resultrestaurants=$conn->query($Queryrestaurants);
 $restaurantsTable = '';
 while ($restaurantsrow = $resultrestaurants->fetch_assoc())  {
    $restaurantsTable .="<tr>";
    $restaurantsTable .="<td>";
    $restaurantsTable .=$restaurantsrow['Naam'] . " "; // Naam
    $restaurantsTable .="</td>";
    $restaurantsTable .="<td>";
    $restaurantsTable .=$restaurantsrow['Adres'] . " "; // Adres
    $restaurantsTable .="</td>";
    $restaurantsTable .="<td>";
    $restaurantsTable .=$restaurantsrow['Email'] . " "; // Email
    $restaurantsTable .="</td>";
    $restaurantsTable .="<td>";
    $restaurantsTable .=$restaurantsrow['Telefoon']; // Telefoon
    $restaurantsTable .="</td>";
    $restaurantsTable .="<td>";
    $restaurantsTable .=$restaurantsrow['Coordinaten']; // Coordinaten
    $restaurantsTable .="</td>";
    $restaurantsTable .="<td>";
    $restaurantsTable .= ""; // Extra
    $restaurantsTable .="</td>";
    $restaurantsTable .="</tr>";   
}

$QueryTochten = "SELECT Omschrijving, Route, AantalDagen FROM tochten";
$resultTochten=$conn->query($QueryTochten);
 $TochtenTable = '';
 while ($Tochtenrow = $resultTochten->fetch_assoc())  {
    $TochtenTable .="<tr>";
    $TochtenTable .="<td>";
    $TochtenTable .=$Tochtenrow['Omschrijving'] . " "; // Omschrijving
    $TochtenTable .="</td>";
    $TochtenTable .="<td>";
    $TochtenTable .=$Tochtenrow['Route'] . " "; // Route
    $TochtenTable .="</td>";
    $TochtenTable .="<td>";
    $TochtenTable .=$Tochtenrow['AantalDagen'] . " "; // AantalDagen
    $TochtenTable .="</td>";
    $TochtenTable .="<td>";
    $TochtenTable .= ""; // Extra
    $TochtenTable .="</td>";
    $TochtenTable .="</tr>";   
}

$QueryStatussen = "SELECT StatusCode, Status, Verwijderbaar, PINtoekennen FROM statussen";
$resultStatus=$conn->query($QueryStatussen);
 $StatusTable = '';
 while ($Statusrow = $resultStatus->fetch_assoc())  {
     if($Statusrow['Verwijderbaar'] == '1')
     {
        $StatusVerwijder = 'Ja';
     }else
     {
        $StatusVerwijder = 'nee';
     }

     if($Statusrow['PINtoekennen'] == '1')
     {
        $StatusPin = 'Ja';
     }else
     {
        $StatusPin = 'nee';
     }
     
    $StatusTable .="<tr>";
    $StatusTable .="<td>";
    $StatusTable .=$Statusrow['StatusCode'] . " "; // StatusCode
    $StatusTable .="</td>";
    $StatusTable .="<td>";
    $StatusTable .=$Statusrow['Status'] . " "; // Status
    $StatusTable .="</td>";
    $StatusTable .="<td>";
    $StatusTable .=$StatusVerwijder . " "; // Verwijderbaar
    $StatusTable .="</td>";
    $StatusTable .="<td>";
    $StatusTable .=$StatusPin . " "; // PINtoekennen
    $StatusTable .="</td>";
    $StatusTable .="<td>";
    $StatusTable .= ""; // Extra
    $StatusTable .="</td>";
    $StatusTable .="</tr>";   
}

?>