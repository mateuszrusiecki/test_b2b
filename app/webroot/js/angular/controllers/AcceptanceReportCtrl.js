/* 
 * Kontroler profili
 */

app.controller('AcceptanceReportCtrl', function($scope, $http) {
    
    $scope.getReport = function() {
        
        $http.post('/acceptance_reports/index.json').success(function(data) {
            $scope.reports = data.reports;
        });
    };
        
    
    $scope.getReport();
});