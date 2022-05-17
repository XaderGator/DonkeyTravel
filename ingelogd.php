    <?php 
        session_start();
        require_once "dbh.php";


            if($_SESSION["loggedin"] == false)
            {
                header("location: index.php");
            }

        	if(isset($_POST['Annuleer']))
            {
                $_SESSION["loggedin"] = false;
                header("location: index.php");
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
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script><title>Ingelogd</title>
    <title>ingelogd </title>
</head>
<body>

        <div class="container-fluid">
            <form action="ingelogd.php" method="post">
                 <input type="submit" value="Uitloggen" name="Annuleer">
            </form>
        </div>
        <br />

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#Boekingen" class="nav-link active" data-bs-toggle="tab">Boekingen</a>
        </li>
        <li class="nav-item">
            <a href="#Beheer" class="nav-link" data-bs-toggle="tab">Beheer</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="Boekingen">

            <div class="tab">
                <button class="tablinks" onclick="tab(event, 'Gasten')" id="defaultOpen">Gasten</button>
                <button class="tablinks" onclick="tab(event, 'Herbergen')" id="HerbergenOpen">Herbergen</button>
                <button class="tablinks" onclick="tab(event, 'Restaurants')" id="RestaurantsOpen">Restaurants</button>
                <button class="tablinks" onclick="tab(event, 'Tochten')" id="TochtenOpen">Tochten</button>
                <button class="tablinks" onclick="tab(event, 'Statussen')" id="statussenOpen">Statussen</button>
            </div>

            <div id="Gasten" class="tabcontent">
                <h1> Gasten</h1>
                <table class="table table-striped table-hover">
                    <head>
                        <tr class="bg-success">
                            <td>
                                Naam
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Telefoon
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        <?php echo $GastenTable;?>
                    </tbody>    
                </table>
            </div>

            <div id="Herbergen" class="tabcontent">
            <h1> Herbergen</h1>
              <table class="table table-striped table-hover">
                    <head>
                        <tr class="bg-success">
                            <td>
                                Naam
                            </td>
                            <td>
                                Adres
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Telefoon
                            </td>
                            <td>
                                Coördinaten
                            </td>
                            <td>
                                +
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        
                    </tbody>    
                </table>
            </div>

            <div id="Restaurants" class="tabcontent">
            <h1> Restaurants</h1>
              <table class="table table-striped table-hover">
                    <head>
                        <tr class="bg-success">
                            <td>
                                Naam
                            </td>
                            <td>
                                Adres
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Telefoon
                            </td>
                            <td>
                                Coördinaten
                            </td>
                            <td>
                                +
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        
                    </tbody>    
                </table>
            </div>

            <div id="Tochten" class="tabcontent">
            <h1> Tochten</h1>
                 <table class="table table-striped table-hover">
                    <head>
                        <tr class="bg-success">
                            <td>
                                Omschrijving
                            </td>
                            <td>
                                Route Naam
                            </td>
                            <td>
                                Aantal Dagen
                            </td>
                            <td>
                                +
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        
                    </tbody>    
                </table>
            </div>

            <div id="Statussen" class="tabcontent">
            <h1> Statussen</h1>
                <table class="table table-striped table-hover">
                    <head>
                        <tr class="bg-success">
                            <td>
                                Code
                            </td>
                            <td>
                                Status
                            </td>
                            <td>
                                verwijderbaar
                            </td>
                            <td>
                                Pin toekennen
                            </td>
                            <td>
                                +
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        
                    </tbody>    
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="Beheer">

        </div>
    </div>
    

    


    <script>
            document.getElementById("defaultOpen").click();

        

            function tab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
            }
            


        </script>
</body>
</html>

