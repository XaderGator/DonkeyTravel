<?php 

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ingelogd.php");
    exit;
}
if(isset($_POST['Maakerhiereentjeaan!']))
{
    header("location: registratie.php");
}

require_once "dbh.php";
 
$email = $password = "";
$email_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){   

    if(empty(trim($_POST["password"]))){
        $password_err = "vul jouwn wachtwoord in";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["email"]))){
        $email_err = "vul jouwn email in";
    } else{
        $email = trim($_POST["email"]);
    }
	

    if(empty($email_err) && empty($password_err)){

        $sql = "SELECT ID, Email, Wachtwoord FROM klanten WHERE Email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_email);
            

            $param_email = $email;
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            

                            $_SESSION["loggedin"] = true;
                            $_SESSION["KlantenID"] = $id;
							$_SESSION["email"] = $email;                         
                            

                            header("location: ingelogd.php");
                        } else{

                            $login_err = "foute Email of wachtwoord";
                        }
                    }
                } else{

                    $login_err = "foute Email of wachtwoord";
                }
            } else{
                echo "er is iets fout gegaan probeer later";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    mysqli_close($conn);
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script><title>Ingelogd</title>

    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="donkey.jpg" type="image/jpg">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Mijn Donkey Travel inloggen</h2>    
                        </div>
                    </div>
                    <div class="card-body">
                        <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">  
                            <label>E-mailadres</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            <label>Wachtwoord</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <div class="btn-group my-1">
                                <button type="submit" name="Maakerhiereentjeaan!" class="btn btn-info">
                                    Register
                                </button>
                                <button type="submit" name="submit" class="btn btn-success">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>