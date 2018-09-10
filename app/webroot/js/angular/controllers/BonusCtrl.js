app.controller('BonusCtrl', function ($scope) {
   
 
    $scope.$watch( 'section_model', function() {
         //console.log($scope.section_model);
         if(typeof $scope.section_model != 'undefined'){
            window.location =  '/bonus_panels/index/'+$scope.section_model ;
            
        }
    });
    
    
    $scope.copyLink = function (link) {
        console.log('dlld');
        console.log(link);
        $scope.copylink = link;
    }




});












