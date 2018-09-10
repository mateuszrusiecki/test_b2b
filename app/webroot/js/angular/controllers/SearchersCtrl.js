/* 
 * Kontroler wyszukiwarek
 */

app.controller('SearchersCtrl', function($scope, $sce) {   
    
    $scope.renderHtml = function(html) {
        
        return $sce.trustAsHtml(html);
    };
});