<?php 

include_once "config.php";

if (isset($_POST['action'])) {
	
	if (!isset($_POST['global_token'])) {
		echo json_encode(['error' => 'Token de autenticacion no valido.']);
        header('Location: ' . BASE_PATH . 'login');
		exit;
	}
	
	$productController = new ProductController();

	switch($_POST['action']){
		
		// Agregar producto
		case 'addProduct':
			$name = $_POST['name'];
			$slug = $_POST['slug'];
			$description = $_POST['description'];
			$features = $_POST['features'];
			$cover = $_FILES['cover']['tmp_name'];
			$brand = $_POST['brand_id'];
			$categories = $_POST['categories'];
            $tags = $_POST['tags'];


			$productController->addProduct($name, $slug, $description, $features, $brand, $cover, $categories, $tags);
		break;

		// Editar producto
		case 'editProduct':
			$id = $_POST['id'];
			$name = $_POST['name'];
			$slug = $_POST['slug'];
			$description = $_POST['description'];
			$features = $_POST['features'];
			$brand = $_POST['brand_id'];
			$categories = $_POST['categories'];
            $tags = $_POST['tags'];


			$productController->editProduct($id, $name, $slug, $description, $features, $brand, $categories, $tags);
		break;

		// Eliminar producto
		case 'deleteProduct':
			$id = $_POST['id'];
            
			$productController->deleteProduct($id);
		break;
	}
}


class ProductController
{
 
	public function getProducts()
    {

        $curl = curl_init();

        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/',
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


	public function getProductsBySlug($slug) {
        $curl = curl_init();
    
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
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

	public function addProduct($name, $slug, $description, $features, $brand, $cover, $categories, $tags) {
    
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
        
        $curl = curl_init();
    
        $postFields = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'brand_id' => $brand,
            'cover' => new CURLFILE($cover),
        ];
    
        foreach ($categories as $index => $category) {
            $postFields["categories[$index]"] = $category;
        }
    
        foreach ($tags as $index => $tag) {
            $postFields["tags[$index]"] = $tag;
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        header('Location: ' . BASE_PATH . 'products');
    }
    

	public function editProduct($id, $name, $slug, $description, $features, $brand, $categories, $tags) {
        
        if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        $postFields = http_build_query([
            'id' => $id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'brand_id' => $brand
        ]);
    
        foreach ($categories as $index => $category) {
            $postFields .= "&categories[$index]=" . urlencode($category);
        }
    
        foreach ($tags as $index => $tag) {
            $postFields .= "&tags[$index]=" . urlencode($tag);
        }
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        echo $response;
        header('Location: ' . BASE_PATH . 'products');
    }
    
    

	public function deleteProduct($id)
	{
		if (!isset($_SESSION['token'])) {
            echo 'No se encontró el token de autorización.';
            return [];
        }
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
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
        
        header('Location: ' . BASE_PATH . 'products');

	}

}

?>