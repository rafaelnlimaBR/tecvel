<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//Route::group(['prefix'=>'admin','middleware'=>'auth:web'],function(){
Route::group(['prefix'=>'admin'],function(){

    Route::get('/teste', function (){
        $contrato       =   \App\Models\Contrato::find(1);

        return $contrato->historicos->last()->tipo->descricao;

    });

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'home'])->name('home');

    Route::get('/configuracao/', [App\Http\Controllers\ConfiguracaoController::class, 'editar'])->name('configuracao.editar');
    Route::post('/configuracao/atualizar', [App\Http\Controllers\ConfiguracaoController::class, 'atualizar'])->name('configuracao.atualizar');

    Route::get('/contratos', [App\Http\Controllers\ContratoController::class, 'index'])->name('contrato.index');
    Route::get('/contrato/novo/{tipo}', [App\Http\Controllers\ContratoController::class, 'novo'])->name('contrato.novo');
    Route::get('/contrato/editar/{id}', [App\Http\Controllers\ContratoController::class, 'editar'])->name('contrato.editar');
    Route::post('/contrato/cadastrar', [App\Http\Controllers\ContratoController::class, 'cadastrar'])->name('contrato.cadastrar');
    Route::post('/contrato/atualizar', [App\Http\Controllers\ContratoController::class, 'atualizar'])->name('contrato.atualizar');
    Route::post('/contrato/excluir', [App\Http\Controllers\ContratoController::class, 'excluir'])->name('contrato.excluir');

    Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/cliente/novo', [App\Http\Controllers\ClienteController::class, 'novo'])->name('cliente.novo');
    Route::get('/cliente/editar/{id}', [App\Http\Controllers\ClienteController::class, 'editar'])->name('cliente.editar');
    Route::post('/cliente/cadastrar', [ClienteController::class, 'cadastrar'])->name('cliente.cadastrar');
    Route::post('/cliente/atualizar', [ClienteController::class, 'atualizar'])->name('cliente.atualizar');
    Route::post('/cliente/excluir', [ClienteController::class, 'excluir'])->name('cliente.excluir');
    Route::post('/cliente/carregarSelect2', [ClienteController::class, 'carregarSelect2'])->name('cliente.carregarSelect2');

    Route::get('/veiculos', [App\Http\Controllers\VeiculoController::class, 'index'])->name('veiculo.index');
    Route::get('/veiculo/novo', [App\Http\Controllers\VeiculoController::class, 'novo'])->name('veiculo.novo');
    Route::get('/veiculo/editar/{id}', [App\Http\Controllers\VeiculoController::class, 'editar'])->name('veiculo.editar');
    Route::post('/veiculo/cadastrar', [App\Http\Controllers\VeiculoController::class, 'cadastrar'])->name('veiculo.cadastrar');
    Route::post('/veiculo/atualizar', [App\Http\Controllers\VeiculoController::class, 'atualizar'])->name('veiculo.atualizar');
    Route::post('/veiculo/excluir', [App\Http\Controllers\VeiculoController::class, 'excluir'])->name('veiculo.excluir');
    Route::post('/veiculo/carregarSelect2', [\App\Http\Controllers\VeiculoController::class, 'carregarSelect2'])->name('veiculo.carregarSelect2');

    Route::get('/servicos', [App\Http\Controllers\ServicoController::class, 'index'])->name('servico.index');
    Route::get('/servico/novo', [App\Http\Controllers\ServicoController::class, 'novo'])->name('servico.novo');
    Route::get('/servico/editar/{id}', [App\Http\Controllers\ServicoController::class, 'editar'])->name('servico.editar');
    Route::post('/servico/cadastrar', [App\Http\Controllers\ServicoController::class, 'cadastrar'])->name('servico.cadastrar');
    Route::post('/servico/atualizar', [App\Http\Controllers\ServicoController::class, 'atualizar'])->name('servico.atualizar');
    Route::post('/servico/excluir', [App\Http\Controllers\ServicoController::class, 'excluir'])->name('servico.excluir');

    Route::get('/status', [App\Http\Controllers\StatusController::class, 'index'])->name('status.index');
    Route::get('/status/novo', [App\Http\Controllers\StatusController::class, 'novo'])->name('status.novo');
    Route::get('/status/editar/{id}', [App\Http\Controllers\StatusController::class, 'editar'])->name('status.editar');
    Route::post('/status/cadastrar', [App\Http\Controllers\StatusController::class, 'cadastrar'])->name('status.cadastrar');
    Route::post('/status/atualizar', [App\Http\Controllers\StatusController::class, 'atualizar'])->name('status.atualizar');
    Route::post('/status/excluir', [App\Http\Controllers\StatusController::class, 'excluir'])->name('status.excluir');
    Route::post('/status/adicionar/relacionamento', [App\Http\Controllers\StatusController::class, 'adicionarStatus'])->name('status.adicionar.relacionamento');
    Route::get('/status/remover/relacionamento/{status_atual_id}/{status_proximo}', [App\Http\Controllers\StatusController::class, 'removerStatus'])->name('status.remover.relacionamento');

    Route::get('/fornecedores', [App\Http\Controllers\FornecedorController::class, 'index'])->name('fornecedor.index');
    Route::get('/fornecedor/novo', [App\Http\Controllers\FornecedorController::class, 'novo'])->name('fornecedor.novo');
    Route::get('/fornecedor/editar/{id}', [App\Http\Controllers\FornecedorController::class, 'editar'])->name('fornecedor.editar');
    Route::post('/fornecedor/cadastrar', [App\Http\Controllers\FornecedorController::class, 'cadastrar'])->name('fornecedor.cadastrar');
    Route::post('/fornecedor/atualizar', [App\Http\Controllers\FornecedorController::class, 'atualizar'])->name('fornecedor.atualizar');
    Route::post('/fornecedor/excluir', [App\Http\Controllers\FornecedorController::class, 'excluir'])->name('fornecedor.excluir');

    Route::get('/pedidos', [App\Http\Controllers\PedidoController::class, 'index'])->name('pedido.index');
    Route::get('/pedido/novo', [App\Http\Controllers\PedidoController::class, 'novo'])->name('pedido.novo');
    Route::get('/pedido/editar/{id}', [App\Http\Controllers\PedidoController::class, 'editar'])->name('pedido.editar');
    Route::post('/pedido/cadastrar', [App\Http\Controllers\PedidoController::class, 'cadastrar'])->name('pedido.cadastrar');
    Route::post('/pedido/atualizar', [App\Http\Controllers\PedidoController::class, 'atualizar'])->name('pedido.atualizar');
    Route::post('/pedido/excluir', [App\Http\Controllers\PedidoController::class, 'excluir'])->name('pedido.excluir');
});
