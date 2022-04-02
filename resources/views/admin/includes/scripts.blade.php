<script type="text/javascript">

    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("form[name='form-adicionar-peca']").submit(function () {
            var dados   = $(this).serialize();
            var rota    =   this.action;


            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {
                    if('erro' in data){
                        alert(data.erro);
                    }else{

                        $('#tabela-historico-pecas').html(data.pecas);
                    }
                },
                error:function (data,e) {
                    alert(data);
                }
            });
            return false;


        });
        $("form[name='form-adicionar-servico']").submit(function () {
            var dados   = $(this).serialize();
            var rota    =   this.action;


            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {
                    if('erro' in data){
                        alert(data.erro);
                    }else{

                        $('#tabela-historico-servicos').html(data.html);
                    }
                }
            });
            return false;


        });

        $("form[name='form-cliente']").submit(function(){

            var dados   = $(this).serialize();
            var rota    =   this.action;


            $.ajax({
                type: "GET",
                url: rota,
                data: dados,
                success: function( data )
                {
                    if('erro' in data){
                        alert(data.erro);
                    }else{

                        $('#form-cliente').html(data.html);
                        var option  =   '<option value="'+data.cliente.id+'" selected>'+data.cliente.nome;
                        $("select[name='cliente']").html(option);
                        $("#modalCliente").modal('hide');
                    }
                }
            });
            return false;
        });

        $("form[name='form-veiculo']").submit(function(){

            var dados   = $(this).serialize();
            var rota    =   this.action;


            $.ajax({
                type: "POST",
                url: rota,
                data: dados,
                success: function( data )
                {
                    if('erro' in data){
                        alert(data.erro);
                    }else{

                        $('#form-veiculo').html(data.html);
                        var option  =   '<option value="'+data.veiculo.id+'" selected>'+data.veiculo.placa;
                        $("select[name='veiculo']").html(option);
                        $("#modalVeiculo").modal('hide');

                    }
                }
            });
            return false;
        });

        $("form[name='modal-adicionar-servico']").submit(function(){

            var dados   = $(this).serialize();
            var rota    =   this.action;


            $.ajax({
                type: "post",
                url: rota,
                data: dados,

                success: function( data )
                {

                    if('erro' in data){
                        alert(data.erro);
                    }else{

                        $('#form-modal-servicos').html(data.html);
                        var option  =   '<option value="'+data.servico.id+'" selected>'+data.servico.descricao+" - Valor: "+data.servico.valor;

                        $("select[name='servico_id']").html(option);
                        $('#valorServico').val(data.servico.valor);
                        $("#modalServico").modal('hide');

                    }
                }
            });
            return false;
        });

        var URL     =   $('#url').val();
        $('.numero').mask("#.##0.00" , { reverse:true})
        $('.dinheiro').mask("#.##0.00" , { reverse:true})
        $('#selectServicos').select2({
            //placeholder: 'Search for a category',
            ajax: {
                type: 'POST',
                url: URL+"/admin/servico/carregarSelect2",
                dataType: 'json',
                beforeSend: function (xhr) {
                    var token = $("input[name='_token']" ).val();

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                quietMillis: 400,
                delay:400,
                data: function (term, page) {
                    return {
                        q: term.term, //search term
                        // page size
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            },
            templateResult: function (data) {

                var html    =   $('<div class="select2-user-result"><h5>'+data.nome+'</h5>' +
                    '<h6>Valor: <b>'+data.valor+'</b></h6>'+

                    '</div>'
                );
                return html;
            },
            templateSelection:function (data) {
                var html    =   $('<div class="select2-user-result"><b></b>'+data.text+'</div><br>'

                );
                $('#valorServico').val(data.valor);
                $('#valorServico').focus();

                return html;
            },
        });

        $('.modalAtualizarStatus').click(function(){

            var id   =   $(this).attr('status_id');

            $('#status_id').val(id);
            $('.texto-excluir').html('Deseja realmente excluir o registro com o id '+id);
        });
        $('.clientes_select2').select2({
            //placeholder: 'Search for a category',
            ajax: {
                type: 'POST',
                url: URL+"/admin/cliente/carregarSelect2",
                dataType: 'json',
                beforeSend: function (xhr) {
                    var token = $("input[name='_token']" ).val();

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                quietMillis: 400,
                delay:400,
                data: function (term, page) {
                    return {
                        q: term.term, //search term
                        // page size
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            },
            templateResult: function (data) {

                var html    =   $('<div class="select2-user-result"><h5>'+data.nome+'</h5>' +
                    '<h6>Telefone: <b>'+data.telefone+'</b></h6>'+

                    '</div>'
                );
                return html;
            },
            templateSelection:function (data) {
                var html    =   $('<div class="select2-user-result"><b>Cliente: </b>'+data.text+'</div><br>'
                );
                return html;
            },
        });
        $('.veiculo_select2').select2({
            //placeholder: 'Search for a category',
            ajax: {
                type: 'POST',
                url: URL+"/admin/veiculo/carregarSelect2",
                dataType: 'json',
                beforeSend: function (xhr) {
                    var token = $("input[name='_token']" ).val();

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                quietMillis: 400,
                delay:400,
                data: function (term, page) {
                    return {
                        q: term.term, //search term
                        // page size
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
            },
            templateResult: function (data) {
                var html    =   $('<div class="select2-user-result"><h5>'+data.text+'</h5>' +
                    '<h6>Modelo: <b>'+data.modelo+'</b></h6>'+

                    '</div>'
                );
                return html;
            },
            templateSelection:function (data) {
                var html    =   $('<div class="select2-user-result"><b>Veiculo: </b>'+data.text+'</div><br>'
                );
                return html;
            },
        });


        $('.dataTempo').datetimepicker({
            locale :"pt-br",
            format: 'DD/MM/YYYY HH:mm',
        });

        $('.placa').mask('AAA0U00', {
            translation: {
                'A': {
                    pattern: /[A-Za-z]/
                },
                'U': {
                    pattern: /[A-Za-z0-9]/
                },
            },
            onKeyPress: function (value, e, field, options) {
                // Convert to uppercase
                e.currentTarget.value = value.toUpperCase();

                // Get only valid characters
                let val = value.replace(/[^\w]/g, '');

                // Detect plate format
                let isNumeric = !isNaN(parseFloat(val[4])) && isFinite(val[4]);
                let mask = 'AAA0U00';
                if(val.length > 4 && isNumeric) {
                    mask = 'AAA0000';
                }
                $(field).mask(mask, options);
            }
        });
        $('.mod_ano').mask("00/00",{placeholder: "  /  "});
        $('.telefone').mask("(99)999999999");

    });


</script>
