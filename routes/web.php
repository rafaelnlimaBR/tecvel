<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\View;
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

Route::get('/teste', function () {
    return \App\Models\Post::habilitados(1);
});


Auth::routes();




//Route::group(['prefix'=>'admin','middleware'=>'auth:web'],function(){
Route::group(['prefix'=>'admin'],function(){


    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'home'])->name('home');

    Route::get('/configuracao/', [App\Http\Controllers\ConfiguracaoController::class, 'editar'])->name('configuracao.editar');
    Route::post('/configuracao/atualizar', [App\Http\Controllers\ConfiguracaoController::class, 'atualizar'])->name('configuracao.atualizar');

    Route::get('/contratos', [App\Http\Controllers\ContratoController::class, 'index'])->name('contrato.index');
    Route::get('/contrato/novo/{tipo}', [App\Http\Controllers\ContratoController::class, 'novo'])->name('contrato.novo');
    Route::get('/contrato/editar/{id}/historico/{historico_id}', [App\Http\Controllers\ContratoController::class, 'editar'])->name('contrato.editar');
    Route::post('/contrato/cadastrar', [App\Http\Controllers\ContratoController::class, 'cadastrar'])->name('contrato.cadastrar');
    Route::post('/contrato/atualizar', [App\Http\Controllers\ContratoController::class, 'atualizar'])->name('contrato.atualizar');
    Route::post('/contrato/excluir', [App\Http\Controllers\ContratoController::class, 'excluir'])->name('contrato.excluir');
    Route::post('/contrato/atualizar/status', [App\Http\Controllers\ContratoController::class, 'atualizarStatus'])->name('contrato.atualizar.status');

    Route::post('/contrato/pagar', [App\Http\Controllers\HistoricoController::class, 'pagar'])->name('historico.pagar');
    Route::get('/contrato/historico/{historico_id}/faturar/', [App\Http\Controllers\HistoricoController::class, 'faturar'])->name('historico.faturar');
    Route::get('/contrato/historico/{historico_id}/faturar/editar/{fatura_id}', [App\Http\Controllers\HistoricoController::class, 'editarPagamento'])->name('historico.faturar.editar');
    Route::post('/contrato/historico/faturar/atualizar', [App\Http\Controllers\HistoricoController::class, 'atualizarPagamento'])->name('historico.faturar.atualizar');
    Route::post('/contrato/historico/faturar/excluir', [App\Http\Controllers\HistoricoController::class, 'excluirPagamento'])->name('historico.fatura.excluir');

    Route::get('/contrato/editar/{id}/historico/{historico_id}/servicos', [App\Http\Controllers\TrabalhoController::class, 'index'])->name('trabalho.index');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/servico/editar/{$trabalho_id}', [App\Http\Controllers\TrabalhoController::class, 'editar'])->name('trabalho.editar');



    Route::post('/historico/atualizar/servico', [App\Http\Controllers\TrabalhoController::class, 'cadastrar'])->name('historico.cadastrar.servico');
    Route::get('/historico/excluir/servico', [App\Http\Controllers\TrabalhoController::class, 'excluir'])->name('historico.excluir.servico');

    Route::post('/historico/peca/adicionar', [App\Http\Controllers\HistoricoController::class, 'adicionarPeca'])->name('peca.cadastrar');
    Route::get('/historico/peca/excluir', [App\Http\Controllers\HistoricoController::class, 'desvincularPeca'])->name('peca.excluir');
    Route::post('/historico/peca/atualizar', [App\Http\Controllers\HistoricoController::class, 'atualizarPeca'])->name('peca.atualizar');
    Route::get('/pedido/adicionar/peca', [App\Http\Controllers\PecasController::class, 'adicionarPedido'])->name('pedido.adicionar.peca');

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
    Route::post('/servico/carregarSelect2', [App\Http\Controllers\ServicoController::class, 'carregarSelect2'])->name('servico.carregarSelect2');

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
    Route::get('/fornecedor/desconto', [App\Http\Controllers\FornecedorController::class, 'descontoAjax'])->name('fornecedor.descontoAjax');

    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/post/novo', [App\Http\Controllers\PostController::class, 'novo'])->name('post.novo');
    Route::get('/post/editar/{id}', [App\Http\Controllers\PostController::class, 'editar'])->name('post.editar');
    Route::post('/post/cadastrar', [App\Http\Controllers\PostController::class, 'cadastrar'])->name('post.cadastrar');
    Route::post('/post/atualizar', [App\Http\Controllers\PostController::class, 'atualizar'])->name('post.atualizar');
    Route::post('/post/excluir', [App\Http\Controllers\PostController::class, 'excluir'])->name('post.excluir');
    Route::get('/post/editar/{id}/imagen/nova', [App\Http\Controllers\ImagemPostController::class, 'novo'])->name('post.imagem.novo');
    Route::get('/post/editar/{id}/imagen/editar/{imagem_id}', [App\Http\Controllers\ImagemPostController::class, 'editar'])->name('post.imagem.editar');
    Route::post('/post/editar/cadastrar', [App\Http\Controllers\ImagemPostController::class, 'cadastrar'])->name('post.imagem.cadastrar');
    Route::post('/post/editar/atualizar', [App\Http\Controllers\ImagemPostController::class, 'atualizar'])->name('post.imagem.atualizar');
    Route::post('/post/editar/excluir', [App\Http\Controllers\ImagemPostController::class, 'excluir'])->name('post.imagem.excluir');

    Route::get('/comentario/editar/{id}', [App\Http\Controllers\ComentarioController::class, 'editar'])->name('comentario.editar');
    Route::post('/comentario/atualizar', [App\Http\Controllers\ComentarioController::class, 'atualizar'])->name('comentario.atualizar');
    Route::post('/responder/comentario', [App\Http\Controllers\RespostaController::class, 'gravar'])->name('comentario.resposta.gravar');
    Route::post('/atualizar/resposta/comentario', [App\Http\Controllers\RespostaController::class, 'atualizar'])->name('comentario.resposta.atualizar');
    Route::post('/excluir/resposta/comentario', [App\Http\Controllers\RespostaController::class, 'excluir'])->name('comentario.resposta.excluir');
    Route::get('/comentario/editar/{id}/responder', [App\Http\Controllers\RespostaController::class, 'novo'])->name('comentario.editar.responder');
    Route::get('/comentario/editar/{id}/editar/resposta/{resposta_id}', [App\Http\Controllers\RespostaController::class, 'editar'])->name('comentario.responder.editar');

    Route::get('/pedidos', [App\Http\Controllers\PedidoController::class, 'index'])->name('pedido.index');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/pedido/novo', [App\Http\Controllers\PedidoController::class, 'novo'])->name('pedido.novo');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/pedido/editar/{pedido_id}', [App\Http\Controllers\PedidoController::class, 'editar'])->name('pedido.editar');
    Route::post('/pedido/cadastrar', [App\Http\Controllers\PedidoController::class, 'cadastrar'])->name('pedido.cadastrar');
    Route::post('/pedido/atualizar', [App\Http\Controllers\PedidoController::class, 'atualizar'])->name('pedido.atualizar');
    Route::post('/pedido/excluir', [App\Http\Controllers\PedidoController::class, 'excluir'])->name('pedido.excluir');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/pedido/editar/{pedido_id}/pagar', [App\Http\Controllers\PedidoController::class, 'novoPagamento'])->name('pedido.novo.pagamento');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/pedido/editar/{pedido_id}/editar/pagamento/{saida_id}', [App\Http\Controllers\PedidoController::class, 'editarPagamento'])->name('pedido.editar.pagamento');
    Route::post('/pedido/pagar', [App\Http\Controllers\PedidoController::class, 'pagar'])->name('pedido.pagar');
    Route::post('/pedido/excluir/pagamento', [App\Http\Controllers\PedidoController::class, 'excluirPagamento'])->name('pedido.excluir.pagamento');
    Route::post('/pedido/atualizar/pagamento', [App\Http\Controllers\PedidoController::class, 'atualizarPagamento'])->name('pedido.atualizar.pagamento');

    Route::get('/contrato/editar/{id}/historico/{historico_id}/terceirizado/novo', [App\Http\Controllers\TerceirizadosController::class, 'novo'])->name('terceirizado.novo');
    Route::post('/terceirizado/cadastrar', [App\Http\Controllers\TerceirizadosController::class, 'cadastrar'])->name('terceirizado.cadastrar');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/terceirizado/editar/{terceirizado_id}', [App\Http\Controllers\TerceirizadosController::class, 'editar'])->name('terceirizado.editar');
    Route::post('/terceirizado/atualizar', [App\Http\Controllers\TerceirizadosController::class, 'atualizar'])->name('terceirizado.atualizar');
    Route::post('/terceirizado/excluir', [App\Http\Controllers\TerceirizadosController::class, 'excluir'])->name('terceirizado.excluir');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/terceirizado/editar/{terceirizado_id}/pagar', [App\Http\Controllers\TerceirizadosController::class, 'novoPagamento'])->name('terceirizado.novo.pagamento');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/terceirizado/editar/{terceirizado_id}/editar/pagamento/{saida_id}', [App\Http\Controllers\TerceirizadosController::class, 'editarPagamento'])->name('terceirizado.editar.pagamento');
    Route::post('/terceirizado/pagar', [App\Http\Controllers\TerceirizadosController::class, 'pagar'])->name('terceirizado.pagar');
    Route::post('/terceirizado/excluir/pagamento', [App\Http\Controllers\TerceirizadosController::class, 'excluirPagamento'])->name('terceirizado.excluir.pagamento');
    Route::post('/terceirizado/atualizar/pagamento', [App\Http\Controllers\TerceirizadosController::class, 'atualizarPagamento'])->name('terceirizado.atualizar.pagamento');


    Route::get('/contrato/editar/{id}/historico/{historico_id}/comissao/novo', [App\Http\Controllers\ComissaoController::class, 'novo'])->name('comissao.novo');
    Route::post('/comissao/cadastrar', [App\Http\Controllers\ComissaoController::class, 'cadastrar'])->name('comissao.cadastrar');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/comissao/editar/{comissao_id}', [App\Http\Controllers\ComissaoController::class, 'editar'])->name('comissao.editar');
    Route::post('/comissao/atualizar', [App\Http\Controllers\ComissaoController::class, 'atualizar'])->name('comissao.atualizar');
    Route::post('/comissao/excluir', [App\Http\Controllers\ComissaoController::class, 'excluir'])->name('comissao.excluir');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/comissao/editar/{comissao_id}/pagar', [App\Http\Controllers\ComissaoController::class, 'novoPagamento'])->name('comissao.novo.pagamento');
    Route::get('/contrato/editar/{id}/historico/{historico_id}/comissao/editar/{comissao_id}/editar/pagamento/{saida_id}', [App\Http\Controllers\ComissaoController::class, 'editarPagamento'])->name('comissao.editar.pagamento');
    Route::post('/comissao/pagar', [App\Http\Controllers\ComissaoController::class, 'pagar'])->name('comissao.pagar');
    Route::post('/comissao/excluir/pagamento', [App\Http\Controllers\ComissaoController::class, 'excluirPagamento'])->name('comissao.excluir.pagamento');
    Route::post('/comissao/atualizar/pagamento', [App\Http\Controllers\ComissaoController::class, 'atualizarPagamento'])->name('comissao.atualizar.pagamento');
    
    Route::post('/tipo/pagamentos/taxas', [App\Http\Controllers\TipoPagamentosController::class, 'listarTaxas'])->name('tipospagamentos.listar.taxas');

    Route::get('/saidas', [App\Http\Controllers\SaidaController::class, 'index'])->name('saida.index');



    View::composer(['admin.entradas.includes.form'],function($view){
        $view->with(['tipos'=>\App\Models\TipoPagamentos::all()]);
    });
});

Route::get('/{id}/{titulo}', [App\Http\Controllers\SiteController::class, 'post'])->name('site.postagem');
Route::get('/', [App\Http\Controllers\SiteController::class, 'home'])->name('site.home');
Route::get('/postagens', [App\Http\Controllers\SiteController::class, 'posts'])->name('site.postagens');
Route::post('/comentar/postagem', [App\Http\Controllers\SiteController::class, 'comentar'])->name('site.postagem.comentar');