angular.module('Insidetv')
   .controller('ListaController', function($scope, $http) {
       var size_scroll = document.getElementById('listas');
       var check_scroll = size_scroll.scrollWidth > size_scroll.clientWidth;
       var scroll = check_scroll == true ? '#listas' : '.lista';

       addMessage = function(){
           $(".drop").each(function(){
               if($(this).find('li').length == 0 && $(this).find('.sem-lista').length == 0) {
                   $(this).append("<span class='sem-lista'>Arraste alguma série para aqui</span>");
               }
           });
       }

       addSerie = function(data, drop){
           $http({
               method: 'POST',
               url: '/ajax/listas/adicionar',
               params : data
           }).then(function successCallback(response) {
               if(drop != '') {
                   var url = "/serie/_slug_".replace('_slug_', data.slug);

                   drop.append("<li class='serie' data-id='" + data.id + "'><span class='serie-nome'>" + data.titulo + "</span><div class='options-serie'><i class='large material-icons'>more_horiz</i><ul class='sub_options'><li><a href='" + url + "'>Ir para a página da série</a></li><li><a href='#' class='remove-serie'>Remover da lista</a></li></ul></div></li>");
               }
           }, function errorCallback(response) {
               console.log('errow');
           });
       }

       $scope.editName = function($event, model) {
           var keyCode = $event.which || $event.keyCode;

           if(keyCode === 13) {
               console.log(model);
           }
       };

      $scope.dragStop = function(e, ui) {
          if($(ui.item).prev('.sem-lista').length > 0) {
              $(ui.item).prev('.sem-lista').remove();
          }

          addMessage();

          //Adicionar serie a lista
          var serie_id = $(ui.item).data('id');
          var lista_id = $(ui.item).parent().parent().data('id');
          var position = $(ui.item).index();

          var data = { serie_id : serie_id, lista_id : lista_id, position : position };

          addSerie(data, '');
      }

      $('.drop').sortable({
         connectWith: "ul",
         revert: true,
         appendTo: scroll,
         helper: 'clone',
         stop: $scope.dragStop
      });
});
