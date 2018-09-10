app.controller('ProjectListCtrl', function ($scope, $rootScope, $compile, $http) {
    $scope.f = {};
    $scope.f0 = {};
    
    $scope.$watch('client_id', function () {
            $http.get('/client_projects/get.json').success(function(data){
                $scope.projects = data;
            });
    });

    $scope.message = ''; // ??

});