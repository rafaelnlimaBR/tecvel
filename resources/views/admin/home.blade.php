@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{$titulo}}</h1>
    <input type="hidden" value="{{URL::to('')}}" id="url">
@stop

@section('content')

    {{--Alerta--}}
    @include('admin.includes.alertas')
    {{--Conteudo--}}
    @yield('conteudo')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
