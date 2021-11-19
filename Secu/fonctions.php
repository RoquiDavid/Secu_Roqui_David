<?php
    include 'con.php'; #Call du script du connection a la BD
    include 'config.php';


    function add_user($name, $password)
    {
        $pdo = connect();

        try {   
            $date = getdate()['year'] ."-". getdate()['mon']."-".getdate()['mday'];
            $stmt = $pdo->prepare("INSERT INTO users (User_Name, User_Password, Date_Create) VALUES (?, PASSWORD(?), ?)");
            $stmt->bindParam(1, $name);
            //hash the password
            $stmt->bindParam(2, $password);
            $stmt->bindParam(3, $date);

            // insertion d'une ligne
            
            $stmt->execute();
            #Close connexion
            $pdo = null;
        } catch (Exception $e){
            echo "\nenter4";
            $pdo->rollback();
            throw $e;
        }
    }

    #Function to check if user exists by the name and the password
    function user_exists($name,$password){
        $pdo = connect();

        $req = $pdo->prepare('SELECT * FROM `users` WHERE `User_Name`= ? AND`User_Password` = PASSWORD(?)');
        $req->bindParam(1,$name, PDO::PARAM_STR);
        $req->bindParam(2,$password, PDO::PARAM_STR);
        $req->execute(); 
        $user = $req->fetch();
        #Close connexion
        $pdo = null;
        return empty($user);        
    }

    #Function to check if user exists by the name
    function user_exists_name($name){
        $pdo = connect();
        $req = $pdo->prepare('SELECT * FROM users WHERE User_Name=?');
        $req->bindParam(1,$name, PDO::PARAM_STR);
        $req->execute(); 
        $user = $req->fetch();
        #Close connexion
        $pdo = null;
        return empty($user);

        
    }

    function createToken() {
		$seed = urlSafeEncode(random_bytes(8));
		$t = time();
		$hash = urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, CSRF_TOKEN_SECRET, true));
		return urlSafeEncode($hash . '|' . $seed . '|' . $t);
	}

	function validateToken($token) {
		$parts = explode('|', urlSafeDecode($token));
		if(count($parts) === 3) {
			$hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], CSRF_TOKEN_SECRET, true);
			if(hash_equals($hash, urlSafeDecode($parts[0]))) {
				return true;
			}
		}
		return false;
	}

	function urlSafeEncode($m) {
		return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
	}
	function urlSafeDecode($m) {
		return base64_decode(strtr($m, '-_', '+/'));
	}


    function encrypt_decrypt($string, $action = 'encrypt')
    {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    //Function that's allow the creation of CRSF token to prevent us form malicious requests
    function generate_token() {
        // Check if a token is present for the current session
        if(!isset($_SESSION["csrf_token"])) {
            // No token present, generate a new one
            $token = random_bytes(64);
            $_SESSION["csrf_token"] = $token;
        } else {
            // Reuse the token
            $token = $_SESSION["csrf_token"];
        }
        return $token;
    }
?>