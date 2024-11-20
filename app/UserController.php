<?php 

    include_once "config.php";

    if (isset($_POST['action'])) {
	
        if (!isset($_POST['global_token'])) {
            echo json_encode(['error' => 'Token de autenticacion no valido.']);
            header('Location: ' . BASE_PATH . 'login');
            exit;
        }
        
        $userController = new UserController();
    
        switch($_POST['action']){
            
            // Agregar user
            case 'addUser':
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $password = $_POST['password'];
                $profile_photo_file = isset($_FILES['profile_photo_file']['tmp_name']) ? $_FILES['profile_photo_file']['tmp_name'] : null;
            
                $userController->addUser($name, $lastname, $email, $phone_number, $password, $profile_photo_file);
            break;
            
    
            // Editar user
            case 'editUser':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $password = $_POST['password'];
                $profile_photo_file = isset($_FILES['profile_photo_file']['tmp_name']) ? $_FILES['profile_photo_file']['tmp_name'] : null;
            
                $userController->editUser($id, $name, $lastname, $email, $phone_number, $password, $profile_photo_file);
            break;
            
    
            // Eliminar user
            case 'deleteUser':
                $id = $_POST['id'];
                
                $userController->deleteUser($id);
            break;
        }
    }

    class UserController{

        public function getUsers(){

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
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

        public function addUser($name, $lastname, $email, $phone_number, $password, $profile_photo_file){

            $curl = curl_init();

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'name' => $name,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone_number' => $phone_number,
                    'created_by' => $_SESSION['name'] . " " . $_SESSION['lastname'],
                    'role' => 'Administrador',
                    'password' => $password,
                    'profile_photo_file'=> new CURLFILE($profile_photo_file)),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token'],
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            header('Location: ' . BASE_PATH . 'users');

        }

        public function editUser($id, $name, $lastname, $email, $phone_number, $password, $profile_photo_file = null) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => 
                    'id=' . urlencode($id) .
                    '&name=' . urlencode($name) .
                    '&lastname=' . urlencode($lastname) .
                    '&email=' . urlencode($email) .
                    '&phone_number=' . urlencode($phone_number) .
                    '&password=' . urlencode($password),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $_SESSION['token'],
                ),
            ));
        
            $response = curl_exec($curl);
            curl_close($curl);
    
        
            if ($profile_photo_file) {
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'id' => $id,
                        'profile_photo_file' => new CURLFILE($profile_photo_file)
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $_SESSION['token'],
                    ),
                ));
        
                $response = curl_exec($curl);
                curl_close($curl);
                
                header('Location: ' . BASE_PATH . 'users');
            }
        }
        

        public function deleteUser($id){
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            header('Location: ' . BASE_PATH . 'users');

        }
    }
?>