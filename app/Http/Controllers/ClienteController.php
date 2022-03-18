<?php

namespace App\Http\Controllers;

use App\Models\AplicativoMensagem;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $clientes = Cliente::pesquisarPorNome($r->input('nome'))
            ->pesquisarPorEmail($r->input('email'))
            ->orderby('id','desc')->paginate(30);;
        $dados      =  [
            "titulo"    => "Clientes",
            "titulo_tabela" => "Lista de Clientes"
        ];

        return view('admin.clientes.index',$dados)->with('clientes',$clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function novo()
    {

        $dados      =  [
            "titulo"    => "Cliente",
            "titulo_formulario" =>'Novo'
        ];
        return view('admin.clientes.formulario',$dados);

    }

    public function cadastrar()
    {
        try{
            $id = Cliente::gravar(\request());
            return redirect()->route('cliente.editar',$id);
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function editar($id)
    {

        $dados      =  [
            "titulo"    => "Cliente",
            "titulo_formulario" =>'Editar'
        ];
        $cliente    =   Cliente::find($id);
        $app        =   AplicativoMensagem::all();

        return view('admin.clientes.formulario',$dados)->with('cliente',$cliente)->with('app',$app);
    }

    public function atualizar()
    {
        try{
            $id = Cliente::atualizar(\request());
            return redirect()->route('cliente.editar',$id);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    public function pesquisa(Request $r)
    {
//        return route('cliente.pesquisa')->link();
        $clientes =
        $dados      =  [
            "titulo"    => "Clientes",
            "titulo_tabela" => "Lista de Clientes"
        ];

        return view('admin.clientes.index',$dados)->with('clientes',$clientes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
