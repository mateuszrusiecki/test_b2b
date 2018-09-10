app.controller('PmCtrl', function ($scope, $http) {
    
    $scope.getPm = function () {
        //console.log('Pm');
        $http.get('/pm/pm_ajax.json').success(function (response) {
            //console.log(response);
            $scope.login_to_pm = response.data.login_to_pm;
            $scope.issues = response.data.issues;
            $scope.issuesAssignedTo = response.data.issuesAssignedTo;
            $scope.issuesReported = response.data.issuesReported;
            $scope.projects_list = response.data.projects;
        });
    }
    
    $scope.getPm();
    
    $scope.projects = {};
    $scope.jump = function () {
        if ($scope.projects) {
            window.open("http://pm.feb.net.pl/projects/" + $scope.projects + "?jump=search", '_blank');
        }
    };
    
    $scope.submit = function (name) {
        if (name) {
            window.open("http://pm.feb.net.pl/search?utf8=%E2%9C%93&q=" + name, '_blank');
        }
    };
    
});