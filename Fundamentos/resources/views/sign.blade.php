<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <style type="text/css">
            body{
                background: linear-gradient(to top right, purple, green);
                }
        </style>

    </head>

    <body>

        <header>
            <li class="nav-item"> <a href="{{ route('login') }}" class="nav-link"> cadastro </a> </li>
        </header>

        <main class="container-fluid d-flex align-items-center justify-content-center vh-100">

            <nav class="container" style="max-width:400px; height:400px; background-color:	#529e7f ; border-radius:10px;">

                <div class="row p-2">

                    <label class="form-label">Digite seu Email:</label>
                    <input type="email" class="form-control">

                </div>

                <div class="row p-2">

                    <label class="form-label">Digite Sua Senha:</label>
                    <input type="password" class="form-control">

                </div>

                <div class="row p-2">

                    <label class="form-label">Digite Sua Senha Novamente:</label>
                    <input type="password" class="form-control">

                </div>

                <div class="row p-3">
                    
                    <button class="btn p-4 btn-outline-dark" style="border-radius: 50px; back-ground-color: #47a1d8;" > Cadastrar</button>
                    
                </div>

            </nav>

        </main>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  
    </body>

</html>