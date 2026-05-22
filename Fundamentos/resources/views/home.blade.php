<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  

<style>
    .card{
        box-shadow: 6px 6px 10px 00000005
    }

    .botao{
         background-color: black;
         height:200px;
         width: 200px;
         border-radius:50%;
    }
</style>

<body class="vh-100">

    <header>

    <div class="container-fluid p-4 card "style="background-color:white;">

        <nav class="container">

            <ul class="nav d-flex justify-content-center">

                <li class="nav-item"> <a href="{{ route('tela') }}" class="nav-link"> Home </a> </li>
                <li class="nav-item"> <a href="" class="nav-link"> Contact </a> </li>
                <li class="nav-item"> <a href="" class="nav-link"> About </a> </li>
                <li class="nav-item"> <a href="" class="nav-link"> Services </a> </li>

            </ul>

        </nav>

    </div>

    </header>

    <main class="vh-75">

       <section class="container-fluid">

            <div class="container p-4">

                <div class="row">
                    <div class="col-8 card p-4">

                        <h3>Cadastro do Produto</h3>

                        <div class="row">

                            <div class="col">
                                <label class="form-label">Nome do Produto</label>
                                <input type="text" class="form-control" id="NomeProd">
                            </div>

                            <div class="col">
                                <label class="form-label">Codigo do Produto</label>
                                <input type="text" class="form-control" id="CodigoProd">
                            </div>
    
                        </div>

                        <div class="row">

                            <div class="col">
                                <label class="form-label">Descrição do Produto</label>
                                <textarea class="form-control" rows="7" id="DescProd"></textarea>
                            </div>

                            <div class="col">

                                <div class="row m-0">
                                    <label class="form-label">Preço do Produto</label>
                                    <input type="number" class="form-control" id="PreProd">
                                </div>

                                <div class="row m-0">
                                    <label class="form-label">Preço da Entrega</label>
                                    <input type="number" class="form-control" id="PreEnt">
                                </div>

                                <div class="row m-0">
                                    <label class="form-label">Porcetagem de Desconto</label>
                                    <input type="number" class="form-control" id="PorcDes">
                                </div>

                            </div>

                        </div>


                    </div>


                    <div class="col-4 card d-flex flex-column justify-content-center p-4">

                        <div class="m-4">
                            <button class="btn btn-success w-100 p-3" style="border-radius: 50px;" id="Salvar"> Salvar</button>
                        </div>

                        <div class="m-4">
                            <button class="btn btn-danger w-100 p-3" style="border-radius: 50px"> Apagar</button>
                        </div>

                    </div>

                </div>

            </div>

       </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script type="text/javascript">

        document.querySelector('#Salvar').addEventListener("click",function(){
           var infnome = document.querySelector('#NomeProd').value;
           var infcod = document.querySelector('#CodigoProd').value;
           var infdesc = document.querySelector('#DescProd').value;
           var infpre = document.querySelector('#PreProd').value;
           var infent = document.querySelector('#PreEnt').value;
           var infdes = document.querySelector('#PorcDes').value;
            
           console.log(infnome+"  "+infcod+"  "+infdesc+"  "+infpre+"  "+infent+"  "+infdes);
        });

    </script>

</body>

</html>