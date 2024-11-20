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


<!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <!-- ======= Menu collapse Icon ===== -->
        <li class="pc-h-item pc-sidebar-collapse">
          <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="pc-h-item pc-sidebar-popup">
          <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="dropdown pc-h-item d-inline-flex d-md-none">
          <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i class="ph-duotone ph-magnifying-glass"></i>
          </a>
          <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3">
              <div class="mb-0 d-flex align-items-center">
                <input type="search" class="form-control border-0 shadow-none" placeholder="Search..." />
                <button class="btn btn-light-secondary btn-search">Search</button>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </div>
    <!-- [Mobile Media Block end] -->
    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="dropdown pc-h-item d-none d-md-inline-flex">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i class="ph-duotone ph-circles-four"></i>
          </a>
          <div class="dropdown-menu dropdown-qta dropdown-menu-end pc-h-dropdown">
            <div class="overflow-hidden">
              <div class="qta-links m-n1">
                <a href="<?= BASE_PATH ?>products" class="dropdown-item">
                  <i class="ph-duotone ph-shopping-cart"></i>
                  <span>E-commerce</span>
                </a>
                <a href="<?= BASE_PATH ?>clients" class="dropdown-item">
                  <i class="ph-duotone ph-identification-badge"></i>
                  <span>Clients</span>
                </a>
                <a href="<?= BASE_PATH ?>users" class="dropdown-item">
                  <i class="ph-duotone ph-user-circle"></i>
                  <span>Users</span>
                </a>
                <a href="<?= BASE_PATH ?>orders" class="dropdown-item">
                  <i class="ph-duotone ph-list me-2"></i>
                  <span>Orders</span>
                </a>
              </div>
            </div>
          </div>
        </li>
        <li class="dropdown pc-h-item">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" aria-expanded="false">
            <i class="ph-duotone ph-sun-dim"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
            <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
              <i class="ph-duotone ph-moon"></i>
              <span>Dark</span>
            </a>
            <a href="#!" class="dropdown-item" onclick="layout_change('light')">
              <i class="ph-duotone ph-sun-dim"></i>
              <span>Light</span>
            </a>
            <a href="#!" class="dropdown-item" onclick="layout_change_default()">
              <i class="ph-duotone ph-cpu"></i>
              <span>Default</span>
            </a>
          </div>
        </li>
        <li class="dropdown pc-h-item header-user-profile">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
            aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
            <!-- foto de perfil-->
            <img src="<?= BASE_PATH ?>assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar" />
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header d-flex align-items-center justify-content-between">
              <h5 class="m-0">Profile</h5>
            </div>
            <div class="dropdown-body">
              <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                <ul class="list-group list-group-flush w-100">
                  <li class="list-group-item">
                    <div class="d-flex align-items-center">


                      <!-- Foto que redirige a profile  -->
                      <a href="profile">
                        <div class="flex-shrink-0">
                          <img src="<?= $user['avatar']; ?>" alt="user-image" class="wid-50 rounded-circle" />
                        </div>
                      </a>





                      <div class="flex-grow-1 mx-3">
                        <h5 class="mb-0"><?= $user['name'] . ' ' . $user['lastname']; ?></h5>


                        <a class="link-primary" href="mailto:carson.darrin@company.io"></a>
                        <p class="mb-0"><?= $user['email']; ?></p>
                      </div>
                      <span class="badge bg-primary">PRO</span>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <a href="products" class="dropdown-item">
                      <span class="d-flex align-items-center">
                        <i class="ph-duotone ph-shopping-cart"></i>
                        <span>E-commerce</span>
                      </span>
                    </a>
                    <a href="clients" class="dropdown-item">
                      <span class="d-flex align-items-center">
                        <i class="ph-duotone ph-identification-badge"></i>
                        <span>Clients</span>
                      </span>
                    </a>
                    <a href="users" class="dropdown-item">
                      <span class="d-flex align-items-center">
                        <i class="ph-duotone ph-user-circle"></i>
                        <span>Users</span>
                      </span>
                    </a>
                  </li>
                  <li class="list-group-item">
                    <!-- Implementación del Logout -->
                    <form method="POST" action="auth">
                      <input type="hidden" name="action" value="logout">

                      <!-- Todo el botón es el formulario para hacer clic en cualquier parte -->
                      <button type="submit" class="dropdown-item"
                        style="background: none; border: none; width: 100%; text-align: left;">
                        <span class="d-flex align-items-center">
                          <i class="ph-duotone ph-power"></i>
                          <span>Logout</span>
                        </span>
                      </button>
                    </form>

                  </li>
                </ul>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>
<!-- [ Header ] end -->