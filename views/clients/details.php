<?php
include_once "../../app/config.php";
include_once "../../app/ClientController.php";
include_once "../../app/AdressController.php";

$clientController = new ClientController();
$client = [];

if (isset($_GET['id'])) {
    $client = $clientController->getClientByID($_GET['id']);
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

<body>

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
                  <li class="breadcrumb-item"><a href="home">Home</a></li>
                  <li class="breadcrumb-item">Application</li>
                  <li class="breadcrumb-item" aria-current="page">Client profile</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Client profile</h2>
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
            <div class="card social-profile">
              <img src="<?= BASE_PATH ?>/assets/images/application/img-profile-cover.jpg" alt="" class="w-100 card-img-top" />
              <div class="card-body pt-0">
                <div class="row align-items-end">
                  <!-- Imagen del cliente -->
                  <div class="col-md-auto text-md-start">
                    <img class="img-fluid img-profile-avtar" src="<?= BASE_PATH ?>/assets/images/user/avatar-5.jpg" alt="User image" />
                  </div>
                  <!-- Datos personales del cliente -->
                  <div class="col">
                    <div class="d-flex flex-wrap align-items-center justify-content-start soc-profile-data">
                      <p class="me-3 mb-0"><strong>Nombre:</strong> <?= htmlspecialchars($client['name']) ?></p>
                      <p class="me-3 mb-0"><strong>Email:</strong> <i class="ph-envelope me-1"></i><?= htmlspecialchars($client['email']) ?></p>
                      <p class="me-3 mb-0"><strong>Teléfono:</strong> <i class="ph-phone me-1"></i><?= htmlspecialchars($client['phone_number']) ?></p>
                      <p class="me-3 mb-0"><strong>Nivel:</strong> <i class="ph-star me-1"></i> <?php 
                          if (isset($client['level']) && !empty($client['level'])) {
                              $level = $client['level'];
                              $levelName = htmlspecialchars($level['name']);
                              $discount = htmlspecialchars($level['percentage_discount']);
                              echo "<span class='badge bg-light-secondary border rounded-pill border-secondary bg-transparent f-14 me-1 mt-1'>";
                              echo "$levelName ($discount% Discount)";
                              echo "</span>";
                          } else {
                              echo "<span class='badge bg-light-secondary border rounded-pill border-secondary bg-transparent f-14 me-1 mt-1'>";
                              echo "No posee nivel";
                              echo "</span>";
                          }
                      ?></p>
                      <p class="mb-0"><strong>Status:</strong> 
                          <span class="badge <?= $client['is_suscribed'] ? 'bg-success' : 'bg-secondary' ?>">
                              <?= $client['is_suscribed'] ? 'Suscrito' : 'No Suscrito' ?>
                          </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body py-0">
                <ul class="nav nav-tabs orders-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-selected="true">
                      <i class="ph-duotone ph-list me-2"></i> Ordenes
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="compras-tab" data-bs-toggle="tab" href="#compras" role="tab" aria-selected="false">
                      <i class="ph-duotone ph-shopping-cart me-2"></i> Total Compras
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="addresses-tab" data-bs-toggle="tab" href="#addresses" role="tab" aria-selected="false">
                      <i class="ph-duotone ph-map-pin me-2"></i> Direcciones
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row">
              <!-- ORDERS -->
              <div class="col-lg-12 col-xxl-12">
                <div class="tab-content">
                    <div class="tab-pane show active" id="orders" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="container my-3">
                                    <div class="row">
                                        <?php if (!empty($client['orders'])): ?>
                                            <?php foreach ($client['orders'] as $order): ?>
                                                <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                    <div class="border card">
                                                        <div class="p-2 card-body">
                                                            <h6 class="mb-2">Folio: <?= htmlspecialchars($order['folio'] ?? 'N/A') ?></h6>
                                                            <ul class="list-group list-group-flush my-2">
                                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                                    <span>Total:</span>
                                                                    <strong>$<?= number_format($order['total'] ?? 0, 2) ?></strong>
                                                                </li>
                                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                                    <span>Status:</span>
                                                                    <span><?= htmlspecialchars($order['order_status']['name'] ?? 'No especificado') ?></span>
                                                                </li>
                                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                                    <span>Payment:</span>
                                                                    <span><?= htmlspecialchars($order['payment_type']['name'] ?? 'No especificado') ?></span>
                                                                </li>
                                                                <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                                    <span>Productos:</span>
                                                                    <span><?= isset($order['presentations']) && is_array($order['presentations']) ? count($order['presentations']) : 0 ?></span>
                                                                </li>
                                                                <li class="list-group-item px-0 py-2">
                                                                    <strong>Productos incluidos:</strong>
                                                                    <ul class="mb-0 ps-3">
                                                                        <?php if (isset($order['presentations']) && is_array($order['presentations'])): ?>
                                                                            <?php foreach ($order['presentations'] as $product): ?>
                                                                                <li>
                                                                                    <?= htmlspecialchars($product['description'] ?? 'Producto sin nombre') ?> - 
                                                                                    $<?= number_format($product['current_price']['amount'] ?? 0, 2) ?>
                                                                                </li>
                                                                            <?php endforeach; ?>
                                                                        <?php else: ?>
                                                                            <li>No hay productos incluidos</li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </li>
                                                                <li class="list-group-item px-0 py-2">
                                                                    <strong>Dirección del cliente:</strong>
                                                                    <p class="mb-0 ps-3">
                                                                        <?= htmlspecialchars($order['address']['street_and_use_number'] ?? 'No especificada') ?>, 
                                                                        <?= htmlspecialchars($order['address']['city'] ?? 'No especificada') ?>, 
                                                                        <?= htmlspecialchars($order['address']['province'] ?? 'No especificada') ?>, 
                                                                        <?= htmlspecialchars($order['address']['postal_code'] ?? '') ?>
                                                                    </p>
                                                                </li>
                                                                <?php if (!empty($order['coupon'])): ?>
                                                                    <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                                        <span>Cupón aplicado:</span>
                                                                        <span><?= htmlspecialchars($order['coupon']['name'] ?? 'No especificado') ?></span>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="col-12">
                                                <p class="text-center text-muted">Este cliente no tiene órdenes registradas.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <!-- TOTAL DE COMPRAS -->
                  <div class="tab-pane" id="compras" role="tabpanel" aria-labelledby="compras-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="container my-3">
                                <div class="row">
                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                        <div class="border card">
                                            <div class="p-2 card-body">
                                                <?php 
                                                    $totalCompras = 0;
                                                    $numeroCompras = 0;

                                                    if (!empty($client['orders'])) {
                                                        foreach ($client['orders'] as $order) {
                                                            $totalCompras += $order['total'] ?? 0; // Suma los totales
                                                            $numeroCompras++; // Cuenta cada orden
                                                        }
                                                    }
                                                ?>
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <h3 class="mb-0">Total compras</h3>
                                                    <div class="avtar bg-success rounded-circle">
                                                        <svg class="pc-icon text-white" style="font-size: larger;">
                                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z"></path>
                                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <h5 class="mb-2 mt-3">$<?= number_format($totalCompras, 2) ?></h5>
                                                <div class="d-flex align-items-center gap-1">
                                                    <h5 class="mb-0"><?= $numeroCompras ?></h5>
                                                    <p class="mb-0 text-muted d-flex align-items-center gap-2">Compras</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- DIRECCIONES -->
                  <div class="tab-pane" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                    <div class="card">
                        <div class="card-body">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAdressModal" style="margin-top: 15px; margin-bottom: 15px;">Agregar Dirección</a>
                            <div class="container my-4">
                                <div class="row">
                                    <?php 
                                    if (!empty($client['addresses'])): 
                                        foreach ($client['addresses'] as $address): ?>
                                            <div class="col-xxl-3 col-lg-4 col-sm-6 mb-3">
                                                <div class="card border">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                                            <h6 class="mb-0">Dirección</h6>
                                                            <i class="ph-duotone ph-map-pin text-primary f-30"></i>
                                                        </div>
                                                        <div>
                                                            <p class="mb-1">
                                                                <strong>Calle:</strong> <?= htmlspecialchars($address['street_and_use_number'] ?? 'No especificado') ?>
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Código postal:</strong> <?= htmlspecialchars($address['postal_code'] ?? 'No especificado') ?>
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Ciudad:</strong> <?= htmlspecialchars($address['city'] ?? 'No especificado') ?>
                                                            </p>
                                                            <p class="mb-1">
                                                                <strong>Provincia:</strong> <?= htmlspecialchars($address['province'] ?? 'No especificado') ?>
                                                            </p>
                                                            <p class="mb-0 text-muted">
                                                                <em>Tipo:</em> <?= $address['is_billing_address'] ? 'Dirección de facturación' : 'Otra' ?>
                                                            </p>
                                                        </div>
                                                        <div class="d-flex justify-content-end mt-3">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editAdressModal<?= htmlspecialchars($address['id']) ?>">
                                                                <button class="btn btn-outline-warning btn-sm me-2" title="Edit">
                                                                    <i class="ph-duotone ph-pencil"></i>
                                                                </button>
                                                            </a>
                                                            <form action="adress" method="POST" class="d-inline">
                                                              <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
                                                              <input type="hidden" name="action" value="deleteAddress">
                                                              <input type="hidden" name="client_id" id="clientId" value="<?= htmlspecialchars($client['id']) ?>">
                                                              <input type="hidden" name="id" id="addresId" value="<?= htmlspecialchars($address['id']) ?>">
                                                              <button type="submit" class="btn btn-outline-danger btn-sm">
                                                                <i class="ph-duotone ph-trash"></i></i>
                                                              </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- MODAL EDITAR -->
                                            <div class="modal fade" id="editAdressModal<?= htmlspecialchars($address['id']) ?>" tabindex="-1" aria-labelledby="editAdressModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content bg-dark text-light">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title text-light" id="editAdressModalLabel">Editar Dirección</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="adress" method="POST">
                                                    <input type="hidden" name="action" value="editAddress">
                                                    <input type="hidden" name="global_token" value="<?= htmlspecialchars($globalToken) ?>">
                                                    <input type="hidden" name="client_id" id="clientId" value="<?= htmlspecialchars($client['id']) ?>">
                                                    <input type="hidden" name="id" id="addresId" value="<?= htmlspecialchars($address['id']) ?>">                                                      <!-- TODO: PONER NOMBRE, APELLIDO Y TELEFONO COMO PARAMETROS IMPLICITOS DEL CLIENTE -->
                                                      <div class="mb-3">
                                                        <label for="streer_and_use_number" class="form-label text-light">Calle y número de calle</label>
                                                        <input type="text" class="form-control bg-dark text-light" id="streer_and_use_number" value="<?= htmlspecialchars($address['street_and_use_number']) ?>" name="streetAndNumber" required>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label for="postal_code" class="form-label text-light">Código postal</label>
                                                        <input type="text" class="form-control bg-dark text-light" id="postal_code" value="<?= htmlspecialchars($address['postal_code']) ?>" name="cp" required>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label for="city" class="form-label text-light">Ciudad</label>
                                                        <input type="text" class="form-control bg-dark text-light" id="city" value="<?= htmlspecialchars($address['city']) ?>" name="city" required>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label for="province" class="form-label text-light">Estado</label>
                                                        <input type="text" class="form-control bg-dark text-light" id="province" value="<?= htmlspecialchars($address['province']) ?>" name="province" required>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label for="is_billing_address" class="form-label text-light">¿Se usará para facturación?</label>
                                                        <select class="form-select bg-dark text-light" id="is_billing_address" name="isBillingAdress" required>
                                                          <option value="" disabled selected>Seleccione una opción</option>
                                                          <option value="1">Sí</option>
                                                          <option value="0">No</option>
                                                        </select>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        <?php 
                                        endforeach; 
                                    else: ?>
                                        <p class="text-muted">No hay direcciones registradas.</p>
                                    <?php 
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
    <div class="modal fade modal-lightbox post-modal-lightbox" id="lightboxModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-body">
            <img src="<?= BASE_PATH ?>/assets/images/user/avatar-5.jpg" alt="images" class="modal-image w-100 img-fluid" />
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- MODAL AGREGAR -->
    <div class="modal fade" id="addAdressModal" tabindex="-1" aria-labelledby="addAdressModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header">
            <h5 class="modal-title text-light" id="addAdressModalLabel">Añadir Dirección</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="adress" method="POST">
            <input type="hidden" name="action" value="addAddress">
            <input type="hidden" name="global_token" value="<?= htmlspecialchars($globalToken) ?>">
            <input type="hidden" name="client_id" id="clientId" value="<?= htmlspecialchars($client['id']) ?>">
              <!-- TODO: PONER NOMBRE, APELLIDO Y TELEFONO COMO PARAMETROS IMPLICITOS DEL CLIENTE -->
              <div class="mb-3">
                <label for="streer_and_use_number" class="form-label text-light">Calle y número de calle</label>
                <input type="text" class="form-control bg-dark text-light" id="streer_and_use_number" name="streetAndNumber" required>
              </div>
              <div class="mb-3">
                <label for="postal_code" class="form-label text-light">Código postal</label>
                <input type="text" class="form-control bg-dark text-light" id="postal_code" name="cp" required>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label text-light">Ciudad</label>
                <input type="text" class="form-control bg-dark text-light" id="city" name="city" required>
              </div>
              <div class="mb-3">
                <label for="province" class="form-label text-light">Estado</label>
                <input type="text" class="form-control bg-dark text-light" id="province" name="province" required>
              </div>
              <div class="mb-3">
                <label for="is_billing_address" class="form-label text-light">¿Se usará para facturación?</label>
                <select class="form-select bg-dark text-light" id="is_billing_address" name="isBillingAdress" required>
                  <option value="" disabled selected>Seleccione una opción</option>
                  <option value="1">Sí</option>
                  <option value="0">No</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- [Page Specific JS] start -->
    <script>
      var lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
      var elem = document.querySelectorAll('[data-lightbox]');
      for (var j = 0; j < elem.length; j++) {
        elem[j].addEventListener('click', function() {
          var images_path = event.target;
          if (images_path.tagName == 'DIV') {
            images_path = images_path.parentNode;
          }
          if (images_path.tagName == 'I') {
            images_path = images_path.parentNode.parentNode;
          }
          var recipient = images_path.getAttribute('data-lightbox');
          var image = document.querySelector('.modal-image');
          image.setAttribute('src', recipient);
          lightboxModal.show();
        });
      }

      function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
          let value = node.classList[i];
          if (value.startsWith(prefix)) {
            node.classList.remove(value);
          }
        }
      }
    </script>
    <!-- [Page Specific JS] end -->
    <?php

    include "../layouts/footer.php";
    include "../layouts/scripts.php";

    ?>

  </body>
  <!-- [Body] end -->

</html>

<style>
  .soc-profile-data {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    /* Espacio entre elementos */
  }

  .soc-profile-data p {
    margin: 0;
    /* Elimina márgenes adicionales */
    font-size: 1rem;
    /* Ajusta el tamaño de fuente */
  }

  .soc-profile-data strong {
    color: #333;
    /* Color de los encabezados */
  }
</style>