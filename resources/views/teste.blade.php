<script src="//code.angularjs.org/snapshot/angular.min.js"></script>
<script>
    var insidetv = angular.module('insidetv', []);

    insidetv.config(function($interpolateProvider){
        $interpolateProvider.startSymbol('//');
        $interpolateProvider.endSymbol('//');
    });

    insidetv.controller('DemoController', function($scope, $http) {
        var nome = 'Diego';

        $http({
            method: 'GET',
            url: 'teste2',
            params: { nome : nome }
        }).then(function (response) {
            // code to execute in case of success
            $scope.msg = response.data;
        }, function (response) {
            // code to execute in case of error
        });
    });
</script>
<div ng-app="insidetv" ng-controller="DemoController as demo">
    //msg//
</div>
