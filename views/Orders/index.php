<?php
include_once "../../app/config.php";
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Orders</a></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h2 class="mb-0">Orders</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addOrderModal" style="margin-top: 15px; margin-bottom: 15px;">Crear Orden</a>
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- ORDERS -->
                    <div class="col-lg-12 col-xxl-12">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="orders" role="tabpanel">
                                <div class="container my-3">
                                    <div class="row">
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="border card">
                                                <div class="p-2 card-body">
                                                    <h6 class="mb-2">Folio: 82712</h6>
                                                    <ul class="list-group list-group-flush my-2">
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Total:</span>
                                                            <strong>$8999.99</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Status:</span>
                                                            <span>Pendiente de pago</span>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Payment:</span>
                                                            <span>Efectivo</span>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Productos:</span>
                                                            <span>2</span>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2">
                                                            <strong>Productos incluidos:</strong>
                                                            <ul class="mb-0 ps-3">
                                                                <li>Comedor Miguel con 4 Sillas - $450</li>
                                                                <li>Colchón Matrimonial Zero - $8999.99</li>
                                                            </ul>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2">
                                                            <strong>Dirección del cliente:</strong>
                                                            <p class="mb-0 ps-3">
                                                                Calle articulo 743, 123, La Paz, Baja California Sur, 23088
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Cupón aplicado:</span>
                                                            <span>10% off</span>
                                                        </li>
                                                    </ul>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                                                            <button class="btn btn-outline-warning btn-sm me-2" title="Edit">
                                                                <i class="ph-duotone ph-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn-sm" title="Delete">
                                                            <i class="ph-duotone ph-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Order 2 -->
                                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                                            <div class="border card">
                                                <div class="p-2 card-body">
                                                    <h6 class="mb-2">Folio: 82718</h6>
                                                    <ul class="list-group list-group-flush my-2">
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Total:</span>
                                                            <strong>$9599.97</strong>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Status:</span>
                                                            <span>Cancelada</span>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Payment:</span>
                                                            <span>Tarjeta</span>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Productos:</span>
                                                            <span>3</span>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2">
                                                            <strong>Productos incluidos:</strong>
                                                            <ul class="mb-0 ps-3">
                                                                <li>Tostador Record 2 Rebanadas - $299.99</li>
                                                                <li>Escurridor de Acero para Platos Farberware - $6299.99</li>
                                                                <li>AirPods Pro con Estuche de Carga - $2999.99</li>
                                                            </ul>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2">
                                                            <strong>Dirección del cliente:</strong>
                                                            <p class="mb-0 ps-3">
                                                                Calle Lope de Rueda, 32, Cabanillas del Campo, Guadalajara, 19171
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item px-0 py-2 d-flex justify-content-between">
                                                            <span>Cupón aplicado:</span>
                                                            <span>15% off</span>
                                                        </li>
                                                    </ul>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                                                            <button class="btn btn-outline-warning btn-sm me-2" title="Edit">
                                                                <i class="ph-duotone ph-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <button class="btn btn-outline-danger btn-sm" title="Delete">
                                                            <i class="ph-duotone ph-trash"></i>
                                                        </button>
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
        <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title text-light" id="addOrderModalLabel">Añadir Orden</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="folio" class="form-label text-light">Folio</label>
                                <input type="text" class="form-control bg-dark text-light" id="folio" name="folio" required>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label text-light">Monto de la orden</label>
                                <input type="text" class="form-control bg-dark text-light" id="total" name="total" required>
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label text-light">¿Ha sido pagada?</label>
                                <select class="form-select bg-dark text-light" id="is_paid" name="is_paid" required>
                                    <option value="" disabled selected>¿La orden se pagó?</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="client_id" class="form-label text-light">Cliente</label>
                                <select class="form-select bg-dark text-light" id="client_id" name="client_id" required>
                                    <option value="" disabled selected>Seleccione un cliente</option>
                                    <option value="1">Cliente1</option>
                                    <option value="2">Cliente2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address_id" class="form-label text-light">ID de la dirección</label>
                                <input type="text" class="form-control bg-dark text-light" id="address_id" name="address_id" required>
                            </div>
                            </select>
                            <div class="mb-3">
                                <label for="order_status_id" class="form-label text-light">Estatus de la orden</label>
                                <select class="form-select bg-dark text-light" id="order_status_id" name="order_status_id" required>
                                    <option value="" disabled selected>Estado de la orden</option>
                                    <option value="1">Pendiente de pago</option>
                                    <option value="2">Pagado</option>
                                    <option value="3">Enviada</option>
                                    <option value="4">Abonado</option>
                                    <option value="5">Pendiente de enviar</option>
                                    <option value="6">Cancelada</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="payment_type_id" class="form-label text-light">¿Método de pago?</label>
                                <select class="form-select bg-dark text-light" id="payment_type_id" name="payment_type_id" required>
                                    <option value="" disabled selected>Seleccione un método de pago</option>
                                    <option value="1">Efectivo</option>
                                    <option value="2">Tarjeta</option>
                                    <option value="3">Transferencia</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="coupon_id" class="form-label text-light">Cupón</label>
                                <select class="form-select bg-dark text-light" id="coupon_id" name="coupon_id" required>
                                    <option value="" disabled selected>Seleccione un cupón promocional</option>
                                    <option value="1">10% OFF</option>
                                    <option value="2">15% OFF</option>
                                    <option value="3">100MXN OFF</option>
                                    <option value="4">50 MXN OFF</option>
                                    <option value="5">20% OFF</option>
                                    <option value="6">500MNX OFF</option>
                                    <option value="7">5% OFF</option>
                                    <option value="8">25% OFF (Cupón navideño)</option>
                                    <option value="9">200 MXN OFF</option>
                                </select>
                            </div>
                            <div id="select-container">
                                <div id="select-container-1">
                                    <div class="mb-3">
                                        <label for="modal1[0][id]" class="form-label text-light">Producto 1</label>
                                        <select class="form-select bg-dark text-light" id="modal1[0][id]" name="modal1[0][id]" required>
                                            <option value="" disabled selected>Seleccione un producto</option>
                                            <option value="1">Product1</option>
                                            <option value="2">Product2</option>
                                        </select>
                                        <label for="modal1[0][quantity]" class="form-label text-light mt-2">Cantidad producto 1</label>
                                        <input type="text" class="form-control bg-dark text-light" id="modal1[0][quantity]" name="modal1[0][quantity]" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-3 add-select-btn" data-container="select-container-1">Agregar otro</button>
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
        <div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title text-light" id="editOrderModalLabel">Editar Orden</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="folio" class="form-label text-light">Folio</label>
                                <input type="text" class="form-control bg-dark text-light" id="folio" name="folio" required>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label text-light">Monto de la orden</label>
                                <input type="text" class="form-control bg-dark text-light" id="total" name="total" required>
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label text-light">¿Ha sido pagada?</label>
                                <select class="form-select bg-dark text-light" id="is_paid" name="is_paid" required>
                                    <option value="" disabled selected>¿La orden se pagó?</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="client_id" class="form-label text-light">Cliente</label>
                                <select class="form-select bg-dark text-light" id="client_id" name="client_id" required>
                                    <option value="" disabled selected>Seleccione un cliente</option>
                                    <option value="1">Cliente1</option>
                                    <option value="2">Cliente2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address_id" class="form-label text-light">ID de la dirección</label>
                                <input type="text" class="form-control bg-dark text-light" id="address_id" name="address_id" required>
                            </div>
                            </select>
                            <div class="mb-3">
                                <label for="order_status_id" class="form-label text-light">Estatus de la orden</label>
                                <select class="form-select bg-dark text-light" id="order_status_id" name="order_status_id" required>
                                    <option value="" disabled selected>Estado de la orden</option>
                                    <option value="1">Pendiente de pago</option>
                                    <option value="2">Pagado</option>
                                    <option value="3">Enviada</option>
                                    <option value="4">Abonado</option>
                                    <option value="5">Pendiente de enviar</option>
                                    <option value="6">Cancelada</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="payment_type_id" class="form-label text-light">¿Método de pago?</label>
                                <select class="form-select bg-dark text-light" id="payment_type_id" name="payment_type_id" required>
                                    <option value="" disabled selected>Seleccione un método de pago</option>
                                    <option value="1">Efectivo</option>
                                    <option value="2">Tarjeta</option>
                                    <option value="3">Transferencia</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="coupon_id" class="form-label text-light">Cupón</label>
                                <select class="form-select bg-dark text-light" id="coupon_id" name="coupon_id" required>
                                    <option value="" disabled selected>Seleccione un cupón promocional</option>
                                    <option value="1">10% OFF</option>
                                    <option value="2">15% OFF</option>
                                    <option value="3">100MXN OFF</option>
                                    <option value="4">50 MXN OFF</option>
                                    <option value="5">20% OFF</option>
                                    <option value="6">500MNX OFF</option>
                                    <option value="7">5% OFF</option>
                                    <option value="8">25% OFF (Cupón navideño)</option>
                                    <option value="9">200 MXN OFF</option>
                                </select>
                            </div>
                            <div id="select-container-2">
                                <div class="mb-3">
                                    <label for="modal2[0][id]" class="form-label text-light">Producto 1</label>
                                    <select class="form-select bg-dark text-light" id="modal2[0][id]" name="modal2[0][id]" required>
                                        <option value="" disabled selected>Seleccione un producto</option>
                                        <option value="1">Product1</option>
                                        <option value="2">Product2</option>
                                    </select>
                                    <label for="modal2[0][quantity]" class="form-label text-light mt-2">Cantidad producto 1</label>
                                    <input type="text" class="form-control bg-dark text-light" id="modal2[0][quantity]" name="modal2[0][quantity]" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-3 add-select-btn" data-container="select-container-2">Agregar otro</button>
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

        include "../layouts/footer.php";
        include "../layouts/scripts.php";

        ?>

    </body>
    <!-- [Body] end -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Identificar todos los botones con la clase `add-select-btn`
            const addSelectButtons = document.querySelectorAll('.add-select-btn');

            // Asociar evento a cada botón
            addSelectButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const containerId = button.getAttribute('data-container'); // Contenedor asociado
                    const container = document.getElementById(containerId);

                    // Contar los selects ya existentes dentro del contenedor
                    const itemCount = container.querySelectorAll('.mb-3').length;

                    // Crear un nuevo contenedor para el nuevo conjunto de campos
                    const newItem = document.createElement('div');
                    newItem.className = 'mb-3';

                    // Crear label y select para producto
                    const productLabel = document.createElement('label');
                    productLabel.className = 'form-label text-light';
                    productLabel.for = `${containerId}[${itemCount}][id]`;
                    productLabel.textContent = `Producto ${itemCount + 1}`;

                    const newSelect = document.createElement('select');
                    newSelect.className = 'form-select bg-dark text-light';
                    newSelect.id = `${containerId}[${itemCount}][id]`;
                    newSelect.name = `${containerId}[${itemCount}][id]`;
                    newSelect.required = true;
                    newSelect.innerHTML = `
                <option value="" disabled selected>Seleccione un producto</option>
                <option value="1">Product1</option>
                <option value="2">Product2</option>
            `;

                    // Crear label e input para cantidad
                    const quantityLabel = document.createElement('label');
                    quantityLabel.className = 'form-label text-light mt-2';
                    quantityLabel.for = `${containerId}[${itemCount}][quantity]`;
                    quantityLabel.textContent = `Cantidad producto ${itemCount + 1}`;

                    const newQuantity = document.createElement('input');
                    newQuantity.className = 'form-control bg-dark text-light';
                    newQuantity.id = `${containerId}[${itemCount}][quantity]`;
                    newQuantity.name = `${containerId}[${itemCount}][quantity]`;
                    newQuantity.type = 'text';
                    newQuantity.required = true;

                    // Agregar campos al nuevo contenedor
                    newItem.appendChild(productLabel);
                    newItem.appendChild(newSelect);
                    newItem.appendChild(quantityLabel);
                    newItem.appendChild(newQuantity);

                    // Insertar el nuevo conjunto de campos en el contenedor correspondiente
                    container.appendChild(newItem);
                });
            });
        });
    </script>

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