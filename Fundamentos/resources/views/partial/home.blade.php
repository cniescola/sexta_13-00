<!doctype html>

<html>

  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  </head>

  <body>

    <header class="h-20">

      <div class="h-20 w-full bg-black flex items-center justify-center ">

        <ul class="flex">

          <li><a href="" class="text-white p-6">Contatos</a></li>
          <li><a href="" class="text-white p-6">Portifólio</a></li>
          <li><a href="" class="text-white p-6">Email</a></li>
          <li><a href="" class="text-white p-6">Telefone</a></li>
          <li><a href="" class="text-white p-6">Sobre</a></li>

        </ul>

      </div>

    </header>

    <main>

      @yield('content');

    </main>
  </body>

</html>