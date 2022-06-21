<?php 
        session_start();
        require_once "dbh.php";
        require_once "boekingenphp.php";


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
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="tabellen.css">
    <link rel="icon" href="donkey.jpg" type="image/jpg">


    <title>Boekingen </title>
</head>
<body>

<div class="dropdown">
  <button onclick="dropdownFunction()" class="dropbtn">Menu</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="boekingen.php">Home</a>
    <a href="#">Link 2</a>
    <form action="boekingen.php" method="post">
        <input type="submit" value="Uitloggen" name="Annuleer">
    </form>
  </div>
</div>


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
                <table class="styled-table">
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

                <script type="text/javascript">
                    
    //functie die een swal opent met de form
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

                <script>
    //functie die een swal opent met de form
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

                <p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15086.841832468324!2d29.775242616669296!3d-19.032476209016544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1snl!2snl!4v1654767817209!5m2!1snl!2snl" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </p>

                <script type="text/javascript">
                    
    //functie die een swal opent met de form
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

                <script type="text/javascript">
                    
    //functie die een swal opent met de form
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
              //clickt op de defaultopen tab zodat je automatisch de gasten lijst open hebt
            document.getElementById("defaultOpen").click();

        
        //functie zodat je tabs hebt op de pagina
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
</body>
</html>

