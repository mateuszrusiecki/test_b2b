app.controller('AddPaymentCtrl', function ($scope) {
    $scope.payments = [];
    // Drop handler.
    $scope.onDrop = function (data, $event) {
        //console.log(event);
        console.log($scope.payments);
        //console.log('asdf');
        // Get custom object data.
        //var customObjectData = data['json/custom-object']; // {foo: 'bar'}
        var tmp = {};
        angular.copy(data, tmp);
        if (window.innerWidth < 960) {
            $scope.payments.push(tmp); // {foo: 'bar'}
        } else {
            $scope.payments.unshift(tmp); // {foo: 'bar'}
        }
        //$event.preventDefault();
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
});