app.controller('ViewTilesCtrl', function ($scope,$http) {

    $scope.budget_popup_data = {};
    $scope.realizations_popup_data = {};
    $scope.payment_popup_data = {};

    $scope.closeProjectModalCheck = function (project_id) {
        $http.get('/client_projects/acceptance_report/'+project_id+'.json').success(function (data) {
            $scope.closeProjectModal = true;
            $scope.closeProjectModalSupervisor = data;
        });
    }

    $scope.getBudgetPopupData = function (project_id) {
        $http.get('/client_projects/get_budget/'+project_id+'.json').success(function (data) {
            $scope.budget_popup_data = data;
        });
    }
    
    $scope.getRealizationsPopupData = function (project_id) {
        $http.get('/client_projects/get_realization/'+project_id+'.json').success(function (data) {
            $scope.realizations_popup_data = data;
        });
    }
    
    $scope.getPaymentsPopupData = function (project_id) {
        $http.get('/client_projects/get_payment/'+project_id+'.json').success(function (data) {
            $scope.payment_popup_data = data;
            console.log(project_id);
            console.log(data);
        });
    }



});












