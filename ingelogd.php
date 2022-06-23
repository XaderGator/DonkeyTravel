    <?php 
        session_start();
        require_once "dbh.php";


            if($_SESSION["loggedin"] == false)
            {
                header("location: index.php");
            }

        	if(isset($_POST['AnnuleerInlog']))
            {
                $_SESSION["loggedin"] = false;
                header("location: index.php");
            }

            if(isset($_POST['TrekInPincode']))
            {//Delete Pincode

                $KlantenID = $_SESSION["KlantenID"];

                $QueryUpdatePincodeBoekingen = "UPDATE boekingen SET PINCode = '0' WHERE FKklantenID = '$KlantenID'";
                mysqli_query($conn, $QueryUpdatePincodeBoekingen);

                header("location: ingelogd.php");
            } 


            if(isset($_POST['WijzigenPincode']))
            {//Voeg pincode toe
                $Pincode = $_POST['Pincode'];
                $KlantenID = $_SESSION["KlantenID"];

                $QueryInsertPincodeBoekingen = "UPDATE boekingen SET PINCode = '$Pincode' WHERE FKklantenID = '$KlantenID'";
                mysqli_query($conn, $QueryInsertPincodeBoekingen);

                header("location: ingelogd.php");
            }

            if(isset($_POST['AnnulerenSwal']))
            {//Terug gaan naar pagina
                header("location: ingelogd.php");
            }

            if(isset($_POST['MakenBoekingen']))
            {//Voeg pincode toe
                $Vandaag = date("Y-m-d H:i:s");

                $FKtochtenID = $_POST['Tochten'];
                $FKklantenID = $_SESSION["KlantenID"];
                $FKstatussenID = $_POST['Statussen'];
                $Pincode = 0;
        
                $Gewijzigd = $Vandaag;

                $QueryInsertPincodeBoekingen = "INSERT INTO boekingen (`StartDatum`, `PINCode`, `FKtochtenID`, `FKklantenID`, `FKstatussenID`) 
                        VALUES ('$Gewijzigd', '$Pincode', '$FKtochtenID', '$FKklantenID', '$FKstatussenID');";
                mysqli_query($conn, $QueryInsertPincodeBoekingen);

                header("location: ingelogd.php");
            }

            $QueryTochten = "SELECT * FROM tochten";
            $resultTochten=$conn->query($QueryTochten);
            $varOptionSelectTochten = '';
            if($stmt = mysqli_prepare($conn, $QueryTochten)){
               while($rowTochten = $resultTochten->fetch_assoc())
               {
                if($rowTochten != NULL)
                {

                 $varOptionSelectTochten .=   '<option value="'.$rowTochten['ID'].'">'.$rowTochten['Omschrijving'].'-'.$rowTochten['Route'].'-'.$rowTochten['AantalDagen'].'</option>';

                }
               }
            }

            $QueryStatussen = "SELECT * FROM statussen";
            $resultStatussen=$conn->query($QueryStatussen);
            $varOptionSelectStatussen = '';
            if($stmt = mysqli_prepare($conn, $QueryStatussen)){
               while($rowStatussen = $resultStatussen->fetch_assoc())
               {
                if($rowStatussen != NULL)
                {

                 $varOptionSelectStatussen .= '<option value="'.$rowStatussen['ID'].'">'.$rowStatussen['StatusCode'].'-'.$rowStatussen['Status'].'-'.$rowStatussen['Verwijderbaar'].'-'.$rowStatussen['PINtoekennen'].'</option>';

                }
               }
            }
    ?>
    

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="donkey.jpg" type="image/jpg">


    <title>Ingelogd </title>
</head>
<body>

<div class="dropdown">
  <button onclick="dropdownFunction()" class="dropbtn">Menu</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="boekingen.php">boekingen</a>
    <a onclick="OpenSwalBoekingen()">Boeking Aanvragen</a>
    <?php
         $klantenid = $_SESSION['KlantenID'];

        $QueryBoekingen = "SELECT * FROM boekingen WHERE FKklantenID = '$klantenid'";
        $resultBoekingen=$conn->query($QueryBoekingen);
        if($stmt = mysqli_prepare($conn, $QueryBoekingen)){
            $rowBoekingen = $resultBoekingen->fetch_assoc();
            if($rowBoekingen != NULL)
            {
                $startdatum = $rowBoekingen['StartDatum'];
            }else
            {
                $startdatum = 'BoomSHAKALA'; 
            }
        }
            $dagvandaag = date("Y-m-d");


            if($startdatum <= $dagvandaag)
            {
                echo '<a onclick="OpenSwalPincode()">Pincode Navigatie</a>';
            }

    ?>

    <form action="ingelogd.php" method="post">
        <input type="submit" value="Uitloggen" name="AnnuleerInlog" class="form-control">
    </form>
  </div>
</div>

    <?php 

        //Maakt een form voor de pincode
        $varPincode = '<form action="ingelogd.php" method="post" autocomplete="off">';
        $varPincode .= '<div>';
        $varPincode .= '<label>Pincode</label>';
        $varPincode .= '<input type="number" placeholder="Pincode" name="Pincode">';
        $varPincode .= '</div>';
        $varPincode .= '<br />';
        $varPincode .= '<input type="submit" class="btn btn-danger" name="TrekInPincode" value="Trek In">';
        $varPincode .= '  ';
        $varPincode .= '<input type="submit" class="btn btn-success" name="WijzigenPincode" value="Wijzigen">';
        $varPincode .= '  ';
        $varPincode .= '<input type="submit" class="btn btn-warning" name="AnnulerenSwal" value="Annuleren">';
        $varPincode .= '</form>';

        //Maakt een form voor de Boekingen
        $varBoekingen = '<form action="ingelogd.php" method="post" autocomplete="off">';
        $varBoekingen .= '<select name="Tochten" id="Tochten">';
        $varBoekingen .= $varOptionSelectTochten;
        $varBoekingen .='</select>';
        $varBoekingen .= '<br />';
        $varBoekingen .= '<br />';
        $varBoekingen .= '<select name="Statussen" id="Statussen">';
        $varBoekingen .= $varOptionSelectStatussen;
        $varBoekingen .='</select>';
        $varBoekingen .= '<br />';
        $varBoekingen .= '<br />';
        $varBoekingen .= '<input type="submit" class="btn btn-success" name="MakenBoekingen" value="Toevoegen">';
        $varBoekingen .= '  ';
        $varBoekingen .= '<input type="submit" class="btn btn-warning" name="AnnulerenSwal" value="Annuleren">';
        $varBoekingen .= '</form>';

    ?>


    <script>
        function OpenSwalPincode()
        {
            var title = "Pincode Boekingen";
            var html = '<?php echo $varPincode;?>';

            Swal.fire({
            title: "<b><h2>"+title+"</h2></b>", 
            html: html,  
            showCancelButton: false, 
            showConfirmButton: false,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
            });
        }

        function OpenSwalBoekingen()
        {
            var title = "Pincode Boekingen";
            var html = '<?php echo $varBoekingen;?>';

            Swal.fire({
            title: "<b><h2>"+title+"</h2></b>", 
            html: html,  
            showCancelButton: false, 
            showConfirmButton: false,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
            });
        }

            function dropdownFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
            }

            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
                }
            }
            }
    </script>
            </div>

           
</body>
</html>

