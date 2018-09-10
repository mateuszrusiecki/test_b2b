app.controller('UserActivityCtrl', function ($scope, $http) {

    $http.get('/user/users_logs/activity_monitor.json').success(function (data) {
        $scope.all_logs = data;
    });

});