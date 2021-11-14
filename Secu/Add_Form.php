<!DOCTYPE html>

<link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']).'Css/style.css' ?>">
<script type="text/javascript" src="script.js"></script>
<?php
    require_once 'fonctions.php';
    

    
    #Array for record of error codes
    $errors = [];
    #If the user name and the password are not empty we continue
    if(isset($_POST['new_user_name']) && isset($_POST['new_user_password']) && isset($_POST['new_user_name']))
    {
        #Check is the parameters are not empty
        if($_POST['new_user_name'] != "" && $_POST['new_user_password']!="" && $_POST['new_user_name'] != ""){
            #If the user name is too big or use non valid characters we add an error
            if(strlen($_POST['new_user_name'])>40 || strlen($_POST['new_user_name'])<8 ||!preg_match('/^[a-zA-Z]+$/', $_POST['new_user_name'])){
                $errors[] = 2;
                echo '<script type="text/javascript">
                alert("User name isn t correct. Must be between 8 and 40 char");
                </script>';
                
            }
            #If the password is too long, too short, don't contain atleast one lower and upper case and one special char we add an error
        
            if(strlen($_POST['new_user_password'])>255 || strlen($_POST['new_user_password'])<8  || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\~?!@#\$%\^&\*])(?=.{8,})/', $_POST['new_user_password']))
            {
                $errors[] = 3;
                echo '<script type="text/javascript">
                alert("Password not strong at least 8 lenght, number, special char, upper and lower case");
                </script>';
            }
                
            
            #If bad confirm password add an error
            if(isset($_POST['new_user_password_confirm']) && $_POST['new_user_password_confirm'] != $_POST['new_user_password'])
            {
                $errors[] = 4;
                echo '<script type="text/javascript">
                alert("Passwords are not the same");
                </script>';
            }
            #Check if user exists
            if (isset($_POST['new_user_name']) && !user_exists_name($_POST['new_user_name'])){
                $errors[] = 5;
                echo '<script type="text/javascript">
                alert("User already exists");
                </script>';
            
            }


            #Check if we have errors
            if($errors[0]==""){
                #Check the token
                if(isset($_POST['csrf_token']) && validateToken($_POST['csrf_token'])){
                    #If the user doesn't exists we can and
                    $req = add_user($_POST['new_user_name'], $_POST['new_user_password']);
                    #Check if the request has ended succesfully
                    if($req != -1){
                        $result[] = 1;
                    }else{
                        $result[] = 0;
                    }      
                    if($result){
                        echo '<script type="text/javascript">
                            alert("Ajout Ok");
                            </script>';
                    }
                }
            }
        }
       
    }
    
     
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
        <title>Inscription</title>
    </head>

    <body>
        <header>
            <img width="150" height="100" src="up8.jpg">
            <form action="Add_Form.php" method="post">
                <div>
                    <label for="name">Identifiant :</label>
                    <input type="text" id="Iden" name="new_user_name">
                </div>

                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="new_user_password">
                </div>

                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="confirm-password" name="new_user_password_confirm">
                </div>

                <input type="hidden" name="csrf_token" id="hiddenField" value="<?php echo createToken();?>">

                
                <div class="button">
                    <button type="submit">OK</button>
                </div>

                <div class="button">
                    <button type="reset">Reset</button>
                </div>
            </form>
            <form action="index.php">
                <input type="submit" value="Acceuil" />
            </form>
        
        </header>
        



    </body>
</html>
