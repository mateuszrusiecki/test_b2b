/* 
 * Kontroler powiadomień
 */

app.controller('MessagesCtrl', function ($scope, $http, $sce) {

    $scope.getMessages = function () {

        $http.post('/profiles/messages.json').success(function (data) {
            $scope.messages = data.messages;
        });
    };

    $scope.parse = function (data) {
        //console.log(data);
        return $sce.trustAsHtml(data);
    }
    $scope.getMessages();
});