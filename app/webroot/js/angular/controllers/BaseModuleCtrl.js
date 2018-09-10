/* 
 * Kontroler projektu w bazie modułów
 */

app.controller('BaseModuleCtrl', function($scope, $http, $location) {   

    url_parts = $location.absUrl().split('/');
    last_url_element = url_parts.pop();
    previous_url_element = url_parts.pop();
    
    if(!isNaN(last_url_element) && !isNaN(previous_url_element)){
        
        $scope.client_project_id = last_url_element;
    }
});