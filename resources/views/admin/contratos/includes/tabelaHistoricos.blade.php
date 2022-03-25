<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Data</th>
        <th>Status</th>
        <th>Tipo</th>

        <th>.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contrato->status as $s)
        <tr data-widget="expandable-table" aria-expanded="false">
            <td>{{date('d/m/Y H:m', strtotime($s->pivot->data))}}</td>
            <td>{{$s->nome}}</td>
            <td>{{\App\Models\TipoContrato::find($s->pivot->tipo_id)->descricao}}</td>

            <td>des.</td>
        </tr>
        <tr class="expandable-body d-none">
            <td colspan="5">
                <p style="display: none;">
                    {{$s->pivot->obs}}
                </p>
            </td>
        </tr>

    @endforeach

    </tbody>
</table>