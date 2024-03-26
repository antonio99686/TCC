<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
       
    <title>LOGIN</title>

</head>

<body>
    <section class="vh-100" style="background-color:rgb(161, 161, 161);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 0%;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="img/icno.jpg"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">LOGIN</span>
                                    </div>
                                    
                                    
                                    <form action="login.php" method="POST">

                                        <div class="form-outline mb-4">
                                            <input type="text" name="CPF"
                                                class="form-control form-control-lg" placeholder="CPF">
                                       
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="senha"
                                                class="form-control form-control-lg" placeholder="SENHA" >
                                           
                                        </div>

                                      
                                        <button  type="submit" class="btn btn-dark btn-lg btn-block"> LOGAR </button>
                                       
                                        
                                        
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>