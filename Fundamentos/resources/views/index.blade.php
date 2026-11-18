<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre em contato</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f7f4ee] text-[#27332f] antialiased">
    <main class="flex min-h-screen items-center justify-center px-5 py-10 sm:px-8">
        <section class="grid w-full max-w-5xl overflow-hidden rounded-[2rem] bg-white shadow-[0_24px_80px_rgba(39,51,47,0.12)] lg:grid-cols-[0.85fr_1.15fr]">
            <div class="relative flex min-h-64 flex-col justify-between overflow-hidden bg-[#23473d] p-8 text-[#f7f4ee] sm:p-12 lg:min-h-[600px]">
                <div class="absolute -right-20 -top-24 h-64 w-64 rounded-full border-[28px] border-[#d4e26b]/30"></div>
                <div class="absolute -bottom-24 -left-16 h-56 w-56 rounded-full bg-[#d4e26b]"></div>
                <div class="relative">
                    <p class="mb-8 text-sm font-semibold uppercase tracking-[0.22em] text-[#d4e26b]">Vamos conversar</p>
                    <h1 class="max-w-sm text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">Sua próxima ideia começa aqui.</h1>
                </div>
                <p class="relative mt-10 max-w-xs text-base leading-7 text-[#dbe6d9]">Preencha seus dados e conte com a gente para dar o próximo passo.</p>
            </div>

            <div class="p-8 sm:p-12 lg:p-16">
                <div class="mb-8">
                    <p class="mb-2 text-sm font-semibold uppercase tracking-[0.18em] text-[#6e806f]">Contato</p>
                    <h2 class="text-3xl font-semibold tracking-tight text-[#27332f]">Fale com a gente</h2>
                    <p class="mt-3 text-sm leading-6 text-[#718078]">Deixe seus dados e retornaremos em breve.</p>
                </div>

                <form action="{{ route('enviar') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="nome" class="mb-2 block text-sm font-medium text-[#3e4d47]">Nome</label>
                            <input id="nome" name="nome" type="text" autocomplete="given-name" required placeholder="Seu nome" class="w-full rounded-xl border border-[#d7dfd7] bg-[#fbfcfa] px-4 py-3.5 text-[#27332f] outline-none transition placeholder:text-[#9aa69d] focus:border-[#23473d] focus:ring-4 focus:ring-[#d4e26b]/35">
                        </div>
                        <div>
                            <label for="sobrenome" class="mb-2 block text-sm font-medium text-[#3e4d47]">Sobrenome</label>
                            <input id="sobrenome" name="sobrenome" type="text" autocomplete="family-name" required placeholder="Seu sobrenome" class="w-full rounded-xl border border-[#d7dfd7] bg-[#fbfcfa] px-4 py-3.5 text-[#27332f] outline-none transition placeholder:text-[#9aa69d] focus:border-[#23473d] focus:ring-4 focus:ring-[#d4e26b]/35">
                        </div>
                    </div>

                    <div>
                        <label for="telefone" class="mb-2 block text-sm font-medium text-[#3e4d47]">Telefone</label>
                        <input id="telefone" name="telefone" type="tel" autocomplete="tel" required placeholder="(00) 00000-0000" class="w-full rounded-xl border border-[#d7dfd7] bg-[#fbfcfa] px-4 py-3.5 text-[#27332f] outline-none transition placeholder:text-[#9aa69d] focus:border-[#23473d] focus:ring-4 focus:ring-[#d4e26b]/35">
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-[#3e4d47]">E-mail</label>
                        <input id="email" name="email" type="email" autocomplete="email" required placeholder="voce@email.com" class="w-full rounded-xl border border-[#d7dfd7] bg-[#fbfcfa] px-4 py-3.5 text-[#27332f] outline-none transition placeholder:text-[#9aa69d] focus:border-[#23473d] focus:ring-4 focus:ring-[#d4e26b]/35">
                    </div>

                    <button type="submit" class="flex w-full items-center justify-center rounded-xl bg-[#23473d] px-5 py-4 text-sm font-semibold text-white transition hover:bg-[#18382f] focus:outline-none focus:ring-4 focus:ring-[#d4e26b]/50">Enviar meus dados <span aria-hidden="true" class="ml-2 text-lg">→</span></button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
