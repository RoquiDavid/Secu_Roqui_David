<!DOCTYPE html>
<?php
    include 'fonctions.php';
    
    #Si on recoit bien les paramètre du formulaire d'ajout alors on appelle la fonction d'ajout
    #print("ok: ".user_exists($_POST['user_name'], $_POST['user_password']));
    try 
    {
        if( isset($_POST['user_name']) && $_POST['user_name']!="" && isset($_POST['user_password']) && $_POST['user_password']!="")
        {

            if (!user_exists($_POST['user_name'], $_POST['user_password']))
            {
                session_start();

                //If the csrf token is not equal to the csrf token session's then it's a malicious request
                //And we delete him
                echo('Get token:');
                echo($_GET["csrf_token"]);
                echo('Session token:');
                echo($_SESSION["csrf_token"]);
                if ($_GET["csrf_token"] != $_SESSION["csrf_token"]) {
                    // Reset token
                    unset($_SESSION["csrf_token"]);
                    die("CSRF token validation failed");
                }
                //On hash les valeurs des sessions
                $_SESSION['user_name'] = encrypt_decrypt($_POST['user_name'], 'encrypt');
                $_SESSION['user_password'] = encrypt_decrypt($_POST['user_password'], 'encrypt');

                header("Location:login_succes.php");
            }

            else
            {

                $message = '<label>Faux</label>'; 

            }
        }

    }catch (PDOException $error)
    {
        $message = $error->getMessage(); 
    }
    

?>
<html>


    <head>
        <meta charset="utf-8" />
        <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
        <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']).'Css/index/style.css' ?>">
        <img src="<?php echo dirname($_SERVER['PHP_SELF']).'up8.jpg'?>"width="300" height="200">

        <title>Connection</title>

    </head>

    <body>

        <header>

            
            <form action="index.php" method="post">

                <div>

                    <label for="name">Identifiant :</label>
                    <input type="text" id="Iden" name="user_name">

                </div>
                <div>

                    <label for="mail">Mot de passe :</label>
                    <input type="password" id="password" name="user_password">

                </div>
                <div class="button">
                    <input type="hidden" name="csrf_token" value="<?php echo generate_token();?>" />
                    <button type="submit">OK</button>

                </div>

                <div class="button">
                    <button type="reset">Reset</button>
                </div>

            </form>

            <form action="Add_Form.php">
                <input type="hidden" name="csrf_token" value="<?php echo generate_token();?>" />
                <button type="submit">Inscription</button>

            </form>
            
        </header>
        


    </body>
</html>
