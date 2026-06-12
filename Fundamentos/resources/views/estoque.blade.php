<!doctype html>

<html lang="en">

    <style type=text/css>

        .sombra{

            box-shadow: 0 -2px 0px rgba(37, 37, 37, 0.2),
                        0 2px 0px rgba(37, 37, 37, 0.2); 

        }

        .list-group-item[aria-expanded="true"] {
            background-color: white;
            border-bottom: none;
        }

        .tt[aria-expanded="true"] {
            background-color: rgb(33,37,41);
            border-bottom: none;
        }

        .gira {
            transition: transform 0.3s ease;
        }

        .list-group-item[aria-expanded="true"] .gira {
            transform: rotate(90deg);
        }

        .list-group-item {
            border: none;
        }

        .seleção:hover {
             background-color: #f8f8f8;  
            transform: scale(1.05);      
            transition: all 0.2s ease;
        }

        .sel:hover {
             background-color: #5a5a5a;  
            transform: scale(1.05);      
            transition: all 0.2s ease;
        }

    </style>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
 
    </head>

    <body>

        <header class="container-fluid bg-dark p-2">

            <div class="container-fluid d-flex flex-direction-row">

                <ul class="nav me-4"><li class="nav-item"><a href="{{route('amazon')}}" class="nav-link"><img src="imm.png" class="img-fluid" style="max-width:200px; height:auto;"></a></li></ul>

                <ul class="nav d-flex align-items-center justify-content-center" style="margin-right:900px;"><li class="nav-item"><a class="nav-link d-flex align-items-center justify-content-center" href="{{route('home')}}"><i class="bi bi-list fs-2 d-flex align-items-center justify-content-center" style="color:white;"></i></a></li></ul>
                <ul class="nav d-flex align-items-center justify-content-center"><li class="nav-item"><a class="nav-link d-flex align-items-center justify-content-center" href="{{route('home')}}"><i class="bi bi-exclamation-triangle-fill fs-6 d-flex align-items-center justify-content-center " style="color:white;"></i></a></li></ul>
                <ul class="nav d-flex align-items-center justify-content-center"><li class="nav-item"><a class="nav-link d-flex align-items-center justify-content-center" href="{{route('amazon')}}"> <i class="bi bi-question-circle-fill fs-6 d-flex align-items-center justify-content-center " style="color:white;"></i></a></li></ul>
                <ul class="nav d-flex align-items-center justify-content-center"><li class="nav-item"><a class="nav-link d-flex align-items-center justify-content-center" href="{{route('home')}}"><i class="bi bi-gear-fill fs-6 d-flex align-items-center justify-content-center " style="color:white;"></i></a><li></li></ul>
                <div clas="d-flex align-items-center justify-content-center flex-column">
                    <a class="list-group-item tt list-group-item-action d-flex align-items-center justify-content-center" data-bs-toggle="collapse" href="#perfil">
                        <span style="color:white;"><i class="bi bi-person-fill fs-6" style="color:white;"></i>Perfil</span><i class="bi bi-chevron-right gira m-4"  style="color:white;"></i>
                    </a>
                    <div class="collapse" id="perfil">
                        <a class="list-group-item ps-4 border-0 sel" href="#" style="color:white;">Login</a>
                        <a class="list-group-item ps-4 border-0 sel" href="#" style="color:white;">Logout</a>
                    </div>
                </div>

            </div>
            
        </header>

        <main class="container-fluid vh-75 p-0">

            <div class="flex-row d-flex">

                <div class="d-flex flex-column" style="width:280px; height:600x;">

                    <div class=" sombra nav d-flex align-items-center justify-content-center container-fluid flex-column" style="background-color:	#e7e7e7 ; height:250px; width:280px;">

                        <div><img src="imm.png" class="img-fluid"  style="max-width:160px; height:auto;"></div>

                        <div><p class="">Logado na loja <strong>Matriz</strong> <span class="dropdown-toggle"></span></p></div>
                    
                    </div>

                     
                    <div class="list-group">

                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                            data-bs-toggle="collapse"
                            href="#cadastros">
                            <span><i class="bi bi-journal-medical"></i> Cadastros</span>
                            <i class="bi bi-chevron-right gira"></i>
                        </a>

                        <div class="collapse" id="cadastros">
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Cadastros Realizados</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Cadastros Pendentes</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Lista de Cadastros</a>
                        </div>

                        

                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                            data-bs-toggle="collapse"
                            href="#produtos">
                            <span><i class="bi bi-box-seam me-2"></i> Produtos</span>
                            <i class="bi bi-chevron-right gira"></i>
                        </a>

                        <div class="collapse" id="produtos">
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Gerenciar produtos</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Valores de venda</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Etiquetas</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Cadastros auxiliares</a>
                        </div>



                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                            data-bs-toggle="collapse"
                            href="#serviços">
                            <span><i class="bi bi-screwdriver"></i> Serviços</span>
                            <i class="bi bi-chevron-right gira"></i>
                        </a>

                        <div class="collapse" id="serviços">
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Estoque</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Configurar tela</a>
                        </div>



                         <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                            data-bs-toggle="collapse"
                            href="#orçamento">
                            <span><i class="bi bi-file-post"></i> Orçamento</span>
                            <i class="bi bi-chevron-right gira"></i>
                        </a>

                        <div class="collapse" id="orçamento">
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Histórico</a>
                            <a class="list-group-item ps-4 border-0 seleção" href="#">Valores</a>
                        </div>

                    </div>




                </div>
                

                <div class="">
                    <nav>
                        teste
                    </nav>
                </div>

            </div>





        </main>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  
    </body>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</html>