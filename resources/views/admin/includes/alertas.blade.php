
@if ($message = Session::has('alerta'))
    <div class="alert alert-{{Session::get('alerta')['tipo']}} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h6><i class="icon fas fa-{{Session::get('alerta')['icon']}}"></i> {{Session::get('alerta')['titulo']}}!</h6>
        <p style="font-size: 10px">{{Session::get('alerta')['msg']}}</p>
    </div>
@endif