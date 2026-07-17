<!doctype html>

<html>    

  <head>

    <style>
        .cor{
            background-color: #1a1a1a;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  </head>

    <body class="min-w-screen min-h-screen flex cor">

        <div class="relative items-center justify-center lg:flex lg:w-1/2 h-screen ">

            <div class="absolute inset-0 bg-gradient-to-br from-orange-600 via-orange-500 to-red-600 opacity-10"></div>

            <div class="absolute top-20 left-20 rounded-full bg-orange-500 h-64 w-64 opacity-5 blur-3xl"></div>

            <div class="absolute bottom-20 right-20 rounded-full bg-orange-400 h-96 w-96 opacity-5 blur-3xl"></div>

            <div class="relative z-10 text-center px-12">

                <div class="w-40 h-40 bg-orange-500 rounded-3xl flex items-center justify-center mx-auto shadow-2xl shadow-orange-500/30">

                    <img src="img.png" alt="">

                </div>
                    
                <h1 class="text-5xl font-black text-white mb-3">FitManager Pro</h1>

                <p class="text-gray-400 text-xl mb-8">Sistema Completo de Gestão de Academia</p>

                <div class="space-y-3 text-left">
                    @foreach([
                        'Gestão completa de alunos',
                        'Controle de planos e matrículas',
                        'Registro de frequência (check-in)',
                        'Dashboard com estatísticas em tempo real',
                    
                    ] as $feature )
                    <div class="flex items-center gap-3">

                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">

                            <i class="bi bi-check-lg"></i>

                        </div>

                        <span class="text-white text-lg">{{$feature}}</span>

                    </div>
                    @endforeach



                </div>

            </div>

        </div>

        <div class="lg:w-1/2 h-screen">



        </div>

    </body>

</html>