<?php
        require_once "dbh.php";

    //kijkt naar of je op de bewaren knop hebt gedrukt en voegt het toe aan de database
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

            header("location: boekingen.php");
        
    }
    //kijkt naar of je op de bewaren knop hebt gedrukt en voegt het toe aan de database

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

            header("location: boekingen.php");
        
    }

    //kijkt naar of je op de bewaren knop hebt gedrukt en voegt het toe aan de database
    if(isset($_POST['BewarenTocht']))
    {

        $TochtOmschrijving = $_POST['Omschrijving'];
        $TochtRouteNaam = $_POST['RouteNaam'];
        $TochtAantalDagen = $_POST['AantalDagen'];

            $QueryInsertTocht = "INSERT INTO tochten (Omschrijving, Route, AantalDagen) 
                    VALUES ('$TochtOmschrijving', '$TochtRouteNaam', '$TochtAantalDagen');";
            mysqli_query($conn, $QueryInsertTocht);

            header("location: boekingen.php");
        
    }
    
    //kijkt naar of je op de bewaren knop hebt gedrukt en voegt het toe aan de database
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

            // header("location: boekingen.php");
        
    }

    //haalt alles op uit de database en stopt het in een table
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

    //haalt alles op uit de database en stopt het in een table
    $QueryHerberg = "SELECT ID, Naam, Adres, Email, Telefoon, Coordinaten FROM herbergen";
    $resultHerberg=$conn->query($QueryHerberg);
    $HerbergTable = '';
    while ($Herbergrow = $resultHerberg->fetch_assoc())  {
        $HerbergTable .='<tr>';
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
        $HerbergTable .= '<button type="button" class="btn btn-warning">'; // Extra
        $HerbergTable .= '<i class="fa-light fa-ellipsis"></i>';// Extra
        $HerbergTable .= '</button>';// Extra
        $HerbergTable .= '  ';
        $HerbergTable .= '<button type="button" class="btn btn-danger" onclick="">'; // Extra
        $HerbergTable .= '<i class="fa-thin fa-x"></i>';// Extra
        $HerbergTable .= '</button>';// Extra
        $HerbergTable .="</td>";
        $HerbergTable .="</tr>";   

    }

    //haalt alles op uit de database en stopt het in een table
    $Queryrestaurants = "SELECT ID, Naam, Adres, Email, Telefoon, Coordinaten FROM restaurants";
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
        $restaurantsTable .= '<button type="button" class="btn btn-warning" onclick="">'; // Extra
        $restaurantsTable .= '<i class="fa-light fa-ellipsis"></i>';// Extra
        $restaurantsTable .= '</button>';// Extra
        $restaurantsTable .= '  ';
        $restaurantsTable .= '<button type="button" class="btn btn-danger" onclick="">'; // Extra
        $restaurantsTable .= '<i class="fa-thin fa-x"></i>';// Extra
        $restaurantsTable .= '</button>';// Extra
        $restaurantsTable .="</td>";
        $restaurantsTable .="</tr>";   
    }

    //haalt alles op uit de database en stopt het in een table
    $QueryTochten = "SELECT ID, Omschrijving, Route, AantalDagen FROM tochten";
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
        $TochtenTable .= '<button type="button" class="btn btn-warning" onclick="">'; // Extra
        $TochtenTable .= '<i class="fa-light fa-ellipsis"></i>';// Extra
        $TochtenTable .= '</button>';// Extra
        $TochtenTable .= '  ';
        $TochtenTable .= '<button type="button" class="btn btn-danger" onclick="">'; // Extra
        $TochtenTable .= '<i class="fa-thin fa-x"></i>';// Extra
        $TochtenTable .= '</button>';// Extra
        $TochtenTable .="</td>";
        $TochtenTable .="</tr>";   
    }

    //haalt alles op uit de database en stopt het in een table
    $QueryStatussen = "SELECT ID, StatusCode, Status, Verwijderbaar, PINtoekennen FROM statussen";
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
        $StatusTable .= '<button type="button" class="btn btn-warning" onclick="">'; // Extra
        $StatusTable .= '<i class="fa-light fa-ellipsis"></i>';// Extra
        $StatusTable .= '</button>';// Extra
        $StatusTable .= '  ';
        $StatusTable .= '<button type="button" class="btn btn-danger" onclick="">'; // Extra
        $StatusTable .= '<i class="fa-thin fa-x"></i>';// Extra
        $StatusTable .= '</button>';// Extra
        $StatusTable .="</td>";
        $StatusTable .="</tr>";   
    }

    //Maakt een form voor het toevoegen van de benodigde gegevens aan de database
    $varHerberg = '<form action="boekingen.php" method="post" autocomplete="off">';
    $varHerberg .= '<div class="centertab">';
    $varHerberg .= '<label>Naam:</label>';
    $varHerberg .= '<input type="text" placeholder="Naam" name="naam" class="centertab">';
    $varHerberg .= '</div><div class="centertab">';
    $varHerberg .= '<label>Adres:</label>';
    $varHerberg .= '<input type="text" placeholder="Adres" name="Adres" class="centertab">';
    $varHerberg .= '</div><div class="centertab">';
    $varHerberg .= '<label>Email:</label>';
    $varHerberg .= '<input type="text" placeholder="Email" name="Email" class="centertab">';
    $varHerberg .= '</div><div class="centertab">';
    $varHerberg .= '<label>Telefoonnummer:</label>';
    $varHerberg .= '<input type="text" placeholder="Telefoonnumer" name="Telefoon" class="centertab">';
    $varHerberg .= '</div><div class="centertab">';
    $varHerberg .= '<label>Coördinaten:</label>';
    $varHerberg .= '<input type="text" placeholder="Coördinaten N??.????? E??.?????" name="Coördinaten" class="centertab">';
    $varHerberg .= '</div><div class="centertab">';
    $varHerberg .= '<br />';
    $varHerberg .= '<input type="submit" class="btn btn-success" name="BewarenHerberg" value="Bewaren">';
    $varHerberg .= '  ';
    $varHerberg .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
    $varHerberg .= '</div>';
    $varHerberg .= '</form>';

    //Maakt een form voor het toevoegen van de benodigde gegevens aan de database
    $varRestaurants = '<form action="boekingen.php" method="post" autocomplete="off">';
    $varRestaurants .= '<div class="centertab">';
    $varRestaurants .= '<label>Naam:</label>';
    $varRestaurants .= '<input type="text" placeholder="Naam" name="naam" class="centertab">';
    $varRestaurants .= '</div><div class="centertab">';
    $varRestaurants .= '<label>Adres:</label>';
    $varRestaurants .= '<input type="text" placeholder="Adres" name="Adres" class="centertab">';
    $varRestaurants .= '</div><div class="centertab">';
    $varRestaurants .= '<label>Email:</label>';
    $varRestaurants .= '<input type="text" placeholder="Email" name="Email" class="centertab">';
    $varRestaurants .= '</div><div class="centertab">';
    $varRestaurants .= '<label>Telefoonnummer:</label>';
    $varRestaurants .= '<input type="text" placeholder="Telefoonnumer" name="Telefoon" class="centertab">';
    $varRestaurants .= '</div><div class="centertab">';
    $varRestaurants .= '<label>Coördinaten:</label>';
    $varRestaurants .= '<input type="text" placeholder="Coördinaten N??.????? E??.?????" name="Coördinaten" class="centertab">';
    $varRestaurants .= '</div><div class="centertab">';
    $varRestaurants .= '<br />';
    $varRestaurants .= '<input type="submit" class="btn btn-success" name="BewarenRestaurant" value="Bewaren">';
    $varRestaurants .= '  ';
    $varRestaurants .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
    $varRestaurants .= '</div>';
    $varRestaurants .= '</form>';

    //Maakt een form voor het toevoegen van de benodigde gegevens aan de database
    $varTocht = '<form action="boekingen.php" method="post" autocomplete="off">';
    $varTocht .= '<div class="centertab">';
    $varTocht .= '<label>Omschrijvingen:</label>';
    $varTocht .= '<input type="text" placeholder="Omschrijving" name="Omschrijving" class="centertab">';
    $varTocht .= '</div><div class="centertab">';
    $varTocht .= '<label>Route Naam:</label>';
    $varTocht .= '<input type="text" placeholder="Route Naam" name="RouteNaam" class="centertab">';
    $varTocht .= '</div><div class="centertab">';
    $varTocht .= '<label>Aantal Dagen:</label>';
    $varTocht .= '<input type="number" placeholder="Aantal Dagen" name="AantalDagen" class="centertab">';
    $varTocht .= '</div><div class="centertab">';
    $varTocht .= '<br />';
    $varTocht .= '<input type="submit" class="btn btn-success" name="BewarenTocht" value="Bewaren">';
    $varTocht .= '  ';
    $varTocht .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
    $varTocht .= '</div>';
    $varTocht .= '</form>';

    //Maakt een form voor het toevoegen van de benodigde gegevens aan de database
    $varStatus = '<form action="boekingen.php" method="post" autocomplete="off">';
    $varStatus .= '<div class="centertab">';
    $varStatus .= '<label>StatusCode:</label>';
    $varStatus .= '<input type="number" placeholder="StatusCode" name="StatusCode" class="centertab">';
    $varStatus .= '</div><div class="centertab">';
    $varStatus .= '<label>Status Omschrijving:</label>';
    $varStatus .= '<input type="text" placeholder="Status Omschrijving" name="StatusOmschrijving" class="centertab">';
    $varStatus .= '</div><div class="centertab">';
    $varStatus .= '<input type="checkbox" name="Verwijderbaar" value="1">';
    $varStatus .= '<label>Verwijderbaar</label><br>';
    $varStatus .= '<input type="checkbox" name="PinToekennen" value="1">';
    $varStatus .= '<label>Pin Toekennen</label><br>';
    $varStatus .= '</div><div class="centertab">';
    $varStatus .= '<br />';
    $varStatus .= '<input type="submit" class="btn btn-success" name="BewarenStatus" value="Bewaren">';
    $varStatus .= '  ';
    $varStatus .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
    $varStatus .= '</div>';
    $varStatus .= '</form>';
?>