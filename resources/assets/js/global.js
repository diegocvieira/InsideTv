//Add CSRF token on all ajax requisitions
//$.ajaxSetup({
    //headers: {
        //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//    }
//});

$(document).ready(function(){
    $(".button-collapse").sideNav();//Ativar menu responsivo do topo

    $('select').material_select();//Ativar estilos dos selects de todas paginas
});

//Busca do topo
$(document).on('click', 'nav form button', function(){
    if($('nav .palavra-chave').val() == '')
        return false;

    else
        return true;
});

//Alterar label da busca do topo
$(document).on('change', 'nav .search-filter', function(){
    var value = $(this).val();
    var tag = $('nav .palavra-chave label');

    switch(value){
        case 'usuarios':
            tag.html('Busque por usuários');
            break;

        case 'series':
            tag.html('Busque por séries');
            break;

        case 'forum':
            tag.html('Busque por tópicos no forum');
            break;

        case 'all':
            tag.html('Busque por Séries, usuários e tópicos');
    }
});

//Enviar formulario padrao
$(document).on('submit', '#form-genero, #form-emissora, #form-serie, #form-login, #form-cadastro, #form-config-admin', function(e){
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data){
            if(data.status == 'erro')
                Materialize.toast(data.msg, 5000);

            else
                window.location = data.url;
        }
    });
});

//Deletar algo padrao
$(document).on('click', '#form-genero-delete, #form-emissora-delete, #form-serie-delete, #form-comentario-serie-delete', function(){
    $('#form-delete', this).submit();
});
$(document).on('submit','#form-delete',function(e){
    e.preventDefault();

    var url = $(this).attr('action');
    var dados = $(this).serialize();
    var get_comment = $(this);

    $('#modal-default .title').text('Confirmar exclusão');
    $('#modal-default .text').text('Tem certeza que deseja excluir?');
    $('#modal-default').modal('open');

    $('#modal-default #confirmar').on('click', function(){
        $.ajax({
            type: 'DELETE',
            url: url,
            data: dados,
            dataType: 'json',
            success: function (data){
                if(data.tipo == 'comentario-serie'){
                    get_comment.closest('.comentario').remove();
                }

                else
                    window.location = data.url;
            }
        });
    });
});
