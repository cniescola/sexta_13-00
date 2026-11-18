# Guia prático de Laravel Tinker, Eloquent, rotas, controllers e views

Este guia amplia o exemplo de cadastro do projeto e reúne comandos que você pode testar de verdade no Laravel. Inclui mais de 40 operações de consulta, criação, atualização, validação e exploração da aplicação.

## 1. Como iniciar

No terminal, na pasta do projeto:

```powershell
php artisan migrate
php artisan tinker
```

`migrate` cria as tabelas que ainda não existem. Depois, o Tinker abre um shell PHP já carregado com o Laravel, os models, a configuração e os serviços da aplicação.

Ao abrir o Tinker, importe o model usado neste projeto:

```php
use App\Models\Cadastro;
```

Os exemplos de `Cadastro` usam as colunas reais `nome`, `sobrenome`, `telefone` e `email`. O model permite atribuir essas colunas em massa por meio de `$fillable`; a tabela `cadastros` possui timestamps. Consulte o [model Cadastro](app/Models/Cadastro.php) e a [migração da tabela](database/migrations/2026_10_07_205442_create_cadastros_table.php).

> **Cuidado:** criações, alterações e exclusões no Tinker são operações reais no banco configurado pelo `.env`. Confira a conexão antes de executar comandos destrutivos. Evite `migrate:fresh`, `truncate()` e exclusões em massa em bancos com dados importantes.

## 2. Tinker básico

### 1. Ver a versão do framework

No Tinker:

```php
app()->version();
```

### 2. Consultar a conexão de banco configurada

```php
config('database.default');
```

### 3. Confirmar que o model pode ser carregado

```php
class_exists(Cadastro::class);
```

### 4. Ver o nome da tabela e os campos preenchíveis

```php
$model = new Cadastro;
$model->getTable();
$model->getFillable();
```

### 5. Sair do Tinker

```text
exit
```

## 3. Consultar cadastros

### 6. Buscar todos os registros

```php
$cadastros = Cadastro::all();
$cadastros;
```

### 7. Contar registros

```php
Cadastro::count();
```

### 8. Encontrar pelo identificador

Troque `1` por um `id` existente:

```php
Cadastro::find(1);
```

`find()` retorna `null` se não encontrar o registro.

### 9. Buscar e gerar erro caso não exista

```php
Cadastro::findOrFail(1);
```

`findOrFail()` lança `ModelNotFoundException` quando o ID não existe. É útil em controllers, onde o Laravel converte isso normalmente em resposta 404.

### 10. Obter o primeiro e o último cadastro

```php
Cadastro::first();
Cadastro::latest('id')->first();
```

### 11. Filtrar por uma coluna

```php
Cadastro::where('nome', 'Maria')->get();
```

### 12. Combinar filtros

```php
Cadastro::where('nome', 'Maria')
    ->where('sobrenome', 'Souza')
    ->get();
```

### 13. Usar `orWhere`

```php
Cadastro::where('nome', 'Maria')
    ->orWhere('sobrenome', 'Souza')
    ->get();
```

### 14. Procurar com `LIKE`

```php
Cadastro::where('email', 'like', '%@example.com')->get();
```

O comportamento de maiúsculas/minúsculas pode variar conforme o banco de dados.

### 15. Filtrar por uma lista de valores

```php
Cadastro::whereIn('id', [1, 2, 3])->get();
```

### 16. Filtrar por intervalo

```php
Cadastro::whereBetween('id', [1, 10])->get();
```

### 17. Selecionar só algumas colunas

```php
Cadastro::query()
    ->select('id', 'nome', 'email')
    ->get();
```

### 18. Retornar somente os valores de uma coluna

```php
Cadastro::where('sobrenome', 'Souza')->pluck('email');
```

### 19. Obter um único valor

```php
Cadastro::where('id', 1)->value('email');
```

### 20. Verificar se existe algum resultado

```php
Cadastro::where('email', 'maria@example.com')->exists();
Cadastro::where('email', 'maria@example.com')->doesntExist();
```

### 21. Consultar datas

`created_at` é criado pelos timestamps da migração:

```php
Cadastro::whereDate('created_at', today())->get();
Cadastro::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
```

### 22. Ordenar resultados

```php
Cadastro::orderBy('nome')->get();
Cadastro::orderByDesc('created_at')->get();
Cadastro::latest()->first();
```

### 23. Paginar resultados

```php
Cadastro::query()->orderBy('id')->paginate(10);
```

No Tinker, a paginação mostra os metadados e os resultados da página atual. Em uma página web, normalmente ela é entregue à view pelo controller.

### 24. Executar uma consulta por partes

Útil para processar tabelas grandes sem carregar tudo de uma vez:

```php
Cadastro::query()->chunkById(100, function ($lote) {
    dump($lote->count());
});
```

### 25. Percorrer resultados de forma preguiçosa

```php
Cadastro::query()->cursor()->each(function ($cadastro) {
    dump($cadastro->id, $cadastro->email);
});
```

### 26. Transformar resultados em outro formato

```php
Cadastro::all()->map(function ($cadastro) {
    return [
        'id' => $cadastro->id,
        'nome_completo' => $cadastro->nome . ' ' . $cadastro->sobrenome,
        'email' => $cadastro->email,
    ];
});
```

`map()` transforma os dados em memória; não altera as linhas do banco por si só.

## 4. Criar dados

### 27. Criar e gravar usando `create()`

```php
$cadastro = Cadastro::create([
    'nome' => 'Maria',
    'sobrenome' => 'Souza',
    'telefone' => '(11) 99999-0000',
    'email' => 'maria.souza@example.com',
]);

$cadastro->id;
```

`create()` cria e salva imediatamente. Cada execução insere uma nova linha; use outro e-mail/nome se não quiser registros repetidos.

### 28. Instanciar sem gravar e depois salvar

```php
$cadastro = new Cadastro([
    'nome' => 'João',
    'sobrenome' => 'Lima',
    'telefone' => '(21) 98888-1111',
    'email' => 'joao.lima@example.com',
]);

$cadastro->save();
```

### 29. Preencher propriedades individualmente

```php
$cadastro = new Cadastro;
$cadastro->nome = 'Ana';
$cadastro->sobrenome = 'Costa';
$cadastro->telefone = '(31) 97777-2222';
$cadastro->email = 'ana.costa@example.com';
$cadastro->save();
```

### 30. Criar somente em memória com `make()`

```php
$rascunho = Cadastro::make([
    'nome' => 'Rascunho',
    'sobrenome' => 'Teste',
    'telefone' => '(11) 90000-0000',
    'email' => 'rascunho@example.com',
]);

$rascunho->exists; // false: ainda não foi persistido
```

### 31. Criar se ainda não existir com `firstOrCreate()`

```php
$cadastro = Cadastro::firstOrCreate(
    ['email' => 'ana.costa@example.com'],
    [
        'nome' => 'Ana',
        'sobrenome' => 'Costa',
        'telefone' => '(31) 97777-2222',
    ]
);
```

O primeiro array é usado para localizar o registro; o segundo fornece valores para uma nova linha. Para evitar duplicações concorrentes, crie também uma restrição `unique` no banco para o campo que identifica unicamente o registro.

### 32. Localizar ou criar um rascunho com `firstOrNew()`

```php
$cadastro = Cadastro::firstOrNew(
    ['email' => 'novo@example.com'],
    [
        'nome' => 'Novo',
        'sobrenome' => 'Contato',
        'telefone' => '(11) 90000-1234',
    ]
);

if (! $cadastro->exists) {
    $cadastro->save();
}
```

### 33. Atualizar ou criar com `updateOrCreate()`

```php
$cadastro = Cadastro::updateOrCreate(
    ['email' => 'ana.costa@example.com'],
    [
        'nome' => 'Ana',
        'sobrenome' => 'Costa',
        'telefone' => '(31) 96666-3333',
    ]
);
```

### 34. Gerar dados de demonstração com uma factory

O projeto inclui uma factory para `Cadastro`:

```php
Cadastro::factory()->create();
Cadastro::factory(5)->create();
```

`create()` grava no banco. Para gerar objetos sem gravar:

```php
Cadastro::factory(3)->make();
```

Confira a [factory de Cadastro](database/factories/CadastroFactory.php).

## 5. Atualizar e excluir

### 35. Atualizar um model carregado

```php
$cadastro = Cadastro::findOrFail(1);
$cadastro->telefone = '(11) 95555-4444';
$cadastro->save();
```

### 36. Atualizar usando `update()`

```php
$cadastro = Cadastro::findOrFail(1);
$cadastro->update(['telefone' => '(11) 95555-4444']);
```

### 37. Atualizar várias linhas com uma consulta

```php
$quantidade = Cadastro::where('sobrenome', 'Souza')
    ->update(['telefone' => '(11) 90000-0000']);
```

O retorno é a quantidade de linhas afetadas. Atualizações em lote não carregam cada model individualmente e não disparam eventos de model como `saving` e `saved` para cada linha.

### 38. Remover um registro pelo model

```php
$cadastro = Cadastro::findOrFail(1);
$cadastro->delete();
```

### 39. Remover por ID com `destroy()`

```php
Cadastro::destroy(1);
Cadastro::destroy([2, 3]);
```

`destroy()` carrega os models e permite que eventos de exclusão sejam disparados.

### 40. Remover em lote por condição

```php
$quantidade = Cadastro::where('email', 'like', '%@teste.invalid')->delete();
```

**Atenção:** isso exclui permanentemente todas as linhas que correspondem ao filtro. O delete em lote não carrega cada model e não dispara eventos individuais. Confirme antes com o mesmo filtro usando `->get()` ou `->count()`.

### 41. Recarregar valores do banco

```php
$cadastro = Cadastro::findOrFail(1);
$cadastro->refresh(); // atualiza o objeto existente
$cadastro->fresh();   // retorna uma nova instância atualizada
```

### 42. Verificar se um model já está salvo

```php
$cadastro = Cadastro::find(1);
$cadastro?->exists;
$cadastro?->getKey();
```

## 6. Validar e proteger os dados

### 43. Validar um array no Tinker

```php
use Illuminate\Support\Facades\Validator;

$validator = Validator::make([
    'nome' => 'Maria',
    'sobrenome' => 'Souza',
    'telefone' => '(11) 99999-0000',
    'email' => 'maria@example.com',
], [
    'nome' => ['required', 'string', 'max:50'],
    'sobrenome' => ['required', 'string', 'max:50'],
    'telefone' => ['required', 'string', 'max:20'],
    'email' => ['required', 'email', 'max:50'],
]);

$validator->passes();
$validator->errors()->all();
$validator->validated();
```

Estas regras respeitam os limites da migração. A migração atual não define `email` como único; para garantir isso, adicione uma regra de validação `unique` e uma restrição única no banco.

### 44. Entender a proteção de atribuição em massa

```php
(new Cadastro)->getFillable();
(new Cadastro)->getGuarded();
```

Somente os campos autorizados em `$fillable` devem ser enviados a `create()`, `fill()` e `update()`. Isso ajuda a evitar que campos não permitidos sejam alterados por dados recebidos do navegador.

## 7. Transactions e SQL

### 45. Agrupar mudanças em uma transação

```php
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    Cadastro::create([
        'nome' => 'Teste',
        'sobrenome' => 'Transacao',
        'telefone' => '(11) 90000-0001',
        'email' => 'teste.transacao@example.com',
    ]);
});
```

Se ocorrer uma exceção dentro do callback, o Laravel desfaz a transação automaticamente. A execução bem-sucedida confirma a transação.

### 46. Usar uma transação manual e desfazer o teste

Use apenas para testes no Tinker e sempre finalize a transação:

```php
DB::beginTransaction();

$teste = Cadastro::create([
    'nome' => 'Temporario',
    'sobrenome' => 'Rollback',
    'telefone' => '(11) 90000-0002',
    'email' => 'temporario.rollback@example.com',
]);

DB::rollBack();
```

Depois do rollback, a linha criada nessa transação deixa de existir.

### 47. Executar uma consulta SQL parametrizada

```php
DB::select('select id, nome, email from cadastros where id = ?', [1]);
```

Prefira Eloquent/Query Builder na maioria dos casos. Ao usar SQL, passe valores em bindings (`?`) em vez de concatenar dados recebidos do usuário.

### 48. Inspecionar o SQL produzido pelo Eloquent

```php
$query = Cadastro::where('email', 'maria@example.com');
$query->toSql();
$query->getBindings();
```

`toSql()` mostra os placeholders; `getBindings()` mostra os valores que serão enviados separadamente.

## 8. Explorar controllers, rotas e views

Tinker permite instanciar serviços e inspecionar objetos da aplicação, mas **não simula automaticamente uma requisição HTTP completa**: middlewares, sessão, CSRF e ciclo completo de resposta são executados quando uma requisição chega pelo roteador.

### 49. Listar rotas pelo terminal

Saia do Tinker e rode:

```powershell
php artisan route:list --path=index
```

No projeto existem uma rota GET `/index` chamada `index` e uma rota POST `/index` chamada `enviar`, definidas em [routes/web.php](routes/web.php).

### 50. Verificar o nome da rota no Tinker

```php
use Illuminate\Support\Facades\Route;

Route::has('index');
Route::has('enviar');
route('index');
route('enviar');
```

`route()` gera a URL pelo nome da rota; não executa o controller.

### 51. Inspecionar os métodos e URI de uma rota

```php
$rota = app('router')->getRoutes()->getByName('enviar');
$rota->uri();
$rota->methods();
$rota->getActionName();
```

### 52. Resolver o controller pelo container

```php
use App\Http\Controllers\SiteController;

$controller = app(SiteController::class);
$controller instanceof SiteController;
```

### 53. Chamar o método da página e inspecionar a view retornada

```php
$view = $controller->index();
$view->getName();
$view->getData();
```

No projeto, `index()` retorna a view `index` com uma variável chamada `nome`. A implementação atual está no [SiteController](app/Http/Controllers/SiteController.php).

### 54. Confirmar que uma view existe

```php
view()->exists('index');
```

O nome `index` corresponde ao arquivo [resources/views/index.blade.php](resources/views/index.blade.php).

### 55. Renderizar uma view manualmente

```php
$html = view('index', ['nome' => 'Pessoa de teste'])->render();
str_contains($html, 'Pessoa de teste');
```

A view atual usa `@vite`; dependendo do ambiente, pode ser necessário gerar os assets com `npm run build` para renderizar o HTML sem erro de manifesto ausente.

### 56. Criar uma requisição de teste e chamar o método do controller

```php
use Illuminate\Http\Request;

$request = Request::create('/index', 'POST', [
    'nome' => 'Pessoa',
    'sobrenome' => 'Teste',
    'telefone' => '(11) 90000-0003',
    'email' => 'pessoa.teste@example.com',
]);
```

A implementação atual de `store()` recebe `Request` e grava usando `Cadastro::create()`, mas faz `dump()` e não retorna redirecionamento. Chamá-la manualmente pelo Tinker pode inserir uma linha real; prefira testar a lógica de persistência diretamente ou usar testes HTTP automatizados para validar a rota e os middlewares.

### 57. Como a view envia o formulário

O formulário já tem `method="POST"`, aponta para `route('enviar')` e inclui `@csrf`. O fluxo atual é:

1. O navegador envia os campos para a rota `enviar`.
2. A rota encaminha a requisição para `SiteController::store()`.
3. O controller deve validar `$request`, chamar `Cadastro::create($dados)` e devolver uma resposta.
4. A view recebe dados do controller e apresenta a interface.

Em uma implementação comum de `store()`, valide antes de persistir e retorne uma resposta, por exemplo:

```php
$dados = $request->validate([
    'nome' => ['required', 'string', 'max:50'],
    'sobrenome' => ['required', 'string', 'max:50'],
    'telefone' => ['required', 'string', 'max:20'],
    'email' => ['required', 'email', 'max:50'],
]);

Cadastro::create($dados);

return to_route('index')->with('status', 'Cadastro enviado com sucesso.');
```

Na view Blade, mostre a mensagem e repopule os campos após erro:

```blade
@if (session('status'))
    <p>{{ session('status') }}</p>
@endif

<input name="nome" value="{{ old('nome') }}">
@error('nome')
    <p>{{ $message }}</p>
@enderror
```

Blade escapa `{{ ... }}` por padrão. Evite `{!! $valor !!}` com dados do usuário, pois isso pode permitir injeção de HTML/JavaScript.

## 9. Comandos úteis fora do Tinker

```powershell
php artisan route:list --path=index
php artisan migrate:status
php artisan make:model Nota -m
php artisan make:controller NotaController --resource
php artisan test
```

- `route:list`: lista rotas, métodos HTTP, nomes e controllers.
- `migrate:status`: mostra quais migrações foram executadas.
- `make:model Nota -m`: cria um model e uma migração. Revise os arquivos antes de migrar.
- `make:controller NotaController --resource`: cria um controller com métodos CRUD padrão.
- `test`: executa os testes da aplicação.

## 10. Dicas finais

- Use `dump($variavel)` para inspecionar sem encerrar a sessão; `dd($variavel)` interrompe a execução.
- Tinker mantém variáveis e imports enquanto a sessão estiver aberta. Se alterar código PHP, reinicie a sessão para evitar objetos antigos carregados em memória.
- Comece consultas potencialmente grandes com `count()`, `limit()` ou filtros antes de usar `get()`/`all()`.
- Use validação no controller e `$fillable` no model; são proteções complementares.
- Para testes repetíveis de rotas, validação e respostas HTTP, prefira testes automatizados em `tests/Feature` em vez de chamar controller manualmente pelo Tinker.
- Os exemplos de exclusão e atualização em lote são reais: teste primeiro com uma consulta de leitura e faça backup antes de operar em dados importantes.
