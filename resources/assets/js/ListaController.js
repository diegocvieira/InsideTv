var Insidetv = angular.module('Insidetv', []);
Insidetv.config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[{');
    $interpolateProvider.endSymbol('}]');
});
Insidetv.controller('ListaController', function($scope, $http) {
    var size_scroll = document.getElementById('listas');
    var check_scroll = size_scroll.scrollWidth > size_scroll.clientWidth;
    var scroll = check_scroll == true ? '#listas' : '.lista';

    $scope.dragStop = function(e, ui) {
        //Remove texto de sem lista se arrastar uma serie para a lista
        if($(ui.item).prev('.sem-lista').length > 0) {
            $(ui.item).prev('.sem-lista').remove();
        }

        console.log('ok');
    }

    $('.drop').sortable({
        connectWith: "ul",
        revert: true,
        appendTo: scroll,
        helper: 'clone',
        stop: $scope.dragStop
    });
});
