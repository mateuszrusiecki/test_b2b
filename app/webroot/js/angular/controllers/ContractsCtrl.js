/* 
 * Kontroler umów użytkownika
 */

app.controller('ContractsCtrl', function($scope, $http, $location) {
    profile_id = $location.absUrl().split('/').pop();
    
    $scope.getUsersContracts = function() {
        
        $http.post('/profiles/contracts.json', {profile_id: profile_id}).success(function(data){
            $scope.contracts = data.contracts;
            
            angular.forEach($scope.contracts, function(contractData) {
                contractData.UserContractHistory.id = parseInt(contractData.UserContractHistory.id);
                contractData.UserContractHistory.contract_active = $scope.isContractActive(contractData.UserContractHistory.employment_start, contractData.UserContractHistory.employment_end);
            });                 
        });
    };
    
    $scope.isContractActive = function(employmentStart, employmentEnd) {
        today = new Date();
        
        employmentStart = new Date(employmentStart);
        employmentEnd = new Date(employmentEnd);

        if(today >= employmentStart && today <= employmentEnd){
            return true;
        } else {
            return false;
        }
    }
    
    $scope.getDateFromDateTime = function(datetime){
        return datetime.split(' ').shift();
    }
    
    $scope.getUsersContracts();
});