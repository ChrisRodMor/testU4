<?php
include_once "../../app/config.php";
include_once '../../app/authController.php';

$AuthController = new AuthController();
if (isset($_SESSION['id']) && $_SESSION['id'] != null) {
    $user = $AuthController->getUserByID($_SESSION['id']);
} else {
    header('Location: login');
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

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">


    <?php

    include "../layouts/sidebar.php";

    ?>

    <?php

    include "../layouts/nav.php";

    ?>

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-primary"></div>
                    <div class="row">
                        <div class="col-lg-5 col-xxl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body position-relative">
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <!-- Mostrar la foto de perfil -->
                                            <img src="<?= $user['avatar']; ?>" alt="user-image" class="wid-50 rounded-circle" />


                                            <i class="chat-badge bg-success me-2 mb-2"></i>
                                        </div>
                                        <!-- Mostrar nombre completo del user -->
                                        <h5 class="mb-0"><?= $user['name'] . ' ' . $user['lastname']; ?></h5>
                                    </div>
                                </div>
                                <div class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0"
                                    id="user-set-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link list-group-item list-group-item-action active"
                                        id="user-set-profile-tab" data-bs-toggle="pill" href="#user-set-profile"
                                        role="tab" aria-controls="user-set-profile" aria-selected="true">
                                        <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Profile
                                            Overview</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-xxl-9">
                            <div class="tab-content" id="user-set-tabContent">
                                <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel"
                                    aria-labelledby="user-set-profile-tab">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Personal information</h5>
                                        </div>
                                        <div class="card-body position-relative">
                                            <div
                                                class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                <p class="mb-0 text-muted me-1">Email</p>
                                                <p class="mb-0"><?= $user['email']; ?></p>
                                                <!-- Correo del user -->
                                            </div>
                                            <div
                                                class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                <p class="mb-0 text-muted me-1">Phone</p>
                                                <p class="mb-0"><?= $user['phone_number']; ?></p>
                                                <!-- Teléfono del user -->
                                            </div>
                                            <div class="d-inline-flex align-items-center justify-content-between w-100">
                                                <p class="mb-0 text-muted me-1">Role</p>
                                                <p class="mb-0"><?= $user['role']; ?></p> <!-- Rol del user -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Creation information</h5>
                                        </div>
                                        <div class="card-body position-relative">
                                            <div
                                                class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                <p class="mb-0 text-muted me-1">Created by</p>
                                                <p class="mb-0"><?= $user['created_by']; ?></p>
                                                <!-- Nombre del creador -->
                                            </div>
                                            <div
                                                class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                                <p class="mb-0 text-muted me-1">Created at</p>
                                                <p class="mb-0"><?= $user['created_at']; ?></p>
                                                <!-- Fecha de creación -->
                                            </div>
                                            <div class="d-inline-flex align-items-center justify-content-between w-100">
                                                <p class="mb-0 text-muted me-1">Updated at</p>
                                                <p class="mb-0"><?= $user['updated_at']; ?></p>
                                                <!-- Fecha de actualización -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <?php

    include "../layouts/footer.php";
    include "../layouts/scripts.php";
  
    ?>
</body>
<!-- [Body] end -->

</html>