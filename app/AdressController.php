<?php 

    include_once "config.php";

    if (isset($_POST['action'])) {
	
        if (!isset($_POST['global_token'])) {
            echo json_encode(['error' => 'Token de autenticacion no valido.']);
            header('Location: ' . BASE_PATH . 'login');
            exit;
        }
        
        $adressController = new AdressController();
    
        switch($_POST['action']){
            

            case 'addAddress':
                // $name = $_POST['name'];
                // $lastname = $_POST['lastname'];
                $streetAndNumber = $_POST['streetAndNumber'];
                $cp = $_POST['cp'];
                $city = $_POST['city'];
                $province = $_POST['province'];
                // $phone_number = $_POST['phone_number'];
                $isBillingAdress = $_POST['isBillingAdress'];
                $client_id = $_POST['client_id'];
            
                $adressController->addAdress($streetAndNumber, $cp, $city, $province, $isBillingAdress, $client_id);
            break;
            
    

            case 'editAddress':
                $id = $_POST['id'];
                $streetAndNumber = $_POST['streetAndNumber'];
                $cp = $_POST['cp'];
                $city = $_POST['city'];
                $province = $_POST['province'];
                $isBillingAdress = $_POST['isBillingAdress'];
                $client_id = $_POST['client_id'];
            
                $adressController->editAdress($id, $streetAndNumber, $cp, $city, $province, $isBillingAdress, $client_id);
            break;
            
    

            case 'deleteAddress':
                $id = $_POST['id'];
                $client_id = $_POST['client_id'];
                
                $adressController->deleteAdress($id, $client_id);
            break;
        }
    }

    class AdressController{

        public function getAdressByClient($id) {
            $curl = curl_init();
        
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/' . $id,
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

        public function addAdress($streetAndNumber, $cp, $city, $province, $isBillingAdress, $client_id){
            $curl = curl_init();

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'street_and_use_number' => $streetAndNumber,
                    'postal_code' => $cp,
                    'city' => $city,
                    'province' => $province,
                    'is_billing_address' => $isBillingAdress,
                    'client_id' => $client_id
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token'],
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            header('Location: ' . BASE_PATH . 'detailsClient?id=' . $client_id);
        }

        public function editAdress($id, $streetAndNumber, $cp, $city, $province, $isBillingAdress, $client_id) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => 
                    'id=' . urlencode($id) .
                    '&street_and_use_number=' . urlencode($streetAndNumber) .
                    '&postal_code=' . urlencode($cp) .
                    '&city=' . urlencode($city) .
                    '&province=' . urlencode($province) .
                    '&is_billing_address=' . urlencode($isBillingAdress),
                    '&client_id=' . urlencode($client_id),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $_SESSION['token'],
                ),
            ));
        
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
    
            header('Location: ' . BASE_PATH . 'detailsClient?id=' . $client_id);
        }

        public function deleteAdress($id, $client_id){
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/' . $id,
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

            header('Location: ' . BASE_PATH . 'detailsClient?id=' . $client_id);

        }

    }

?>    