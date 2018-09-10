app.controller('SocialBookCtrl', function ($scope, $http) {
    $http.get('/social_books/index.json').success(function (data) {
        $scope.socialBook = data;
    });
});