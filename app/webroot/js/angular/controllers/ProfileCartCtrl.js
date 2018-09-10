app.controller('ProfileCartCtrl', function ($scope, $rootScope, $compile, $http) {

    $scope.addUser2Project = function (user_id, client_project_id,status) {
        var data = {};
        data.user_id = user_id;
        data.client_project_id = client_project_id;
        data.status = status;
        console.log(data);
        $http.post('/client_projects/user2project.json', data).
                success(function (data, status, headers, config) {
                    //console.log(data);
                    if(data.success == 'save'){
                        $scope.active = true; 
                    }
                    if(data.success == 'delete'){
                        $scope.active = false; 
                    }
                    // this callback will be called asynchronously
                    // when the response is available
                }).
                error(function (data, status, headers, config) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
    }


});