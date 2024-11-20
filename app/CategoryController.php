<?php 

    include_once "config.php";

    class CategoryController
    {
        public function getCategories()
        { 
            if (!isset($_SESSION['token'])) {
                echo 'No se encontró el token de autorización.';
                return [];
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
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

            if (curl_errno($curl)) {
                echo 'Error en la conexión a la API: ' . curl_error($curl);
                curl_close($curl);
                return [];
            }

            curl_close($curl);

            $result = json_decode($response, true);

            if (isset($result['data'])) {
                return $result['data'];
            }

            return [];
        }
    }
?>