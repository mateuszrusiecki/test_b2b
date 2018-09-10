/* 
 * Kontroler krótkiej listy powiadomień na górnym pasku w layoucie
 */

app.controller('MessagesInfoCtrl', function($scope, $http) {
    
    $scope.messagesReaded = 0;
    
    $scope.getMessages = function() {
        
        $http.post('/profiles/messages_info.json').success(function(data) {
            $scope.messages = data.messages;   
        });
    };
    
    $scope.getMessages();
    
    $scope.setMessagesReaded = function() {

        if($scope.messagesReaded == 0){
            $http.post('/profiles/set_messages_readed', $scope.messages);
        }
        
        $scope.messagesReaded = 1;
    };
});