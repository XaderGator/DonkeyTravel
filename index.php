<?php 

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ingelogd.php");
    exit;
}
 

require_once "dbh.php";
 

$username = $password = $email = "";
$username_err = $password_err = $email_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "vul jouwn naam in";
    } else{
        $username = trim($_POST["username"]);
    }
    

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
	

    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT ID, Naam, Email, Wachtwoord FROM klanten WHERE Naam = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = $username;
            

            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
							$_SESSION["email"] = $email; 
                            $_SESSION["username"] = $username;                            
                            

                            header("location: ingelogd.php");
                        } else{

                            $login_err = "foute naam of wachtwoord";
                        }
                    }
                } else{

                    $login_err = "foute naam of wachtwoord";
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
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Login Hier</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>naam</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
			 <div class="form-group">
                <label>email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>  
            <div class="form-group">
                <label>wachtwoord</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>geen account? <a href="registratie.php">registreer  nu</a>.</p>
            
        </form>
    </div>
</body>
</html>

