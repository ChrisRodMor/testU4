<?php
include_once "../../app/config.php";
include_once "../../app/authController.php";

// Obtener el ID del usuario desde la URL
$userId = isset($_GET['id']) ? $_GET['id'] : null;

if ($userId) {
    // Obtener los datos del usuario específico usando el ID
    $userDetails = (new AuthController())->getUserByID($userId);
} else {
    echo "No se especificó el ID del usuario.";
    exit;
}
?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->
<head>
    <?php include "../layouts/head.php"; ?>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body>
    <?php include "../layouts/sidebar.php"; ?>
    <?php include "../layouts/nav.php"; ?>

    <div class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-primary"></div>
                    <div class="row">
                        <div class="col-lg-5 col-xxl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body position-relative">
                                    <div class="text-center mt-3">
                                        <div class="chat-avatar d-inline-flex mx-auto">
                                            <img 
                                                src="<?= !empty($userDetails['avatar']) && filter_var($userDetails['avatar'], FILTER_VALIDATE_URL) ? $userDetails['avatar'] : BASE_PATH . 'assets/images/user/avatar-1.jpg' ?>"
                                                alt="Avatar del usuario" 
                                                onerror="this.onerror=null;this.src='<?= BASE_PATH . 'assets/images/user/avatar-1.jpg' ?>';" 
                                                class="wid-50 rounded-circle" 
                                            />
                                        </div>
                                        <h5 class="mb-0"><?= htmlspecialchars($userDetails['name']) . ' ' . htmlspecialchars($userDetails['lastname']) ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-xxl-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Information</h5>
                                </div>
                                <div class="card-body position-relative">
                                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                        <p class="mb-0 text-muted me-1">Email</p>
                                        <p class="mb-0"><?= htmlspecialchars($userDetails['email']) ?></p>
                                    </div>
                                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                        <p class="mb-0 text-muted me-1">Phone</p>
                                        <p class="mb-0"><?= htmlspecialchars($userDetails['phone_number']) ?></p>
                                    </div>
                                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                                        <p class="mb-0 text-muted me-1">Role</p>
                                        <p class="mb-0"><?= htmlspecialchars($userDetails['role']) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5>Creation Information</h5>
                                </div>
                                <div class="card-body position-relative">
                                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                        <p class="mb-0 text-muted me-1">Created by</p>
                                        <p class="mb-0"><?= htmlspecialchars($user['created_by'] ?? 'N/A') ?></p>
                                    </div>
                                    <div class="d-inline-flex align-items-center justify-content-between w-100 mb-3">
                                        <p class="mb-0 text-muted me-1">Created at</p>
                                        <p class="mb-0"><?= htmlspecialchars($userDetails['created_at']) ?></p>
                                    </div>
                                    <div class="d-inline-flex align-items-center justify-content-between w-100">
                                        <p class="mb-0 text-muted me-1">Updated at</p>
                                        <p class="mb-0"><?= htmlspecialchars($userDetails['updated_at']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../layouts/footer.php"; ?>
    <?php include "../layouts/scripts.php"; ?>
</body>
</html>
