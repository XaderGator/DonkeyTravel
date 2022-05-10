<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingelogd</title>
</head>
<body>
    <?php 
    session_start();
    
        	if(isset($_POST['Annuleer']))
            {
                $_SESSION["loggedin"] = false;
                header("location: index.php");
            }
    ?>
<div class="container-fluid containerklant">
            <form action="ingelogd.php" method="post">
                <table class="table table-bordered tableclass" >
                    <thead>
                    </thead>
                    <tbody>
						<tr>
                            <td colspan="4" align="right"><input type="submit" value="Annuleer" name="Annuleer"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
</body>
</html>