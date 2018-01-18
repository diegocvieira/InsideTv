/*
//Adiciona texto de sem lista se deixa a lista sem serie
function adicionarMsg(){
    $(".drop").each(function(){
        if($(this).find('li').length == 0 && $(this).find('.sem-lista').length == 0) {
            $(this).append("<span class='sem-lista'>Arraste alguma série para aqui</span>");
        }
    });
}

//Adicionar serie na lista
function addSerie(data, drop){
    $.ajax({
        url: '/ajax/listas/adicionar',
        method: 'POST',
        dataType:'json',
        data: data,
        success: function(data){
            if(drop != '') {
                var url = "/serie/_slug_".replace('_slug_', data.slug);

                drop.append("<li class='serie' data-id='" + data.id + "'><span class='serie-nome'>" + data.titulo + "</span><div class='options-serie'><i class='large material-icons'>more_horiz</i><ul class='sub_options'><li><a href='" + url + "'>Ir para a página da série</a></li><li><a href='#' class='remove-serie'>Remover da lista</a></li></ul></div></li>");
            }
        }
    });
}

$('.remove-serie').click(function(){
    var serie_id = $(this).closest('.serie').data('id');

    $(this).closest('.serie').remove();

    //Adiciona texto de sem lista se deixa a lista sem serie
    adicionarMsg();

    $.get('/ajax/listas/remover_serie', {serie_id : serie_id}, function(data){});
});


$(document).ready(function(){
    $(document).on('click', '.options-serie', function(e){
        e.stopPropagation();

        if($(this).find('ul').is(':visible')) {
            $(this).find('ul').fadeOut();
        } else {
            $(this).find('ul').fadeIn();
        }
    });

    $('.options-serie ul').click(function(e){
        e.stopPropagation();
    });

    $('body').click(function(){
        $('.options-serie ul').fadeOut();
    });



    $('.remove-lista').click(function(){
        var lista_id = $(this).closest('.lista').data('id');

        $(this).closest('.lista').remove();

        $.get('/ajax/listas/remover_lista', {lista_id : lista_id}, function(data){});
    });

    $('.edit-nome-lista').click(function(){
        $(this).parent().parent().parent().prev().focus();
    });

    $('.nome-lista').keypress(function(e){
        if(e.which == 13) {
            $(this).blur();

            var descricao = $(this).val();
            var lista_id = $(this).closest('.lista').data('id');

            $.get('/ajax/listas/nome_lista', {lista_id : lista_id, descricao : descricao}, function(data){});
        }
    });

    $('.lista .select-dropdown li').click(function(){
        var serie_id = $(this).parent().parent().find('select').val();

        if(serie_id != '') {
            //Remove texto de sem lista se arrastar uma serie para a lista
            if($(this).closest('.lista').find('.sem-lista').length > 0) {
                $(this).closest('.lista').find('.sem-lista').remove();
            }

            var lista_id = $(this).closest('.lista').data('id');
            var drop = $(this).closest('.lista').find('.drop');

            var data = { lista_id : lista_id, serie_id : serie_id };

            addSerie(data, drop);
        }
    });

    //Detecta se o scroll esta ativado para alterar a div do appendTo
    var size_scroll = document.getElementById('listas');
    var check_scroll = size_scroll.scrollWidth > size_scroll.clientWidth;
    var scroll = check_scroll == true ? '#listas' : '.lista';

    $('.drop').sortable({
        connectWith: "ul",
        revert: true,
        appendTo: scroll,
        helper: 'clone',

        stop: function(event, ui){
            //Remove texto de sem lista se arrastar uma serie para a lista
            if($(ui.item).prev('.sem-lista').length > 0) {
                $(ui.item).prev('.sem-lista').remove();
            }

            //Adiciona texto de sem lista se deixa a lista sem serie
            adicionarMsg();

            //Adicionar serie a lista
            var serie_id = $(ui.item).data('id');
            var lista_id = $(ui.item).parent().parent().data('id');
            var position = $(ui.item).index();

            var data = { serie_id : serie_id, lista_id : lista_id, position : position };

            addSerie(data, '');
        },
    });
});
*/
