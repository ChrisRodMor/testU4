<?php
include_once "../../app/config.php";
include_once "../../app/ProductController.php";
include_once "../../app/BrandController.php";
include_once "../../app/CategoryController.php";
include_once "../../app/TagController.php";


$productController = new ProductController();
$products = $productController->getProducts();

$brandController = new BrandController();
$brands = $brandController->getBrands();

$categoryController = new CategoryController();
$categories = $categoryController->getCategories();

$tagController = new TagController();
$tags = $tagController->getTags();

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
    <div class="pc-content ">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center row">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="/application/ecom_product#">E-commerce</a></li>
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
      <div class="row">
        <div class="col-sm-12">
          <div class="ecom-wrapper">
            <div class="offcanvas-xxl offcanvas-start ecom-offcanvas" tabindex="-1" id="offcanvas_mail_filter" style="height: auto;">
              <div class="p-0 sticky-xxl-top offcanvas-body"></div>
            </div>
            <div class="ecom-content">

              <!-- TODO: Implementar funcionalidad a botones -->
              <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal" style = "margin-bottom: 15px;">Crear producto</a>
              <!-- Vista de productos -->
              <div class="row">
                <?php foreach ($products as $product): ?>
                  <div class="col-xl-4 col-sm-6">
                    <div class="product-card card">
                      <div class="card-img-top">
                        <a href="/application/ecom_product-details">
                          <img src="<?php echo htmlspecialchars($product['cover']); ?>" alt="image" class="img-prod img-fluid" loading="lazy" width="800" height="800" decoding="async" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </a>
                      </div>
                      <div class="card-body">
                        <h5 class="prod-title mb-2"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="prod-description text-muted mb-2"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="prod-brand text-muted mb-3">Marca: <?= htmlspecialchars($product['brand']['name']) ?></p>
                        <div class="d-grid gap-2">
                          <a href="products/<?= htmlspecialchars($product['slug']) ?>" class="btn btn-primary">Detalles</a>
                          <button 
                            type="button" 
                            class="btn btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editProductModal<?php echo $product['id']; ?>">
                            Editar
                          </button>
                          <!-- Formulario para eliminar producto -->
                          <form action="api-products" method="POST" class="d-grid gap-2">
                            <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
                            <input type="hidden" name="action" value="deleteProduct">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- MODAL EDITAR PRODUCTO -->
                  <modal class="modal fade" id="editProductModal<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content bg-dark text-light">
                              <div class="modal-header">
                                  <h5 class="modal-title text-light" id="editProductModalLabel">Editar Producto</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form action="api-products" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="action" value="editProduct">
                                      <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">
                                      <input type="hidden" name="id" id="userId" value="<?= htmlspecialchars($product['id']) ?>">
                                      <!-- Nombre del producto -->
                                      <div class="mb-3">
                                          <label for="productName" class="form-label text-light">Nombre</label>
                                          <input type="text" class="form-control bg-dark text-light" id="name" value="<?= htmlspecialchars($product['name']) ?>" name="name" required>
                                      </div>

                                      <!-- Slug -->
                                      <div class="mb-3">
                                          <label for="productSlug" class="form-label text-light">Slug</label>
                                          <input type="text" class="form-control bg-dark text-light" id="slug" value="<?= htmlspecialchars($product['slug']) ?>" name="slug" required>
                                      </div>

                                      <!-- Descripción -->
                                      <div class="mb-3">
                                          <label for="productDescription" class="form-label text-light">Descripción</label>
                                          <textarea class="form-control bg-dark text-light" id="description" name="description" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea>
                                      </div>

                                      <!-- Características -->
                                      <div class="mb-3">
                                          <label for="productFeatures" class="form-label text-light">Características</label>
                                          <input type="text" class="form-control bg-dark text-light" id="features" value="<?= htmlspecialchars($product['features']) ?>" name="features" required>
                                      </div>

                                      <!-- Marca -->
                                      <div class="mb-3">
                                          <label for="productBrand" class="form-label text-light">Marca</label>
                                          <select class="form-control bg-dark text-light" id="brand_id" value="<?= htmlspecialchars($product['brand_id']) ?>" name="brand_id" required>
                                              <?php foreach ($brands as $brand): ?>
                                                  <option value="<?php echo htmlspecialchars($brand['id']); ?>">
                                                      <?php echo htmlspecialchars($brand['name']); ?>
                                                  </option>
                                              <?php endforeach; ?>
                                          </select>
                                      </div>

                                      <div class="mb-3">
                                        <label for="productTags" class="form-label text-light">Tags</label>
                                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="editTagField">+ Añadir otro tag</button>
                                        <select class="form-control bg-dark text-light" id="productTags" name="tags[]" required>
                                            <?php foreach ($tags as $tag): ?>
                                                <option value="<?= htmlspecialchars($tag['id']) ?>">
                                                    <?= htmlspecialchars($tag['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="selectedTags" class="selected-items-container mt-3"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="productCategories" class="form-label text-light">Categories</label>
                                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="editCategoryField">+ Añadir otra categoría</button>
                                        <select class="form-control bg-dark text-light" id="productCategories" name="categories[]" required>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= htmlspecialchars($category['id']) ?>">
                                                    <?= htmlspecialchars($category['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="selectedCategories" class="selected-items-container mt-3"></div>
                                    </div>
                                      <!-- Botones de modal -->
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
              </div>

              <!-- MODAL AGREGAR PRODUCTO -->
              <modal class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content bg-dark text-light">
                          <div class="modal-header">
                              <h5 class="modal-title text-light" id="addProductModalLabel">Añadir Producto</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="api-products" method="POST" enctype="multipart/form-data">
                                  <input type="hidden" name="action" value="addProduct">
                                  <input type="hidden" name="global_token" value="<?php echo htmlspecialchars($globalToken); ?>">

                                  <!-- Nombre del producto -->
                                  <div class="mb-3">
                                      <label for="productName" class="form-label text-light">Nombre</label>
                                      <input type="text" class="form-control bg-dark text-light" id="name" name="name" required>
                                  </div>

                                  <!-- Slug -->
                                  <div class="mb-3">
                                      <label for="productSlug" class="form-label text-light">Slug</label>
                                      <input type="text" class="form-control bg-dark text-light" id="slug" name="slug" required>
                                  </div>

                                  <!-- Descripción -->
                                  <div class="mb-3">
                                      <label for="productDescription" class="form-label text-light">Descripción</label>
                                      <textarea class="form-control bg-dark text-light" id="description" name="description" rows="3" required></textarea>
                                  </div>

                                  <!-- Características -->
                                  <div class="mb-3">
                                      <label for="productFeatures" class="form-label text-light">Características</label>
                                      <input type="text" class="form-control bg-dark text-light" id="features" name="features" required>
                                  </div>

                                  <!-- Imagen -->
                                  <div class="mb-3">
                                      <label for="productImage" class="form-label text-light">Imagen</label>
                                      <input type="file" class="form-control bg-dark text-light" id="cover" name="cover" accept="image/*" required>
                                  </div>

                                  <!-- Marca -->
                                  <div class="mb-3">
                                      <label for="productBrand" class="form-label text-light">Marca</label>
                                      <select class="form-control bg-dark text-light" id="brand_id" name="brand_id" required>
                                          <?php foreach ($brands as $brand): ?>
                                              <option value="<?php echo htmlspecialchars($brand['id']); ?>">
                                                  <?php echo htmlspecialchars($brand['name']); ?>
                                              </option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>

                                  <div class="mb-3">
                                    <label for="productTags" class="form-label text-light">Tags</label>
                                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="addTagField">+ Añadir otro tag</button>
                                    <select class="form-control bg-dark text-light" id="productTags" name="tags[]" required>
                                        <?php foreach ($tags as $tag): ?>
                                            <option value="<?= htmlspecialchars($tag['id']) ?>">
                                                <?= htmlspecialchars($tag['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="selectedTags" class="selected-items-container mt-3"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="productCategories" class="form-label text-light">Categories</label>
                                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="addCategoryField">+ Añadir otra categoría</button>
                                    <select class="form-control bg-dark text-light" id="productCategories" name="categories[]" required>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= htmlspecialchars($category['id']) ?>">
                                                <?= htmlspecialchars($category['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="selectedCategories" class="selected-items-container mt-3"></div>
                                </div>
                                  <!-- Botones de modal -->
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                      <button type="submit" class="btn btn-primary">Guardar</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </modal>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php

  include "../layouts/footer.php";

  ?>

  <?php

  include "../layouts/scripts.php";

  ?>

  <?php

  include "../layouts/modals.php";

  ?>

</body>
<!-- [Body] end -->

<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Función para crear un nuevo campo select dinámicamente
    const createSelectField = (options, name) => {
        const select = document.createElement("select");
        select.className = "form-control bg-dark text-light mt-2";
        select.name = name + "[]";
        select.required = true;

        options.forEach(option => {
            const opt = document.createElement("option");
            opt.value = option.value;
            opt.textContent = option.text;
            select.appendChild(opt);
        });

        return select;
    };

    // Delegación de eventos para manejar clicks en los botones de agregar tags o categorías
    document.body.addEventListener("click", (event) => {
        if (event.target && (event.target.id === "addTagField" || event.target.id === "addCategoryField")) {
            const modal = event.target.closest(".modal"); // Encuentra el modal correspondiente al botón
            const isTagButton = event.target.id === "addTagField";

            // Encuentra los contenedores y opciones dentro del modal actual
            const container = modal.querySelector(isTagButton ? "#selectedTags" : "#selectedCategories");
            const selectId = isTagButton ? "#productTags" : "#productCategories";
            const options = Array.from(modal.querySelectorAll(`${selectId} option`))
                .map(opt => ({ value: opt.value, text: opt.textContent }));

            // Crea y añade un nuevo campo
            const newField = createSelectField(options, isTagButton ? "tags" : "categories");
            container.appendChild(newField);
        }
    });
});


</script>
</html>


<style>
  /* CSS PERSONALIZADO */
  .selected-items-container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .selected-item {
    background-color: #04a9f5;
    color: white;
    padding: 4px 8px;
    border-radius: 16px;
    display: flex;
    align-items: center;
  }

  .selected-item .remove-item {
    margin-left: 8px;
    cursor: pointer;
    color: #ffffff;
    font-weight: bold;
  }
</style>