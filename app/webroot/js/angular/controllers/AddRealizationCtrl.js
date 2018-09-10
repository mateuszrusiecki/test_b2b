app.controller('AddRealizationCtrl', function ($scope, $filter) {
    $scope.payments = [];
    // Drop handler.
    $scope.onDrop = function (data, event) {
//        console.log(data);
//        console.log(event);
//        console.log('asdf');
        // Get custom object data.
        //var customObjectData = data['json/custom-object']; // {foo: 'bar'}
        var tmp = {};
        angular.copy(data, tmp);
        
        if (window.innerWidth < 960) {
            $scope.payments.push(tmp); // {foo: 'bar'}
        } else {
            $scope.payments.unshift(tmp); // {foo: 'bar'}
        }

        // Get other attached data.
        //var uriList = data['text/uri-list']; // http://mywebsite.com/..

    };
    // Drag over handler.
    $scope.onDragOver = function (event) {

        // ...
    };
    // Delete.
    $scope.onDelete = function (index) {
        $filter('deleted')($scope.payments)['' + index].delete = 1;
        //$scope.payments.splice(index, 1);
        // ...
    };
    
    
    $scope.submitAnswer = function(content,keyEvent) {
        //console.log(keyEvent.which);
        if (keyEvent.which === 13) { //zapisuje odpowiedź po wciśnięciu enter
            //$scope.payment.desc = $scope.payment.desc + '\n • ' + content;
            console.log('prevented');
            keyEvent.preventDefault();
        }
        
    };
});