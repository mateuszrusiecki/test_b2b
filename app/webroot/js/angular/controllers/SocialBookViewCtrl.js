app.controller('SocialBookViewCtrl', function ($scope, $http) {
    $scope.getData = function (email) {
        $http.get('/social_books/view/' + email + '.json').success(function (data) {
            $scope.socialBook = data;
        });
    }
    $scope.saveSocialBook = function (post) {
        $http.post('/social_books/save_social_book.json', post).success(function (data) {
            console.log(data);
            angular.extend($scope.socialBook, data);
        });
    }
});