<?php 

    include_once "config.php";

    if (isset($_POST['action'])) {
        
        if (!isset($_POST['global_token'])) {
            echo json_encode(['error' => 'Token de autenticacion no valido.']);
            header('Location: ' . BASE_PATH . 'login');
            exit;
        }
        
        $clientController = new ClientController();

        switch($_POST['action']){
            
            case 'addClient':
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone_number = $_POST['phone_number'];
                $is_suscribed = $_POST['is_suscribed'];
                $level_id = $_POST['level_id'];

                $clientController->addClient($name, $email, $password, $phone_number, $is_suscribed, $level_id);
            break;

            case 'editClient':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone_number = $_POST['phone_number'];
                $is_suscribed = $_POST['is_suscribed'];
                $level_id = $_POST['level_id'];
            
                $clientController->editClient($name, $email, $password, $phone_number, $is_suscribed, $level_id, $id);
            break;
            

            case 'deleteClient':
                $id = $_POST['id'];
                
                $clientController->deleteClient($id);
            break;
        }
    }

    class ClientController{

        public function getClients(){

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
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

        public function getClientByID($id){
            
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/' . $id,
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

        public function addClient($name, $email, $password, $phone_number, $is_suscribed, $level_id){

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone_number' => $phone_number,
                    'is_suscribed' => $is_suscribed,
                    'level_id' => $level_id
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token'],
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            
            header('Location: ' . BASE_PATH . 'clients');
        }

        function editClient($name, $email, $password, $phone_number, $is_suscribed, $level_id, $id) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            $postData = http_build_query([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'phone_number' => $phone_number,
                'is_suscribed' => $is_suscribed,
                'level_id' => $level_id,
                'id' => $id
            ]);
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $_SESSION['token'],
                ),
            ));
        
            $response = curl_exec($curl);
        
            curl_close($curl);
            
            header('Location: ' . BASE_PATH . 'clients');
        }

        public function deleteClient($id){
            
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/' . $id,
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

            header('Location: ' . BASE_PATH . 'clients');

        }

    }

?>