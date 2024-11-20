<?php 

include_once "config.php";

if (isset($_POST['action'])) {

	if (!isset($_SESSION['global_token'])) {
		$_SESSION['global_token'] = bin2hex(random_bytes(32));
	}

	$authController = new AuthController();
	
	switch ($_POST['action']) {

		case 'login':
			$email = $_POST['correo'];
			$password = $_POST['contrasena'];
			$authController->login($email,$password);
		break;
        case 'profile':
			$id = $_POST['id'];
			$authController->getUserByID($id);
		break;
		case 'logout':
			$authController->logout();
			break;
		default:
			// nada XD...
			break;
	}
}


class AuthController
{
    

    public function login($email, $password)
    {

        if (!isset($_SESSION['global_token'])) {
            $_SESSION['global_token'] = bin2hex(random_bytes(32));
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $email, 'password' => $password),
            CURLOPT_HTTPHEADER => array(
                'Cookie: XSRF-TOKEN=eyJpdiI6InA3VVhoM0tHSTRZRXNlYjVzNlFqM2c9PSIsInZhbHVlIjoibEw5bWFzbDdGRmpTN1Rqb3d6NTdNTXNmR0wrUWk3RkF0ek55SkhQNUlQYWF5K216dE1FUU9kc3dnZFc0a1J5ZFRlOVEyTFhhZTI1RDExbG02UGIrc2k1N3E4Y0RWakVlZnNyZ2Zwd1Z5UWdsOWdFTWpJWkhYclNQWVlqTXBhYkYiLCJtYWMiOiI4MDc3MGYwMzkwMDk4ODFjY2Q3NjU4NzJlOTc5ZDI2NGFmNGNlYjYxODQzZGM0ZDQ3M2YwNjA5MjVhODY0N2I3IiwidGFnIjoiIn0%3D; apicrud_session=eyJpdiI6IlJ2ZEMrcFhRaXlSUE9ycUNNQUtsdFE9PSIsInZhbHVlIjoiSVY0Mk1WOGxSQzRPMnJ6dm5YeStNUjZ1ckVuQjZkWXJoZ2gzMmdkR1dicVlsN3dFWUlGTXN1TGJ0Y1BvTWExRXZxZkJWOTQ3V0JaOXZlMWdBTmlzUm5DaDhrMWZ6eTVkQ3hmdlBQcy9HWFpKU1oxNzFVWmpERXpHSnprOGhSVi8iLCJtYWMiOiJiOTI2YTA5MmU4MGY3ODg5M2U1MTM2YjY2YzYzZTRjNTIyYjQ5ZTc4YmUzMDZhZTJhOTZhMjAxNWJjN2FjNTQ3IiwidGFnIjoiIn0%3D'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error en la conexión a la API: ' . curl_error($curl);
            curl_close($curl);
            return;
        }

        curl_close($curl);

        $result = json_decode($response, true);
        if (isset($result['errors'])) {
            header('Location: ' . BASE_PATH . 'login');
            return;
        }

        $userData = $result['data'];
        $id = $userData['id'];
        $name = $userData['name'];
        $lastname = $userData['lastname'];
        $token = $userData['token'];

        session_start();
        $_SESSION['token'] = $token;
        $_SESSION['id'] = $id;

        // echo "Bienvenido, $name $lastname con el token: $token";
        header('Location: ' . BASE_PATH . 'home');
    }

    public function getUserByID($id) {
        $curl = curl_init();
    
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        
        $result = json_decode($response, true);
    
        return $result['data'];
    }

    function getGlobalToken() {
        if (!isset($_SESSION['global_token'])) {
            $_SESSION['global_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['global_token'];
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: ' . BASE_PATH . 'login');
        exit();
    }
}


?>