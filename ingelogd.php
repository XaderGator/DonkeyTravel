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
    <button type="button" class="btn btn-success" onclick="OpenSwalPincode()">
            Pincode
    </button>
    <form action="ingelogd.php" method="post">
        <input type="submit" value="Uitloggen" name="Annuleer">
    </form>
  </div>
</div>

    <?php 

        //Maakt een form voor de pincode
        $varPincode = '<form action="ingelogd.php" method="post" autocomplete="off">';
        $varPincode .= '<div class="form-group">';
        $varPincode .= '<label>Pincode:</label>';
        $varPincode .= '<input type="text" placeholder="Pincode" name="Pincode" class="form-control">';
        $varPincode .= '</div>';
        $varPincode .= '</form>';

    ?>


    <script>
        function OpenSwalPincode()
        {
            var title = "Pincode";
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

