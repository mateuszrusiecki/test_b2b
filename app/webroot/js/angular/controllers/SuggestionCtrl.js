app.controller('SuggestionCtrl', function ($scope, $http, $filter, $q) {
    $scope.suggestion = {};
    $scope.suggestion.type = 'suggestion';
    $scope.save = function () {
        var deferred = $q.defer();
        $scope.suggestion.href = window.location.href;
        $http.post('/suggestions/add.json', $scope.suggestion).success(function (data) {
            deferred.resolve(data.return);
            $scope.suggestion.message = data.return.message;
        });
        return deferred.promise;
    };
});