# Como entender Cadastro::create() no Laravel

Este guia explica o fluxo completo que ocorre quando o formulário envia dados para o controller.

## Fluxo do código

1. O formulário envia os campos `nome`, `sobrenome`, `telefone` e `email` para a rota `enviar`.
2. O `SiteController::store()` recebe os dados no objeto `$request`.
3. O controller monta um array com os dados recebidos.
4. `Cadastro::create($dados)` chama a implementação do Eloquent.
5. O Eloquent valida os campos usando `$fillable`.
6. O Eloquent executa um `INSERT` na tabela `cadastros`.
7. O banco retorna o identificador e o model é devolvido ao controller.
8. `dump($cadastro)` exibe o objeto no terminal.

## O que ocorre no `Cadastro::create()`

```php
$cadastro = Cadastro::create([
    'nome' => $request->nome,
    'sobrenome' => $request->sobrenome,
    'telefone' => $request->telefone,
    'email' => $request->email,
]);
```

O código acima é equivalentes a esta sequência, embora o Laravel faça isso internamente:

```php
// 1. O Eloquent transforma o array em propriedades do modelo.
$cadastro = new Cadastro;
$cadastro->nome = $request->nome;
$cadastro->sobrenome = $request->sobrenome;
$cadastro->telefone = $request->telefone;
$cadastro->email = $request->email;

// 2. O Eloquent executa o INSERT no banco.
$cadastro->save();

// 3. O objeto preenchido é retornado.
// O resultado fica em $cadastro.
```

O conceito principal é: o Eloquent representa uma linha do banco como um objeto PHP.

## Como ver o objeto criado no terminal

O controller já contém:

```php
dump($cadastro);
```

Para enviar o resultado para o terminal e interromper a execução:

```php
dd($cadastro);
```

A diferença é:

- `dump()`: mostra o valor e continua a execução.
- `dd()`: mostra o valor, chama `die()` e interrompe a execução.

## Como consultar o registro no terminal

Abra o Tinker no terminal:

```powershell
php artisan tinker
```

Execute:

```php
use App\Models\Cadastro;

// Mostra todos os registros.
Cadastro::all()->dd();

// Mostra somente o primeiro registro.
Cadastro::first()->dd();

// Mostra o último registro.
Cadastro::latest('id')->first()->dd();

// Verifica o número de registros.
Cadastro::count();
```

Para mostrar os dados em formato legível:

```php
Cadastro::all()->map(function ($cadastro) {
    return [
        'id' => $cadastro->id,
        'nome' => $cadastro->nome,
        'sobrenome' => $cadastro->sobrenome,
        'telefone' => $cadastro->telefone,
        'email' => $cadastro->email,
    ];
})->dd();
```

## Como ver o SQL executado

No Tinker, execute:

```php
use Illuminate\Support\Facades\DB;

DB::listen(function ($query) {
    dump($query->sql(), $query->bindings());
});

Cadastro::all()->dd();
```

Para observar o SQL durante a criação, remova o `dump()` do controller e adicione na função `store()`:

```php
DB::listen(function ($query) {
    dump($query->sql(), $query->bindings());
});
```

O terminal deve mostrar algo semelhante a:

```text
select * from cadastros
```

E, durante o cadastro:

```text
insert into cadastros (nome, sobrenome, telefone, email, updated_at, created_at) values (?, ?, ?, ?, ?, ?)
```

## Como ver o banco e a tabela

Esse projeto usa SQLite por padrão. Verifique a configuração:

```powershell
php artisan tinker
```

```php
echo env('DB_CONNECTION');
```

A resposta deve ser:

```text
sqlite
```

Para ver a base de dados usada:

```php
echo config('database.connections.sqlite.database');
```

Para consultar diretamente com SQLite, pode usar o arquivo do banco no terminal, mas o melhor caminho é o Eloquent.

## Como importar dados no terminal

Você pode criar um registro diretamente no Tinker:

```php
use App\Models\Cadastro;

Cadastro::create([
    'nome' => 'Maria',
    'sobrenome' => 'Souza',
    'telefone' => '(00) 99999-9999',
    'email' => 'maria@example.com',
])->dd();
```

## Como explorar o model

No Tinker:

```php
use App\Models\Cadastro;

// Verifica se o model está carregado.
var_dump(class_exists(Cadastro::class));

// Verifica os campos permitidos.
var_dump((new Cadastro)->getFillable());

// Verifica a tabela usada pelo modelo.
var_dump((new Cadastro)->getTable());
```

## Como testar a migração

Para appliquer as migrações:

```powershell
php artisan migrate
```

Para criar novamente a tabela a partir do zero:

```powershell
php artisan migrate:fresh
```

Para verificar as migrações que ainda não foram executadas:

```powershell
php artisan migrate:status
```

## Gerar dados aleatórios com Seeder

A factory gera os campos de um cadastro aleatório:

```php
use App\Models\Cadastro;

Cadastro::factory(10)->create();
```

Para executar o Seeder específico pelo terminal:

```powershell
php artisan db:seed --class=CadastroSeeder
```

Para executar o Seeder principal, que também inclui o usuário de exemplo:

```powershell
php artisan db:seed
```

Para executar somente o Seeder de cadastro no Tinker:

```php
use Database\Seeders\CadastroSeeder;

$seeder = new CadastroSeeder;
$seeder->run();
```

Para gerar somente um registro no Tinker:

```php
use App\Models\Cadastro;

Cadastro::factory()->create()->dd();
```

Para limpar os dados antes de gerar novamente:

```powershell
php artisan migrate:fresh --seed
```

## Ordem sugerida de exploração

1. Envie um cadastro pelo formulário.
2. Observe o `dump($cadastro)` no terminal.
3. Abra o Tinker e execute `Cadastro::all()->dd()`.
4. Execute `Cadastro::first()->dd()`.
5. Execute `DB::listen()` e observe o SQL.
6. Execute `Cadastro::factory(10)->create()` no Tinker.
7. Acesse o banco SQLite e confira a tabela `cadastros`.

> O `dump()` é útil para aprendizado, mas deve ser removido antes de publicar a aplicação em produção.
