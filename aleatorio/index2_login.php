<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #a1a1a1;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-icon {
            color: #ff6219;
        }

        .card-body {
            padding: 4rem;
        }

        .login-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            border-color: #ccc;
        }

        .form-control:focus {
            border-color: #525252;
            box-shadow: none;
        }

        .btn-dark {
            background-color: #333;
            border-color: #333;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-dark:hover {
            background-color: #222;
            border-color: #222;
        }
    </style>
    <section class="vh-100" style="background-color:rgb(161, 161, 161);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 2%;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="img/icno.jpg"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                       
                                        <span class="h1 fw-bold mb-0">LOGIN</span>
                                    </div>
                                    
                                    
                                    <form action="login.php" method="POST"  >

                                        <div class="form-outline mb-4">
                                            <input type="text" name="CPF"
                                                class="form-control form-control-lg" placeholder="CPF" required>
                                       
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="senha"
                                                class="form-control form-control-lg" placeholder="SENHA" required>
                                           
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