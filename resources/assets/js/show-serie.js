$(document).ready(function(){
    $.get('/ajax/atividades-serie', { serie_id : serie_id }, function(data){
        $('.results-atividades').html(data);
    });
});

$(document).on('click', '.carregar-comentarios', function(e){
    var offset = $(this).data('page');
    var hide = $(this);
    var filtro = $('#filtro-comentarios').val();
    var contar_results = $('.contar_results').val();

    $(this).html("<i class='material-icons right'>loop</i>Carregando");
    $(this).css('user-select', 'none');

    $.get('/ajax/comentarios-serie', {serie_id : serie_id, offset : offset, filtro : filtro}, function(data){
        $(hide).remove();
        $('.results').append(data);

        if(contar_results == $('.comentario').length)
            $('.carregar-comentarios').remove();
    });
});

//Mostrar campo para editar o comentario
$(document).on('click', '.edit-post', function(){
    var selector = $(this).attr('id');

    $('.' + selector).toggle();
});

//Cadastrar e editar comentario
$(document).on('submit', '#form-comentario-serie, .form-comentario-serie-update', function(){
    var descricao = $('textarea', this).val();
    var form = $(this);

    if(descricao != ''){
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data){
                if(form.attr('id') == 'form-comentario-serie'){
                    Materialize.toast('Comentário criado', 5000);

                    $('#form-comentario-serie input[type=text]').val('').blur();

                    ajaxComentarios();
                }

                else{
                    form.hide();
                    form.next('div').html(descricao).show();

                    Materialize.toast('Comentário editado', 5000);
                }
            }
        });
    }

    return false;
});

//Carregar  e filtrar comentarios
$(function($){
    $('#filtro-comentarios').change(function(){
        ajaxComentarios();
    }).change();
});

function ajaxComentarios(){
    var filtro = $('#filtro-comentarios').val();

    $.get('/ajax/comentarios-serie', { serie_id : serie_id, filtro : filtro }, function(data){
        $('.results').html(data);
    });
}

//Redimensionar trailer
$(document).ready(sizeTheVideo);
$(window).on('resize', sizeTheVideo);
function sizeTheVideo(){
    var aspectRatio = 1.78;
    var video = $('#videoWithJs iframe');
    var videoHeight = video.outerHeight();
    var newWidth = videoHeight*aspectRatio;
    var halfNewWidth = newWidth/2;

    video.css({"width":newWidth+"px","left":"50%","margin-left":"-"+halfNewWidth+"px"});
}

//Enviar nota
$(document).on('change', '#form-avaliar input[type=radio]', function(){
    var form = document.getElementById('form-avaliar');

    $.ajax({
        type: 'POST',
        url: $('#form-avaliar').attr('action'),
        data: new FormData(form),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data){
            Materialize.toast('Obrigado pela sua avaliação', 5000);
        }
    });
});

//Enviar lista
$(document).on('change', '#form-lista select', function(){
    if($('#form-lista select').val() == '')
        $('#nova-lista').show();

    else
        $('#form-lista').submit();
});

/*$(document).on('submit', '#form-lista', function(e){
    var form = document.getElementById('form-lista');

    $.ajax({
        type: 'POST',
        url: $('#form-lista').attr('action'),
        data: new FormData(form),
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data){
            Materialize.toast('Série adicionada a sua lista', 5000);

            $('#nova-lista').hide();
            $('#nova-lista input[type=text]').val('');
        }
    });

    return false;
});*/
