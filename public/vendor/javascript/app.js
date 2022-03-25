
$(document).ready(function() {
    var URL     =   $('#url').val();

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

