<?php
include_once "../../app/config.php";
include_once "../../app/ClientController.php";

$clientController = new ClientController();
$clients = $clientController->getClients();
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
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Profile</a></li>
                  <li class="breadcrumb-item" aria-current="page">Client Card</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Client Card</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addClientModal" style="margin-top: 15px; margin-bottom: 15px;">Crear cliente</a>
        <div class="row">
          <!-- [ sample-page ] start -->
          <?php foreach ($clients as $client): ?>
            <div class="col-md-6 col-xl-4" style="max-width: 350px;">
              <div class="card user-card">
                <div class="card-body">
                  <div class="user-cover-bg">
                    <img src="<?= BASE_PATH ?>/assets/images/application/img-user-cover-1.jpg" alt="image" class="img-fluid" />
                  </div>
                  <div class="chat-avtar card-user-image">
                    <img src="<?= BASE_PATH ?>/assets/images/user/avatar-1.jpg" alt="user-image" class="img-thumbnail rounded-circle" />
                    <i class="chat-badge bg-success"></i>
                  </div>
                  <div class="d-flex">
                    <div class="flex-grow-1 ms-2">
                      <h6 class="mb-1"><?= htmlspecialchars($client['name']) ?></h6>
                      <p class="text-muted text-sm mb-0">
                        Email: <span class="text-primary"><?= htmlspecialchars($client['email']) ?></span>
                      </p>
                      <p class="text-muted text-sm mb-0">Phone: <?= htmlspecialchars($client['phone_number']) ?></p>
                    </div>
                    <div class="d-flex flex-column ms-auto">
                    <a href="detailsClient?id=<?= htmlspecialchars($client['id']) ?>" class="btn btn-outline-primary btn-sm mb-1" title="Info">
                        <i class="ph-duotone ph-info"></i>
                    </a>
                      <a href="#" data-bs-toggle="modal" data-bs-target="#editClientModal<?= htmlspecialchars($client['id']) ?>">
                      <button class="btn btn-outline-warning btn-sm mb-1" title="Edit">
                        <i class="ph-duotone ph-pencil"></i>
                      </button>
                      </a>
                      <form action="api-clients" method="POST" class="d-grid gap-2">
                        <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
                        <input type="hidden" name="action" value="deleteClient">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($client['id']) ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="ph-duotone ph-trash"></i></button>
                      </form>
                    </div>
                  </div>
                  <div class="saprator my-2">
                      <span>Level</span>
                  </div>
                  <div class="text-center">
                      <?php 
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
                      ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- MODAL EDITAR -->
            <div class="modal fade" id="editClientModal<?= htmlspecialchars($client['id']) ?>" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content bg-dark text-light">
                  <div class="modal-header">
                    <h5 class="modal-title text-light" id="editclientModalLabel">Editar cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form action="api-clients" method="POST">
                  <input type="hidden" name="action" value="editClient">
                  <input type="hidden" name="global_token" value="<?= htmlspecialchars($globalToken) ?>">
                  <input type="hidden" name="id" id="userId" value="<?= htmlspecialchars($client['id']) ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label text-light">Nombre</label>
                        <input type="text" class="form-control bg-dark text-light" id="name" value="<?= htmlspecialchars($client['name']) ?>" name="name" required>
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label text-light">Email</label>
                        <input type="email" class="form-control bg-dark text-light" id="email" value="<?= htmlspecialchars($client['email']) ?>" name="email" required>
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label text-light">Contraseña</label>
                        <input type="password" class="form-control bg-dark text-light" id="password" placeholder="Ingresa tu nueva contraseña" name="password" required>
                      </div>
                      <div class="mb-3">
                        <label for="phone_number" class="form-label text-light">Teléfono</label>
                        <input type="tel" class="form-control bg-dark text-light" id="phone_number" value="<?= htmlspecialchars($client['phone_number']) ?>" name="phone_number" required>
                      </div>
                      <div class="mb-3">
                        <label for="is_subscribed" class="form-label text-light">¿Suscrito?</label>
                        <select class="form-select bg-dark text-light" id="is_subscribed" value="<?= htmlspecialchars($client['is_suscribed']) ?>" name="is_suscribed" required>
                          <option value="" disabled selected>Seleccione una opción</option>
                          <option value="1">Sí</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="level_id" class="form-label text-light">Nivel</label>
                        <select class="form-select bg-dark text-light" id="level_id" value="<?= htmlspecialchars($client['level_id']) ?>" name="level_id" required>
                          <option value="" disabled selected>Seleccione un nivel</option>
                          <option value="1">Normal</option>
                          <option value="2">Premium</option>
                          <option value="3">VIP</option>
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
          <?php endforeach; ?>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
    </div>

    <!-- MODAL AGREGAR -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="addClientModalLabel">Añadir Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="api-clients" method="POST">
          <input type="hidden" name="action" value="addClient">
          <input type="hidden" name="global_token" value="<?= htmlspecialchars($globalToken) ?>">
          <div class="mb-3">
            <label for="name" class="form-label text-light">Nombre</label>
            <input type="text" class="form-control bg-dark text-light" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label text-light">Email</label>
            <input type="text" class="form-control bg-dark text-light" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label text-light">Contraseña</label>
            <input type="text" class="form-control bg-dark text-light" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="phone_number" class="form-label text-light">Teléfono</label>
            <input type="text" class="form-control bg-dark text-light" id="phone_number" name="phone_number" required>
          </div>
          <div class="mb-3">
            <label for="is_subscribed" class="form-label text-light">¿Suscrito?</label>
            <select class="form-select bg-dark text-light" id="is_subscribed" name="is_suscribed" required>
              <option value="" disabled selected>Seleccione una opción</option>
              <option value="1">Sí</option>
              <option value="0">No</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="level_id" class="form-label text-light">Nivel</label>
            <select class="form-select bg-dark text-light" id="level_id" name="level_id" required>
              <option value="" disabled selected>Seleccione un nivel</option>
              <option value="1">Normal</option>
              <option value="2">Premium</option>
              <option value="3">VIP</option>
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


    
    <!-- MODAL EDITAR -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header">
            <h5 class="modal-title text-light" id="editclientModalLabel">Editar cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="name" class="form-label text-light">Nombre</label>
                <input type="text" class="form-control bg-dark text-light" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label text-light">Email</label>
                <input type="email" class="form-control bg-dark text-light" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label text-light">Contraseña</label>
                <input type="password" class="form-control bg-dark text-light" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label for="phone_number" class="form-label text-light">Teléfono</label>
                <input type="tel" class="form-control bg-dark text-light" id="phone_number" name="phone_number" required>
              </div>
              <div class="mb-3">
                <label for="is_subscribed" class="form-label text-light">¿Suscrito?</label>
                <select class="form-select bg-dark text-light" id="is_subscribed" name="is_subscribed" required>
                  <option value="" disabled selected>Seleccione una opción</option>
                  <option value="yes">Sí</option>
                  <option value="no">No</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="level_id" class="form-label text-light">Nivel</label>
                <select class="form-select bg-dark text-light" id="level_id" name="level_id" required>
                  <option value="" disabled selected>Seleccione un nivel</option>
                  <option value="1">Normal</option>
                  <option value="2">Premium</option>
                  <option value="3">VIP</option>
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


    <!-- [ Main Content ] end -->
    <?php

    include "../layouts/footer.php";
    include "../layouts/scripts.php";

    ?>

  </body>
  <!-- [Body] end -->

</html>