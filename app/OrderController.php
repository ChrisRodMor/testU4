<?php 

    include_once "config.php";

    if (isset($_POST['action'])) {
    
        if (!isset($_POST['global_token'])) {
            echo json_encode(['error' => 'Token de autenticación no válido.']);
            header('Location: ' . BASE_PATH . 'login');
            exit;
        }

        $orderController = new OrderController();
    
        switch ($_POST['action']) {
    
            case 'addOrder':
                $folio = $_POST['folio'];
                $total = $_POST['total'];
                $isPaid = $_POST['is_paid'];
                $clientId = $_POST['client_id'];
                $addressId = $_POST['address_id'];
                $orderStatusId = $_POST['order_status_id'];
                $paymentTypeId = $_POST['payment_type_id'];
                $couponId = $_POST['coupon_id'];

                $presentations = [];
                if (isset($_POST['presentations']) && is_array($_POST['presentations'])) {
                    foreach ($_POST['presentations'] as $presentation) {
                        $presentations[] = [
                            'id' => $presentation['id'],
                            'quantity' => $presentation['quantity']
                        ];
                    }
                }

                $orderController->addOrder($folio, $total, $isPaid, $clientId, $addressId, $orderStatusId, $paymentTypeId, $couponId, $presentations);
            break;
    

            case 'editOrder':
                $id = $_POST['id'];
                $orderStatusId = $_POST['order_status_id'];

                $orderController->editOrder($id, $orderStatusId);
            break;
    
            case 'deleteOrder':
                $id = $_POST['id'];

                $orderController->deleteOrder($id);
            break;

            case 'getOrderByID':
                $id = $_POST['id'];
    
                $orderController->getOrderByID($id);
            break;
    
            case 'getOrdersBetweenDates':
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
    
                
                $orderController->getOrdersBetweenDates($start_date, $end_date);
            break;
        }
    }
    


    class OrderController{

        function getOrders() {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }
        

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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

        function getOrderByID($id) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return null;
            }
        
            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/details/' . $id,
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

        function getOrderBetweenDates($startDate, $endDate) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/' . $startDate . '/' . $endDate,
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
        
        function addOrder($folio, $total, $isPaid, $clientId, $addressId, $orderStatusId, $paymentTypeId, $couponId, $presentations) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }
        

            $curl = curl_init();
        
            $postData = [
                'folio' => $folio,
                'total' => $total,
                'is_paid' => $isPaid,
                'client_id' => $clientId,
                'address_id' => $addressId,
                'order_status_id' => $orderStatusId,
                'payment_type_id' => $paymentTypeId,
                'coupon_id' => $couponId,
            ];
        
            foreach ($presentations as $index => $presentation) {
                $postData["presentations[$index][id]"] = $presentation['id'];
                $postData["presentations[$index][quantity]"] = $presentation['quantity'];
            }

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postData,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $_SESSION['token']
                ],
            ]);
        
            $response = curl_exec($curl);
            curl_close($curl);
        
            return $response;
        }

        function editOrder($id, $orderStatusId) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => "id=$id&order_status_id=$orderStatusId",
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $_SESSION['token']
                ],
            ]);
        
            $response = curl_exec($curl);
            curl_close($curl);
        
            
            return $response;
        }

        function deleteOrder($id) {

            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();
        
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/' . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $_SESSION['token']
                ],
            ]);
        
            $response = curl_exec($curl);
            curl_close($curl);
        
            return $response;
        }
        
        
        
        
    }

?>