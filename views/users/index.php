<?php
include_once "../../app/config.php";
include_once "../../app/UserController.php";

$userController = new UserController();
$users = $userController->getUsers();

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
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Profile</li>
                <li class="breadcrumb-item" aria-current="page">User List</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">User List</h2>
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
        <div class="card border-0 table-card user-profile-list">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover" id="pc-dt-simple">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Creation date</th>
                    <th>Profile</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user): ?>
                    <tr>
                      <td>
                        <div class="d-inline-block align-middle">
                          <img
                            src="<?= !empty($user['avatar']) && filter_var($user['avatar'], FILTER_VALIDATE_URL) ? $user['avatar'] : BASE_PATH . 'assets/images/user/avatar-1.jpg' ?>" 
                            alt="Avatar del usuario" 
                            onerror="this.onerror=null;this.src='<?= BASE_PATH . 'assets/images/user/avatar-1.jpg' ?>';"                            
                            class="img-radius align-top m-r-15"
                            style="width: 40px" />
                          <div class="d-inline-block">
                            <h6 class="m-b-0"><?= htmlspecialchars($user['name']) ?></h6>
                            <p class="m-b-0 text-primary"><?= htmlspecialchars($user['role']) ?></p>
                          </div>
                        </div>
                      </td>
                      <td><?= htmlspecialchars($user['email']) ?></td>
                      <td><?= htmlspecialchars($user['phone_number']) ?></td>
                      <td><?= htmlspecialchars($user['created_at']) ?></td>
                      <td class="buttons-cell" style="width: 1%;">
                        <div class="profile-actions">
                          <a href="detailsUser?id=<?= $user['id'] ?>" class="btn btn-primary">
                            <i class="ti ti-user me-2"></i> Profile
                          </a>
                          <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $user['id']; ?>"><i class="ti ti-pencil me-2"></i>Editar</button>
                          <form action="api-users" method="POST" class="d-inline">
                            <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
                            <input type="hidden" name="action" value="deleteUser">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                <i class="ti ti-trash me-2"></i> Eliminar
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    <!-- MODAL EDITAR -->
                    <modal class="modal fade" id="editUserModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content bg-dark text-light">
                          <div class="modal-header">
                            <h5 class="modal-title text-light" id="editUserModalLabel">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="api-users" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="editUser">
                            <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">            
                            <input type="hidden" name="id" id="userId" value="<?= htmlspecialchars($user['id']) ?>">
                              <div class="mb-3">
                                <label for="UserName" class="form-label text-light">Nombre</label>
                                <input type="text" class="form-control bg-dark text-light" id="name" value="<?= htmlspecialchars($user['name']) ?>" name="name" required>
                              </div>
                              <div class="mb-3">
                                <label for="UserLastName" class="form-label text-light">Apellido(s)</label>
                                <input type="text" class="form-control bg-dark text-light" id="lastName" value="<?= htmlspecialchars($user['lastname']) ?>" name="lastname" required>
                              </div>
                              <div class="mb-3">
                                <label for="UserEmail" class="form-label text-light">Email</label>
                                <input type="text" class="form-control bg-dark text-light" id="email" value="<?= htmlspecialchars($user['email']) ?>" name="email" required>
                              </div>
                              <div class="mb-3">
                                <label for="UserPhone" class="form-label text-light">Teléfono</label>
                                <input type="text" class="form-control bg-dark text-light" id="phone" value="<?= htmlspecialchars($user['phone_number']) ?>" name="phone_number" required>
                              </div>
                              <div class="mb-3">
                                <label for="UserPassword" class="form-label text-light">Contraseña</label>
                                <input type="password" class="form-control bg-dark text-light" id="password" placeholder="Nueva contraseña" name="password" required>
                              </div>
                              <div class="mb-3">
                                <label for="UserPhoto" class="form-label text-light">Foto de Perfil</label>
                                <input type="file" class="form-control bg-dark text-light" id="profile_photo_file"  name="profile_photo_file">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                  </modal>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal" style="margin-top: 15px; margin-bottom: 15px;">Crear Usuario</a>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
  <!-- MODAL AGREGAR -->
  <modal class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-light">
        <div class="modal-header">
          <h5 class="modal-title text-light" id="addUserModalLabel">Añadir Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- TODO: HACER FUNCIONAR EL MODAL -->
          <form action="api-users" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="addUser">
            <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
            <div class="mb-3">
              <label for="name" class="form-label text-light">Nombre</label>
              <input type="text" class="form-control bg-dark text-light" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="lastname" class="form-label text-light">Apellido(s)</label>
              <input type="text" class="form-control bg-dark text-light" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label text-light">Email</label>
              <input type="email" class="form-control bg-dark text-light" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="phone_number" class="form-label text-light">Teléfono</label>
              <input type="tel" class="form-control bg-dark text-light" id="phone_number" name="phone_number" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-light">Contraseña</label>
              <input type="password" class="form-control bg-dark text-light" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="profile_photo_file" class="form-label text-light">Foto de perfil</label>
              <input type="file" class="form-control bg-dark text-light" id="profile_photo_file" name="profile_photo_file">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </modal>


  <!-- [ Main Content ] end -->
  <!-- [Page Specific JS] start -->
  <script src="<?= BASE_PATH ?>assets/js/plugins/simple-datatables.js"></script>
  <script>
    const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
      sortable: false,
      perPage: 5
    });


  </script>
  <!-- [Page Specific JS] end -->

  <?php

  include "../layouts/footer.php";
  include "../layouts/scripts.php";

  ?>

</body>
<!-- [Body] end -->

</html>