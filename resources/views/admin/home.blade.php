@extends('adminlte::page')

@section('title', $titulo)

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
    @include('admin.includes.css')
@stop

@section('js')
    @include('admin.includes.scripts')
@stop
