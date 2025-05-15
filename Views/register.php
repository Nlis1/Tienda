<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../Public/js/jquery-3.1.1.min.js"></script>
</head>
<body>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            <form method="POST" action="../login/register.php" data-form="save" class="FormularioAjax">

              <div class="row">
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="firstName">First Name</label>
                    <input type="text" name="name" class="form-control form-control-lg" required/>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="lastName">Last Name</label>
                    <input type="text" name="lastName" class="form-control form-control-lg" required/>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                  <div data-mdb-input-init class="form-outline">
                    <label class="form-label">Address</label>     
                    <input type="text" name="address" class="form-control form-control-lg" required/>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <h6 class="mb-2 pb-1">Gender: </h6>
                  <div class="form-check form-check-inline">
                    <label class="form-check-label" for="femaleGender">Female</label>
                    <input class="form-check-input" type="radio" name="optionsGenero" value="female" required />
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="optionsGenero" value="male" required/>
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="emailAddress">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" required/>
                  </div>
                </div>
                 
                <div class="col-md-6 mb-4 pb-2">
                  <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <input type="tel" name="phone" class="form-control form-control-lg" required/>
                  </div>
                </div>

                <div class="col-md-12 mb-4 pb-2">
                  <div data-mdb-input-init class="form-outline">
                    <label class="form-label" for="emailAddress">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" required/>
                  </div>
                </div>
              </div>

              <div class="mt-4 pt-2">
              <button type="submit" class="btn btn-success">Registrar</button>
              </div>

              <div class="RespuestaAjax"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>