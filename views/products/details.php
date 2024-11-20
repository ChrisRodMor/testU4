<?php
include_once "../../app/config.php";
include_once "../../app/ProductController.php";
include_once "../../app/PresentationController.php";

// Obtener el slug del producto desde la URL amigable
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/ExamenU4/products/';
$productSlug = str_replace($basePath, '', $requestUri);

// Eliminar posibles barras finales
$productSlug = rtrim($productSlug, '/');

// Validar si el slug es válido
if ($productSlug) {
    // Obtener los detalles del producto específico usando el slug
    $productDetails = (new ProductController())->getProductsBySlug($productSlug);

    // Verificar si se encontraron los detalles del producto
    if (!$productDetails) {
        echo "No se encontró el producto. Verifica que el slug sea válido.";
        exit;
    }
    $productId = $productDetails['id']; // Asegúrate de que este sea el campo correcto del ID en tu API
    $presentationController = new PresentationController(); // Instancia del controlador de presentaciones
    $presentations = $presentationController->getPresentationsOfProduct($productId);

} else {
    echo "No se especificó el slug del producto.";
    exit;
}
?>


<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
  <?php

  include "../layouts/head.php";

  ?>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">


  <?php

  include "../layouts/sidebar.php";

  ?>

  <?php

  include "../layouts/nav.php";

  ?>



  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                <li class="breadcrumb-item" aria-current="page">Products</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Products</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->


      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="sticky-md-top product-sticky">
                    <div id="carouselExampleCaptions" class="carousel slide ecomm-prod-slider" data-bs-ride="carousel">
                      <div class="carousel-inner bg-light rounded position-relative">
                        <div class="card-body position-absolute end-0 top-0">
                          <div class="form-check prod-likes">
                            <input type="checkbox" class="form-check-input" />
                            <i data-feather="heart" class="prod-likes-icon"></i>
                          </div>
                        </div>
                        <div class="card-body position-absolute bottom-0 end-0">
                          <ul class="list-inline ms-auto mb-0 prod-likes">
                            <li class="list-inline-item m-0">
                              <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                <i class="ti ti-zoom-in f-18"></i>
                              </a>
                            </li>
                            <li class="list-inline-item m-0">
                              <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                <i class="ti ti-zoom-out f-18"></i>
                              </a>
                            </li>
                            <li class="list-inline-item m-0">
                              <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                <i class="ti ti-rotate-clockwise f-18"></i>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="carousel-item active">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                        <div class="carousel-item">
                          <img src="<?= htmlspecialchars($productDetails['cover']) ?>" class="d-block w-100" alt="Imagen principal del producto" />
                        </div>
                      </div>
                      <!-- <ol class="list-inline carousel-indicators position-relative product-carousel-indicators my-sm-3 mx-0">
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="list-inline-item w-25 h-auto active">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-1.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-2.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-3.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-4.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-5.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-6.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-7.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" class="list-inline-item w-25 h-auto">
                          <img src="<?= BASE_PATH ?>assets/images/application/img-prod-8.jpg" class="d-block wid-50 rounded" alt="Product images" />
                        </li>
                      </ol> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h2 class="my-3"><?= htmlspecialchars($productDetails['name']) ?></h2>
                  <h3 class="mt-4 mb-sm-3 mb-2 f-w-500">Detalles</h3>
                  <div>
                      <h4><?= htmlspecialchars($productDetails['description']) ?></h4>
                  </div>
                  <div class="mb-3 row">
                      <h4 class="col-form-label col-lg-2 col-sm-12">Stock</h4>
                      <h4 class="col-lg-6 col-md-12 col-sm-12">
                          <?= !empty($productDetails['presentations'][0]['stock']) ? htmlspecialchars($productDetails['presentations'][0]['stock']) : 'No disponible' ?>
                      </h4>
                  </div>
                  <h3 class="mb-4">
                      <b>
                          $<?= !empty($productDetails['presentations'][0]['price'][0]['amount']) 
                              ? htmlspecialchars($productDetails['presentations'][0]['price'][0]['amount']) 
                              : 'No disponible' ?>
                      </b>
                  </h3>
              </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header pb-0">
              <ul class="nav nav-tabs profile-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="ecomtab-tab-1"
                    data-bs-toggle="tab"
                    href="#ecomtab-1"
                    role="tab"
                    aria-controls="ecomtab-1"
                    aria-selected="true">Features
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="ecomtab-tab-3"
                    data-bs-toggle="tab"
                    href="#ecomtab-3"
                    role="tab"
                    aria-controls="ecomtab-3"
                    aria-selected="true">Overview
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
              <div class="tab-pane show active" id="ecomtab-1" role="tabpanel" aria-labelledby="ecomtab-tab-1">
                <div class="table-responsive">
                    <p class="text-muted">
                        <?= htmlspecialchars($productDetails['features']) ?: "No se encontraron características para este producto." ?>
                    </p>
                </div>
            </div>
            <div class="tab-pane" id="ecomtab-3" role="tabpanel" aria-labelledby="ecomtab-tab-3">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <!-- Mostrar la marca -->
                        <tr>
                            <td class="text-muted py-1 border-top-0">Brand :</td>
                            <td class="py-1 border-top-0">
                                <?= htmlspecialchars($productDetails['brand']['name'] ?? 'No especificada') ?>
                            </td>
                        </tr>

                        <!-- Mostrar las etiquetas -->
                        <tr>
                            <td class="text-muted py-1">Tags :</td>
                            <td class="py-1">
                                <?php if (!empty($productDetails['tags'])): ?>
                                    <?= implode(' | ', array_map('htmlspecialchars', array_column($productDetails['tags'], 'name'))) ?>
                                <?php else: ?>
                                    No especificados
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Mostrar las categorías -->
                        <tr>
                            <td class="text-muted py-1">Categories :</td>
                            <td class="py-1">
                                <?php if (!empty($productDetails['categories'])): ?>
                                    <?= implode(' | ', array_map('htmlspecialchars', array_column($productDetails['categories'], 'name'))) ?>
                                <?php else: ?>
                                    No especificadas
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

                <div class="tab-pane" id="ecomtab-4" role="tabpanel" aria-labelledby="ecomtab-tab-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                          <div class="chat-avtar">
                            <img class="img-radius img-fluid wid-40" src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg" alt="User image" />
                            <div class="bg-success chat-badge"></div>
                          </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <h6 class="mb-1">Harriet Wilson</h6>
                          <p class="text-muted text-sm mb-1">2 hour ago</p>
                          <div class="star">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-muted"></i>
                          </div>
                          <p class="mb-0 text-muted mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                          <div class="chat-avtar">
                            <img class="img-radius img-fluid wid-40" src="<?= BASE_PATH ?>assets/images/user/avatar-2.jpg" alt="User image" />
                            <div class="bg-success chat-badge"></div>
                          </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <h6 class="mb-1">Lou Olson</h6>
                          <p class="text-muted text-sm mb-1">2 hour ago</p>
                          <div class="star">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-muted"></i>
                            <i class="far fa-star text-muted"></i>
                          </div>
                          <p class="mb-2 text-muted mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                            industry's standard dummy text ever since the 1500.</p>
                          <a href="#" class="link-primary mb-1">https://phoenixcoded.net/</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center mt-3">
                    <button class="btn btn-link-primary">View more comments</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
    <div class="card-body">
        <div class="container mt-5">
            <?php if (!empty($presentations)): ?>
                <?php foreach ($presentations as $index => $presentation): ?>
                    <!-- Título de la Presentación -->
                    <h2 class="text-primary mb-3">
                        Presentación <?= $index + 1 ?>: <?= htmlspecialchars($presentation['description']) ?>
                    </h2>

                    <!-- Tabla de Presentación -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Descripción</th>
                                    <th>Código</th>
                                    <th>Peso (gramos)</th>
                                    <th>Estado</th>
                                    <th>Imagen</th>
                                    <th>Stock</th>
                                    <th>Stock Min</th>
                                    <th>Stock Max</th>
                                    <th>Precio Actual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= htmlspecialchars($presentation['id']) ?></td>
                                    <td><?= htmlspecialchars($presentation['description']) ?></td>
                                    <td><?= htmlspecialchars($presentation['code']) ?></td>
                                    <td><?= htmlspecialchars($presentation['weight_in_grams']) ?></td>
                                    <td class="<?= $presentation['status'] === 'Activo' ? 'text-success' : 'text-danger' ?>">
                                        <?= htmlspecialchars($presentation['status']) ?>
                                    </td>
                                    <td>
                                        <img src="<?= htmlspecialchars($presentation['cover']) ?>" alt="Imagen de <?= htmlspecialchars($presentation['description']) ?>" width="50">
                                    </td>
                                    <td><?= htmlspecialchars($presentation['stock']) ?></td>
                                    <td><?= htmlspecialchars($presentation['stock_min']) ?></td>
                                    <td><?= htmlspecialchars($presentation['stock_max']) ?></td>
                                    <td><?= htmlspecialchars($presentation['amount']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Órdenes de la Presentación -->
                    <h4 class="text-secondary mb-3">Órdenes de Presentación <?= $index + 1 ?></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>ID Orden</th>
                                    <th>Folio</th>
                                    <th>Total</th>
                                    <th>Pagado</th>
                                    <th>ID Cliente</th>
                                    <th>ID Dirección</th>
                                    <th>ID Estado Orden</th>
                                    <th>ID Tipo Pago</th>
                                    <th>ID Cupón</th>
                                    <th>Cantidad</th>
                                    <th>ID Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($productDetails['presentations'][0]['orders'])): ?>
                              <?php foreach ($productDetails['presentations'][0]['orders'] as $order): ?>
                                  <tr>
                                      <td><?= htmlspecialchars($order['id']) ?></td>
                                      <td><?= htmlspecialchars($order['folio']) ?></td>
                                      <td>$<?= number_format($order['total'], 2) ?></td>
                                      <td class="<?= $order['is_paid'] ? 'text-success' : 'text-danger' ?>">
                                          <?= $order['is_paid'] ? 'Pagado' : 'No Pagado' ?>
                                      </td>
                                      <td><?= htmlspecialchars($order['client_id']) ?></td>
                                      <td><?= htmlspecialchars($order['address_id']) ?></td>
                                      <td><?= htmlspecialchars($order['order_status_id']) ?></td>
                                      <td><?= htmlspecialchars($order['payment_type_id']) ?></td>
                                      <td><?= htmlspecialchars($order['coupon_id'] ?? 'N/A') ?></td>
                                      <td><?= htmlspecialchars($order['pivot']['quantity']) ?></td>
                                      <td><?= htmlspecialchars($order['pivot']['price_id']) ?></td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php else: ?>
                              <tr>
                                  <td colspan="11">No hay órdenes disponibles para esta presentación.</td>
                              </tr>
                          <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron presentaciones para este producto.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php

  include "../layouts/footer.php";

  ?>

  <?php

  include "../layouts/scripts.php";

  ?>


  <!-- [Page Specific JS] start -->
  <script>
    // scroll-block
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
      new SimpleBar(tc[t]);
    }
    // quantity start
    function increaseValue(temp) {
      var value = parseInt(document.getElementById(temp).value, 10);
      value = isNaN(value) ? 0 : value;
      value++;
      document.getElementById(temp).value = value;
    }

    function decreaseValue(temp) {
      var value = parseInt(document.getElementById(temp).value, 10);
      value = isNaN(value) ? 0 : value;
      value < 1 ? (value = 1) : '';
      value--;
      document.getElementById(temp).value = value;
    }
    // quantity end
  </script>

  <?php

  include "../layouts/modals.php";

  ?>

</body>
<!-- [Body] end -->

</html>