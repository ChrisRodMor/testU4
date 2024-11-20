<?php 

    include_once "config.php";

    if (isset($_POST['action'])) {
        
        if (!isset($_POST['global_token'])) {
            echo json_encode(['error' => 'Token de autenticacion no valido.']);
            header('Location: ' . BASE_PATH . 'login');
            exit;
        }
        
        $presentationController = new PresentationController();

        switch($_POST['action']){
            
            case 'addPresentation':
                $description = $_POST['description'];
                $code = $_POST['code'];
                $weight_in_grams = $_POST['weight_in_grams'];
                $status = $_POST['status'];
                $cover = $_FILES['cover']['tmp_name'];
                $stock = $_POST['stock'];
                $stock_min = $_POST['stock_min'];
                $stock_max = $_POST['stock_max'];
                $product_id = $_POST['product_id']; //ACA NO ES HIDDEN PORQUE AQUI SE ASIGNA A QUE PRODUCTO PERTENECE LA PRESENTACION
                $amount = $_POST['amount'];
            
                $presentationController->addPresentation($description, $code, $weight_in_grams, $status, $cover, $stock, $stock_min, $stock_max, $product_id, $amount);
            break;

            case 'editPresentation':
                $description = $_POST['description'];
                $code = $_POST['code'];
                $weight_in_grams = $_POST['weight_in_grams'];
                $status = $_POST['status'];
                $stock = $_POST['stock'];
                $stock_min = $_POST['stock_min'];
                $stock_max = $_POST['stock_max'];
                $product_id = $_POST['product_id'];
                $id = $_POST['id']; // PASA EL ID COMO INPUT HIDDEN PORQUE ASI SABE CUAL ES EL QUE VA A EDITAR
                $amount = $_POST['amount'];
            
                $presentationController->editPresentation($description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $product_id, $id, $amount);
            break;
            
            

            case 'deletePresentation':
                $id = $_POST['id'];
            
                $presentationController->deletePresentation($id);
            break;
            
        }
    }

    
    class PresentationController{

        public function getPresentationsOfProduct($id) {
            
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/product/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token']
                ),
            ));
        
            $response = curl_exec($curl);
            curl_close($curl);
        
            $result = json_decode($response, true);
        
            return $result['data'];
        }
        
        public function getPresentationById($id) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token']
                ),
            ));
        
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response, true);
        
            return $result['data'];
        }

        public function addPresentation($description, $code, $weight_in_grams, $status, $cover, $stock, $stock_min, $stock_max, $product_id, $amount) {
            
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'description' => $description,
                    'code' => $code,
                    'weight_in_grams' => $weight_in_grams,
                    'status' => $status,
                    'cover' => new CURLFILE($cover),
                    'stock' => $stock,
                    'stock_min' => $stock_min,
                    'stock_max' => $stock_max,
                    'product_id' => $product_id,
                    'amount' => $amount
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token']
                ),
            ));
        
            $response = curl_exec($curl);
            curl_close($curl);
        
            header('Location: ' . BASE_PATH . 'clients'); //aun no se cual va a ser
        }

        public function editPresentation($description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $product_id, $id, $amount){
            
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => http_build_query([
                    'description' => $description,
                    'code' => $code,
                    'weight_in_grams' => $weight_in_grams,
                    'status' => $status,
                    'stock' => $stock,
                    'stock_min' => $stock_min,
                    'stock_max' => $stock_max,
                    'product_id' => $product_id,
                    'id' => $id,
                    'amount' => $amount,
                ]),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $_SESSION['token']
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            header('Location: ' . BASE_PATH . 'clients'); //aun no se cual va a ser
        }

        public function deletePresentation($id){

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_SESSION['token']
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            header('Location: ' . BASE_PATH . 'clients'); //aun no se cual va a ser
        }


    }
    
?>
