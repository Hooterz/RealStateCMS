<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>SE - Añadir Propiedad</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css?123" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">Sergio<span class="color-d">Escudero</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="index.html">Inicio</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="properties.html">Propiedades</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Header/Navbar -->

  <style>
    label {
      padding-top: .8rem;
      font-size: 1rem;
    }

    .flex-column-mod {
      flex-direction: initial;
    }

    @media screen and (max-width: 500px) {
      #terrain_add_button{
        margin: .5rem;
      }

      label {
        padding-top: .5rem;
        font-size: 0.8rem;
      }

      input,
      textarea,
      select {
        font-size: .8rem !important;
      }

      .flex-column-mod {
        flex-direction: column;
      }
    }
  </style>

  <main id="main" class="mt-2">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <form action="" method="post">

          <label>Tipo de adicion:</label>
          <select id="type_select" class="form-select w-50" aria-label="Default select example">
            <option selected>Selecciona el tipo de propiedad</option>
            <option value="casa">Casa</option>
            <option value="terreno">Terreno</option>
          </select>

          <fieldset class="border rounded my-4 p-md-3" style="border-color: #fff;">
            <div class="container-fluid">

              <div class="row">
                <div class="col">
                  <label>Nombre:</label>
                  <input placeholder="Nombre" type="text" name="name" id="name"
                    class="form-control form-control-lg form-control-a" required maxlength="255" />
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label>Direccion:</label>
                  <input placeholder="Direccion" type="text" name="name" id="name"
                    class="form-control form-control-lg form-control-a" required />
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label>Descripcion:</label>
                  <textarea rows="5" placeholder="Descripcion" name="name" id="name"
                    class="form-control form-control-lg form-control-a" required></textarea>
                </div>
              </div>

              <div id="display_house_form" class="container-fluid p-3 my-3 border rounded " style="display: none;">
                <h2 style="font-weight: 500;">Casas:</h2>
                <div class="row d-flex flex-column-mod">
                  <div class="col">
                    <label>Bedrooms:</label>
                    <input type="number" min="0" name="name" id="name"
                      class="form-control form-control-lg form-control-a" value="0" />
                  </div>

                  <div class="col">
                    <label>Bathrooms:</label>
                    <input type="number" min="0" name="name" id="name"
                      class="form-control form-control-lg form-control-a" value="0" />
                  </div>

                  <div class="col">
                    <label>Parking Slots:</label>
                    <input type="number" min="0" name="name" id="name"
                      class="form-control form-control-lg form-control-a" value="0" />
                  </div>
                </div>
              </div>

              <div id="display_terrain_form" class="container-fluid p-3 my-3 border rounded" style="display: none;">
                <h2 style="font-weight: 500;">Terrenos:</h2>
                <div class="row">
                  <ul id="terrain_description_list"></ul>
                </div>
                <div class="row d-flex flex-column-mod">
                  <div class="col-md-12 col-lg-10">
                    <input type="text" class="form-control form-control-lg form-control-a" placeholder="Anndir texto"
                      id="terrain_text_add" />
                  </div>
                  <div class="col-2">
                    <div class="btn btn-primary" id="terrain_add_button">Agregar</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row d-flex align-items-end p-3">
              <div class="col-6">
                <label>Precio:</label>
                <input type="number" min="0" name="name" id="name" class="form-control form-control-lg form-control-a"
                  required />
              </div>
              <div class="col-6 d-flex flex-row-reverse">
                <input type="submit" class="btn btn-primary" />
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </section>
  </main>

  <script type="text/javascript" src="js/addproperty_view.js"></script>
</body>

</html>