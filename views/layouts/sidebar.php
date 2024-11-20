<?php
include_once "../../app/authController.php";
include_once '../../app/config.php';


$AuthController = new AuthController();
if (isset($_SESSION['id']) && $_SESSION['id'] != null) {
  $user = $AuthController->getUserByID($_SESSION['id']);
} else {
  header('Location: login');
}
?>


<!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="home" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="../assets/images/logo-dark.svg" alt="logo image" class="logo-lg" />
        <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">v1.2.0</span>
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>Application</label>
          <i class="ph-duotone ph-buildings"></i>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="<?= BASE_PATH ?>products" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-shopping-cart"></i>
            </span>
            <span class="pc-mtext">E-commerce</span></a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="<?= BASE_PATH ?>clients" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-identification-badge"></i>
            </span>
            <span class="pc-mtext">Clients</span></a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="<?= BASE_PATH ?>users" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-user-circle"></i>
            </span>
            <span class="pc-mtext">Users</span></a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="<?= BASE_PATH ?>orders" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-list me-2"></i>
            </span>
            <span class="pc-mtext">Orders</span></a>
        </li>
      </ul>
    </div>
    <div class="card pc-user-card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <!-- Foto perfil -->
            <img src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
          </div>
          <div class="flex-grow-1 ms-3">
            <div class="dropdown">
              <a href="profile" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-2">
                    <h6 class="mb-0"><?= $user['name']; ?></h6>

                    <p class="mb-0"><?= $user['role']; ?></p> <!-- Rol del user -->
                  </div>
                  <div class="flex-shrink-0">
                    <div class="btn btn-icon btn-link-secondary avtar">
                      <i class="ph-duotone ph-windows-logo"></i>
                    </div>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu">
                <ul>
                  <li>
                    <a class="pc-user-links" href="<?= BASE_PATH ?>profile">
                      <i class="ph-duotone ph-user"></i>
                      <span>My Account</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->