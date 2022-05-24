    <?php 
        session_start();
        require_once "dbh.php";
        require_once "ingelogdphp.php";


            if($_SESSION["loggedin"] == false)
            {
                header("location: index.php");
            }

        	if(isset($_POST['Annuleer']))
            {
                $_SESSION["loggedin"] = false;
                header("location: index.php");
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
    <link rel="stylesheet" href="css/styles.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    
    <title>Ingelogd </title>
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
                                <button type="button" class="btn btn-info" onclick="OpenSwalHerbegen()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </head>
                    <tbody>
                         <?php echo $HerbergTable;?>
                    </tbody>    
                </table>

        <?php 
            $varHerberg = '<form action="ingelogd.php" method="post" autocomplete="off">';
            $varHerberg .= '<div class="form-group">';
            $varHerberg .= '<label>Naam:</label>';
            $varHerberg .= '<input type="text" placeholder="Naam" name="naam" class="form-control">';
            $varHerberg .= '</div><div class="form-group">';
            $varHerberg .= '<label>Adres:</label>';
            $varHerberg .= '<input type="text" placeholder="Adres" name="Adres" class="form-control">';
            $varHerberg .= '</div><div class="form-group">';
            $varHerberg .= '<label>Email:</label>';
            $varHerberg .= '<input type="text" placeholder="Email" name="Email" class="form-control">';
            $varHerberg .= '</div><div class="form-group">';
            $varHerberg .= '<label>Mobiel Telefoonnummer:</label>';
            $varHerberg .= '<input type="text" placeholder="Telefoonnumer" name="Telefoon" class="form-control">';
            $varHerberg .= '</div><div class="form-group">';
            $varHerberg .= '<label>Coördinaten:</label>';
            $varHerberg .= '<input type="text" placeholder="Coördinaten N??.????? E??.?????" name="Coördinaten" class="form-control">';
            $varHerberg .= '</div><div class="form-group">';
            $varHerberg .= '<br />';
            $varHerberg .= '<input type="submit" class="btn btn-success" name="BewarenHerberg" value="Bewaren">';
            $varHerberg .= '  ';
            $varHerberg .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
            $varHerberg .= '</div>';
            $varHerberg .= '</form>';
        ?>
                <script type="text/javascript">
                    
                    function OpenSwalHerbegen()
                    {
                        var title = "Nieuwe Herberg";
                        var html = '<?php echo $varHerberg;?>';

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

                </script>

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
                                 <button type="button" class="btn btn-info" onclick="OpenSwalRestaurants()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        <?php echo $restaurantsTable;?>
                    </tbody>    
                </table>

                <?php 
                    $varRestaurants = '<form action="ingelogd.php" method="post" autocomplete="off">';
                    $varRestaurants .= '<div class="form-group">';
                    $varRestaurants .= '<label>Naam:</label>';
                    $varRestaurants .= '<input type="text" placeholder="Naam" name="naam" class="form-control">';
                    $varRestaurants .= '</div><div class="form-group">';
                    $varRestaurants .= '<label>Adres:</label>';
                    $varRestaurants .= '<input type="text" placeholder="Adres" name="Adres" class="form-control">';
                    $varRestaurants .= '</div><div class="form-group">';
                    $varRestaurants .= '<label>Email:</label>';
                    $varRestaurants .= '<input type="text" placeholder="Email" name="Email" class="form-control">';
                    $varRestaurants .= '</div><div class="form-group">';
                    $varRestaurants .= '<label>Mobiel Telefoonnummer:</label>';
                    $varRestaurants .= '<input type="text" placeholder="Telefoonnumer" name="Telefoon" class="form-control">';
                    $varRestaurants .= '</div><div class="form-group">';
                    $varRestaurants .= '<label>Coördinaten:</label>';
                    $varRestaurants .= '<input type="text" placeholder="Coördinaten N??.????? E??.?????" name="Coördinaten" class="form-control">';
                    $varRestaurants .= '</div><div class="form-group">';
                    $varRestaurants .= '<br />';
                    $varRestaurants .= '<input type="submit" class="btn btn-success" name="BewarenRestaurant" value="Bewaren">';
                    $varRestaurants .= '  ';
                    $varRestaurants .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
                    $varRestaurants .= '</div>';
                    $varRestaurants .= '</form>';
                ?>

                <script>
                function OpenSwalRestaurants()
                    {
                        var title = "Nieuwe Restaurant";
                        var html = '<?php echo $varRestaurants;?>';

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
                </script>
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
                                  <button type="button" class="btn btn-info" onclick="OpenSwalTochten()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </head>
                    <tbody>
                        <?php echo $TochtenTable;?>
                    </tbody>    
                </table>

                <?php 
            $varTocht = '<form action="ingelogd.php" method="post" autocomplete="off">';
            $varTocht .= '<div class="form-group">';
            $varTocht .= '<label>Omschrijvingen:</label>';
            $varTocht .= '<input type="text" placeholder="Omschrijving" name="Omschrijving" class="form-control">';
            $varTocht .= '</div><div class="form-group">';
            $varTocht .= '<label>Route Naam:</label>';
            $varTocht .= '<input type="text" placeholder="Route Naam" name="RouteNaam" class="form-control">';
            $varTocht .= '</div><div class="form-group">';
            $varTocht .= '<label>Aantal Dagen:</label>';
            $varTocht .= '<input type="number" placeholder="Aantal Dagen" name="AantalDagen" class="form-control">';
            $varTocht .= '</div><div class="form-group">';
            $varTocht .= '<br />';
            $varTocht .= '<input type="submit" class="btn btn-success" name="BewarenTocht" value="Bewaren">';
            $varTocht .= '  ';
            $varTocht .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
            $varTocht .= '</div>';
            $varTocht .= '</form>';
        ?>
                <script type="text/javascript">
                    
                    function OpenSwalTochten()
                    {
                        var title = "Nieuwe Tocht";
                        var html = '<?php echo $varTocht;?>';

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

                </script>
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
                                 <button type="button" class="btn btn-info" onclick="OpenSwalStatussen()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </head>
                    <tbody>
                    <?php echo $StatusTable;?>
                    </tbody>    
                </table>

                <?php 
            $varStatus = '<form action="ingelogd.php" method="post" autocomplete="off">';
            $varStatus .= '<div class="form-group">';
            $varStatus .= '<label>StatusCode:</label>';
            $varStatus .= '<input type="number" placeholder="StatusCode" name="StatusCode" class="form-control">';
            $varStatus .= '</div><div class="form-group">';
            $varStatus .= '<label>Status Omschrijving:</label>';
            $varStatus .= '<input type="text" placeholder="Status Omschrijving" name="StatusOmschrijving" class="form-control">';
            $varStatus .= '</div><div class="form-group">';
            $varStatus .= '<input type="checkbox" name="Verwijderbaar" value="1">';
            $varStatus .= '<label>Verwijderbaar</label><br>';
            $varStatus .= '<input type="checkbox" name="PinToekennen" value="1">';
            $varStatus .= '<label>Pin Toekennen</label><br>';
            $varStatus .= '</div><div class="form-group">';
            $varStatus .= '<br />';
            $varStatus .= '<input type="submit" class="btn btn-success" name="BewarenStatus" value="Bewaren">';
            $varStatus .= '  ';
            $varStatus .= '<input type="submit" class="btn btn-warning" name="Annuleren" value="Annuleren">';
            $varStatus .= '</div>';
            $varStatus .= '</form>';
        ?>
                <script type="text/javascript">
                    
                    function OpenSwalStatussen()
                    {
                        var title = "Nieuwe Status";
                        var html = '<?php echo $varStatus;?>';

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

                </script>
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

